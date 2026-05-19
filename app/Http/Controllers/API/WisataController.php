<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FasilitasWisata;
use App\Models\GaleriWisata;
use App\Models\Wisata;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    // ============================================================
    // GET /api/wisata
    // Publik — dengan filter & search
    // Query params: kategori_id, status, search, per_page
    // ============================================================
    public function index(Request $request): JsonResponse
    {
        $query = Wisata::with(['kategori', 'fotoCover', 'pengelola:id,nama'])
                       ->withCount('ulasan')
                       ->withAvg('ulasan', 'rating');

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter by status (default hanya tampilkan yang aktif untuk publik)
        $query->where('status', $request->get('status', 'aktif'));

        // Search by nama atau alamat
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $wisata = $query->orderBy('nama')
                        ->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'message' => 'Daftar tempat wisata',
            'data'    => $wisata->items(),
            'meta'    => [
                'current_page' => $wisata->currentPage(),
                'per_page'     => $wisata->perPage(),
                'total'        => $wisata->total(),
                'last_page'    => $wisata->lastPage(),
            ],
        ]);
    }

    // ============================================================
    // GET /api/wisata/{id}
    // Publik — detail lengkap satu wisata
    // ============================================================
    public function show(int $id): JsonResponse
    {
        $wisata = Wisata::with([
            'kategori',
            'pengelola:id,nama,no_hp',
            'fasilitas',
            'galeri',
            'paketCamping',
            'penginapan.kamar',
            'peralatan',
        ])
        ->withCount('ulasan')
        ->withAvg('ulasan', 'rating')
        ->find($id);

        if (! $wisata) {
            return response()->json([
                'success' => false,
                'message' => 'Wisata tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail wisata',
            'data'    => $wisata,
        ]);
    }

    // ============================================================
    // POST /api/wisata
    // Pengelola only
    // Body (form-data): nama*, kategori_id*, alamat*, deskripsi,
    //                   harga_tiket, kuota_harian, latitude, longitude
    // ============================================================
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama'         => 'required|string|max:255',
            'kategori_id'  => 'required|exists:kategori_wisata,id',
            'alamat'       => 'required|string',
            'deskripsi'    => 'nullable|string',
            'harga_tiket'  => 'nullable|numeric|min:0',
            'kuota_harian' => 'nullable|integer|min:0',
            'latitude'     => 'nullable|numeric|between:-90,90',
            'longitude'    => 'nullable|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $wisata = Wisata::create([
            'pengelola_id' => $request->user()->id,    // otomatis dari token
            'kategori_id'  => $request->kategori_id,
            'nama'         => $request->nama,
            'deskripsi'    => $request->deskripsi,
            'alamat'       => $request->alamat,
            'harga_tiket'  => $request->harga_tiket  ?? 0,
            'kuota_harian' => $request->kuota_harian ?? 0,
            'latitude'     => $request->latitude,
            'longitude'    => $request->longitude,
            'status'       => 'aktif',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tempat wisata berhasil dibuat',
            'data'    => $wisata->load('kategori'),
        ], 201);
    }

    // ============================================================
    // PUT /api/wisata/{id}
    // Pengelola (hanya wisata milik sendiri) atau Admin
    // ============================================================
    public function update(Request $request, int $id): JsonResponse
    {
        $wisata = Wisata::find($id);

        if (! $wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan'], 404);
        }

        // Pengelola hanya bisa edit wisata miliknya sendiri
        $user = $request->user();
        if ($user->isPengelola() && $wisata->pengelola_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin mengubah wisata ini',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama'         => 'sometimes|string|max:255',
            'kategori_id'  => 'sometimes|exists:kategori_wisata,id',
            'alamat'       => 'sometimes|string',
            'deskripsi'    => 'sometimes|nullable|string',
            'harga_tiket'  => 'sometimes|numeric|min:0',
            'kuota_harian' => 'sometimes|integer|min:0',
            'latitude'     => 'sometimes|nullable|numeric|between:-90,90',
            'longitude'    => 'sometimes|nullable|numeric|between:-180,180',
            'status'       => 'sometimes|in:aktif,nonaktif,pending',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $wisata->update($request->only([
            'nama', 'kategori_id', 'alamat', 'deskripsi',
            'harga_tiket', 'kuota_harian', 'latitude', 'longitude', 'status',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Wisata berhasil diperbarui',
            'data'    => $wisata->load('kategori'),
        ]);
    }

    // ============================================================
    // DELETE /api/wisata/{id}
    // Admin only
    // ============================================================
    public function destroy(Request $request, int $id): JsonResponse
    {
        $wisata = Wisata::find($id);

        if (! $wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan'], 404);
        }

        $wisata->delete();

        return response()->json([
            'success' => true,
            'message' => 'Wisata berhasil dihapus',
        ]);
    }

    // ============================================================
    // GET /api/wisata/pengelola/saya
    // Pengelola — list wisata milik sendiri
    // ============================================================
    public function milikSaya(Request $request): JsonResponse
    {
        $wisata = Wisata::with(['kategori', 'fotoCover'])
                        ->withCount(['reservasi', 'ulasan'])
                        ->where('pengelola_id', $request->user()->id)
                        ->orderByDesc('created_at')
                        ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Daftar wisata Anda',
            'data'    => $wisata->items(),
            'meta'    => [
                'current_page' => $wisata->currentPage(),
                'total'        => $wisata->total(),
                'last_page'    => $wisata->lastPage(),
            ],
        ]);
    }

    // ============================================================
    // ---- FASILITAS ----
    // ============================================================

    // GET /api/wisata/{id}/fasilitas  — publik
    public function getFasilitas(int $wisataId): JsonResponse
    {
        $wisata = Wisata::find($wisataId);
        if (! $wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $wisata->fasilitas,
        ]);
    }

    // POST /api/wisata/{id}/fasilitas  — pengelola
    public function storeFasilitas(Request $request, int $wisataId): JsonResponse
    {
        $wisata = Wisata::find($wisataId);
        if (! $wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan'], 404);
        }

        $user = $request->user();
        if ($user->isPengelola() && $wisata->pengelola_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required|string|max:255',
            'keterangan'     => 'nullable|string',
            'ikon'           => 'nullable|string|max:100',
            'tersedia'       => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $fasilitas = FasilitasWisata::create([
            'wisata_id'      => $wisataId,
            'nama_fasilitas' => $request->nama_fasilitas,
            'keterangan'     => $request->keterangan,
            'ikon'           => $request->ikon,
            'tersedia'       => $request->tersedia ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan',
            'data'    => $fasilitas,
        ], 201);
    }

    // DELETE /api/wisata/{wisataId}/fasilitas/{fasilitasId}  — pengelola
    public function destroyFasilitas(Request $request, int $wisataId, int $fasilitasId): JsonResponse
    {
        $fasilitas = FasilitasWisata::where('wisata_id', $wisataId)->find($fasilitasId);
        if (! $fasilitas) {
            return response()->json(['success' => false, 'message' => 'Fasilitas tidak ditemukan'], 404);
        }

        $user   = $request->user();
        $wisata = Wisata::find($wisataId);
        if ($user->isPengelola() && $wisata->pengelola_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $fasilitas->delete();

        return response()->json(['success' => true, 'message' => 'Fasilitas berhasil dihapus']);
    }

    // ============================================================
    // ---- GALERI ----
    // ============================================================

    // GET /api/wisata/{id}/galeri  — publik
    public function getGaleri(int $wisataId): JsonResponse
    {
        $wisata = Wisata::find($wisataId);
        if (! $wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $wisata->galeri,
        ]);
    }

    // POST /api/wisata/{id}/galeri  — pengelola
    // Body (form-data): foto (file)*, keterangan, is_cover
    public function storeGaleri(Request $request, int $wisataId): JsonResponse
    {
        $wisata = Wisata::find($wisataId);
        if (! $wisata) {
            return response()->json(['success' => false, 'message' => 'Wisata tidak ditemukan'], 404);
        }

        $user = $request->user();
        if ($user->isPengelola() && $wisata->pengelola_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $validator = Validator::make($request->all(), [
            'foto'       => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'keterangan' => 'nullable|string|max:255',
            'is_cover'   => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Jika set sebagai cover, reset cover lama
        if ($request->boolean('is_cover')) {
            GaleriWisata::where('wisata_id', $wisataId)->update(['is_cover' => false]);
        }

        $path = $request->file('foto')->store("galeri-wisata/{$wisataId}", 'public');

        $galeri = GaleriWisata::create([
            'wisata_id'   => $wisataId,
            'url_foto'    => $path,
            'keterangan'  => $request->keterangan,
            'is_cover'    => $request->boolean('is_cover', false),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diunggah',
            'data'    => $galeri,
        ], 201);
    }

    // DELETE /api/wisata/{wisataId}/galeri/{galeriId}  — pengelola
    public function destroyGaleri(Request $request, int $wisataId, int $galeriId): JsonResponse
    {
        $galeri = GaleriWisata::where('wisata_id', $wisataId)->find($galeriId);
        if (! $galeri) {
            return response()->json(['success' => false, 'message' => 'Foto tidak ditemukan'], 404);
        }

        $user   = $request->user();
        $wisata = Wisata::find($wisataId);
        if ($user->isPengelola() && $wisata->pengelola_id !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        // Hapus file fisik dari storage
        Storage::disk('public')->delete($galeri->getRawOriginal('url_foto'));

        $galeri->delete();

        return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus']);
    }
}
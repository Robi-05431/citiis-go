<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriWisata;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriWisataController extends Controller
{
    // ============================================================
    // GET /api/kategori
    // Publik - semua role bisa akses
    // ============================================================
    public function index(): JsonResponse
    {
        $kategori = KategoriWisata::withCount('wisata')   // hitung jumlah wisata per kategori
                                   ->orderBy('nama')
                                   ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar kategori wisata',
            'data'    => $kategori,
        ]);
    }

    // ============================================================
    // GET /api/kategori/{id}
    // Publik
    // ============================================================
    public function show(int $id): JsonResponse
    {
        $kategori = KategoriWisata::withCount('wisata')->find($id);

        if (! $kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail kategori',
            'data'    => $kategori,
        ]);
    }

    // ============================================================
    // POST /api/kategori
    // Admin only
    // Body: nama, ikon (opsional), deskripsi (opsional)
    // ============================================================
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required|string|max:255|unique:kategori_wisata,nama',
            'ikon'      => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $kategori = KategoriWisata::create($request->only('nama', 'ikon', 'deskripsi'));

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dibuat',
            'data'    => $kategori,
        ], 201);
    }

    // ============================================================
    // PUT /api/kategori/{id}
    // Admin only
    // ============================================================
    public function update(Request $request, int $id): JsonResponse
    {
        $kategori = KategoriWisata::find($id);

        if (! $kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama'      => "sometimes|string|max:255|unique:kategori_wisata,nama,{$id}",
            'ikon'      => 'sometimes|nullable|string|max:100',
            'deskripsi' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $kategori->update($request->only('nama', 'ikon', 'deskripsi'));

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui',
            'data'    => $kategori,
        ]);
    }

    // ============================================================
    // DELETE /api/kategori/{id}
    // Admin only
    // ============================================================
    public function destroy(int $id): JsonResponse
    {
        $kategori = KategoriWisata::find($id);

        if (! $kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], 404);
        }

        // Cegah hapus jika masih ada wisata yang pakai kategori ini
        if ($kategori->wisata()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak dapat dihapus karena masih digunakan oleh ' 
                             . $kategori->wisata()->count() . ' tempat wisata.',
            ], 409);
        }

        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus',
        ]);
    }
}
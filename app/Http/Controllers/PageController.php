<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    // ── Data dummy fallback ───────────────────────────────────────────────────
    // Dipakai otomatis jika database belum ada atau tabel masih kosong

    private function dummyPenginapan(): \Illuminate\Support\Collection
    {
        return collect([
            (object)['name' => 'Villa Galunggung A', 'foto' => null, 'tersedia' => true,  'kapasitas' => 6,  'harga_per_malam' => 750000, 'type' => 'Villa'],
            (object)['name' => 'Bungalow Danau',     'foto' => null, 'tersedia' => true,  'kapasitas' => 4,  'harga_per_malam' => 450000, 'type' => 'Bungalow'],
            (object)['name' => 'Kamar Standar 01',   'foto' => null, 'tersedia' => false, 'kapasitas' => 2,  'harga_per_malam' => 250000, 'type' => 'Kamar'],
            (object)['name' => 'Villa Galunggung B', 'foto' => null, 'tersedia' => true,  'kapasitas' => 8,  'harga_per_malam' => 950000, 'type' => 'Villa'],
        ]);
    }

    private function dummyCamping(): \Illuminate\Support\Collection
    {
        return collect([
            (object)['name' => 'Zona Alpha', 'foto' => null, 'tersedia' => true,  'kapasitas_tenda' => 10, 'harga_per_tenda' => 50000, 'fitur' => 'Dekat sumber air'],
            (object)['name' => 'Zona Beta',  'foto' => null, 'tersedia' => true,  'kapasitas_tenda' => 8,  'harga_per_tenda' => 60000, 'fitur' => 'View Galunggung'],
            (object)['name' => 'Zona Gamma', 'foto' => null, 'tersedia' => false, 'kapasitas_tenda' => 6,  'harga_per_tenda' => 75000, 'fitur' => 'Private'],
        ]);
    }

    private function dummyCampingFormatted(): \Illuminate\Support\Collection
    {
        return $this->dummyCamping()->map(fn($item) => (object)[
            'name' => $item->name,
            'kapasitas' => "Kapasitas {$item->kapasitas_tenda} tenda",
            'harga' => "Rp " . number_format($item->harga_per_tenda, 0, ',', '.'),
            'status' => $item->tersedia ? 'Tersedia' : 'Penuh',
            'fitur' => $item->fitur ?? 'Fasilitas camping',
        ]);
    }

    private function dummyPeralatan(): \Illuminate\Support\Collection
    {
        return collect([
            (object)['name' => 'Tenda Dome 2P',   'foto' => null, 'stok' => 12, 'harga_per_hari' => 80000, 'emoji' => '⛺'],
            (object)['name' => 'Sleeping Bag',    'foto' => null, 'stok' => 20, 'harga_per_hari' => 35000, 'emoji' => '🛏️'],
            (object)['name' => 'Kompor Portable', 'foto' => null, 'stok' => 8,  'harga_per_hari' => 40000, 'emoji' => '🔥'],
            (object)['name' => 'Carrier 60L',     'foto' => null, 'stok' => 15, 'harga_per_hari' => 50000, 'emoji' => '🎒'],
            (object)['name' => 'Matras Camping',  'foto' => null, 'stok' => 25, 'harga_per_hari' => 20000, 'emoji' => '🟫'],
            (object)['name' => 'Lampu Tenda',     'foto' => null, 'stok' => 18, 'harga_per_hari' => 25000, 'emoji' => '💡'],
        ]);
    }

    // ── Helper: ambil dari DB, fallback ke dummy jika gagal ───────────────────
    private function getPenginapan(): \Illuminate\Support\Collection
    {
        try {
            $data = \App\Models\Penginapan::orderByDesc('tersedia')->get();
            return $data->isNotEmpty() ? $data : $this->dummyPenginapan();
        } catch (\Exception $e) {
            return $this->dummyPenginapan();
        }
    }

    private function getCamping(): \Illuminate\Support\Collection
    {
        try {
            $data = \App\Models\Camping::orderByDesc('tersedia')->get();
            if ($data->isNotEmpty()) {
                return $data->map(fn($item) => (object)[
                    'name' => $item->name,
                    'kapasitas' => "Kapasitas {$item->kapasitas_tenda} tenda",
                    'harga' => "Rp " . number_format((int)$item->harga_per_tenda, 0, ',', '.'),
                    'status' => $item->tersedia ? 'Tersedia' : 'Penuh',
                    'fitur' => $item->fitur ?? 'Fasilitas camping',
                ]);
            }
            return $this->dummyCampingFormatted();
        } catch (\Exception $e) {
            return $this->dummyCampingFormatted();
        }
    }

    private function getPeralatan(): \Illuminate\Support\Collection
    {
        try {
            $data = \App\Models\Peralatan::orderByDesc('stok')->get();
            if ($data->isNotEmpty()) {
                return $data->map(fn($item) => (object)[
                    'name' => $item->name,
                    'stok' => $item->stok,
                    'harga' => "Rp " . number_format((int)$item->harga_per_hari, 0, ',', '.') . "/hari",
                    'icon' => $item->emoji ?? '🎒',
                ]);
            }
            return $this->dummyPeralatanFormatted();
        } catch (\Exception $e) {
            return $this->dummyPeralatanFormatted();
        }
    }

    private function dummyPeralatanFormatted(): \Illuminate\Support\Collection
    {
        return $this->dummyPeralatan()->map(fn($item) => (object)[
            'name' => $item->name,
            'stok' => $item->stok,
            'harga' => "Rp " . number_format((int)$item->harga_per_hari, 0, ',', '.') . "/hari",
            'icon' => $item->emoji ?? '🎒',
        ]);
    }

    // ── Pages ─────────────────────────────────────────────────────────────────

    public function beranda(): View
    {
        return view('pages.beranda', [
            'penginapan' => $this->getPenginapan(),
            'camping'    => $this->getCamping(),
        ]);
    }

    public function tentang(): View
    {
        return view('pages.tentang');
    }

    public function wisata(): View
    {
        return view('pages.wisata');
    }

    public function penginapan(): View
    {
        return view('pages.penginapan', [
            'penginapan' => $this->getPenginapan(),
        ]);
    }

    public function camping(): View
    {
        return view('pages.camping', [
            'camping' => $this->getCamping(),
        ]);
    }

    public function peralatan(): View
    {
        return view('pages.peralatan', [
            'peralatan' => $this->getPeralatan(),
        ]);
    }

    public function informasi(): View
    {
        return view('pages.informasi', [
            'hargaTiket' => [
                ['tipe' => 'Dewasa (Weekday)', 'harga' => 'Rp 25.000'],
                ['tipe' => 'Dewasa (Weekend)', 'harga' => 'Rp 35.000'],
                ['tipe' => 'Anak-anak',        'harga' => 'Rp 15.000'],
                ['tipe' => 'Parkir Motor',     'harga' => 'Rp 5.000'],
                ['tipe' => 'Parkir Mobil',     'harga' => 'Rp 10.000'],
            ],
        ]);
    }
}
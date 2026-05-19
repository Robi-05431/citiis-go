<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    // ===== SHARED DATA =====

    private array $fasilitas = [
        ['icon' => '🏕️', 'title' => 'Area Camping',      'desc' => '8 zona camping dengan pemandangan Gunung Galunggung yang memukau'],
        ['icon' => '🏠', 'title' => 'Penginapan',         'desc' => '12 unit penginapan nyaman dengan berbagai pilihan tipe kamar'],
        ['icon' => '🎒', 'title' => 'Sewa Peralatan',     'desc' => 'Lengkapi petualangan dengan peralatan camping berkualitas'],
        ['icon' => '🌊', 'title' => 'Sumber Air Panas',   'desc' => 'Nikmati sensasi berendam di kolam air panas alami'],
        ['icon' => '🥾', 'title' => 'Jalur Hiking',       'desc' => 'Berbagai jalur hiking untuk semua tingkat kemampuan'],
        ['icon' => '🍽️', 'title' => 'Restoran & Warung', 'desc' => 'Aneka kuliner lokal dan makanan ringan tersedia di area wisata'],
    ];

    private array $penginapan = [
        ['name' => 'Villa Galunggung A', 'type' => 'Villa',     'kapasitas' => 6, 'harga' => 'Rp 750.000/malam', 'status' => 'Tersedia', 'img' => '🏡'],
        ['name' => 'Bungalow Danau',     'type' => 'Bungalow',  'kapasitas' => 4, 'harga' => 'Rp 450.000/malam', 'status' => 'Tersedia', 'img' => '🛖'],
        ['name' => 'Kamar Standar 01',  'type' => 'Kamar',     'kapasitas' => 2, 'harga' => 'Rp 250.000/malam', 'status' => 'Penuh',    'img' => '🏨'],
        ['name' => 'Villa Galunggung B', 'type' => 'Villa',     'kapasitas' => 8, 'harga' => 'Rp 950.000/malam', 'status' => 'Tersedia', 'img' => '🏡'],
    ];

    private array $camping = [
        ['name' => 'Zona Alpha', 'kapasitas' => '10 tenda', 'harga' => 'Rp 50.000/tenda/malam', 'status' => 'Tersedia', 'fitur' => 'Dekat sumber air'],
        ['name' => 'Zona Beta',  'kapasitas' => '8 tenda',  'harga' => 'Rp 60.000/tenda/malam', 'status' => 'Tersedia', 'fitur' => 'View Galunggung'],
        ['name' => 'Zona Gamma', 'kapasitas' => '6 tenda',  'harga' => 'Rp 75.000/tenda/malam', 'status' => 'Penuh',    'fitur' => 'Private, akses terbatas'],
    ];

    private array $peralatan = [
        ['name' => 'Tenda Dome 2P',   'stok' => 12, 'harga' => 'Rp 80.000/hari', 'icon' => '⛺'],
        ['name' => 'Sleeping Bag',    'stok' => 20, 'harga' => 'Rp 35.000/hari', 'icon' => '🛏️'],
        ['name' => 'Kompor Portable', 'stok' => 8,  'harga' => 'Rp 40.000/hari', 'icon' => '🔥'],
        ['name' => 'Carrier 60L',     'stok' => 15, 'harga' => 'Rp 50.000/hari', 'icon' => '🎒'],
        ['name' => 'Matras Camping',  'stok' => 25, 'harga' => 'Rp 20.000/hari', 'icon' => '🟫'],
        ['name' => 'Lampu Tenda',     'stok' => 18, 'harga' => 'Rp 25.000/hari', 'icon' => '💡'],
    ];

    private array $hargaTiket = [
        ['tipe' => 'Dewasa (Weekday)', 'harga' => 'Rp 25.000'],
        ['tipe' => 'Dewasa (Weekend)', 'harga' => 'Rp 35.000'],
        ['tipe' => 'Anak-anak',        'harga' => 'Rp 15.000'],
        ['tipe' => 'Parkir Motor',     'harga' => 'Rp 5.000'],
        ['tipe' => 'Parkir Mobil',     'harga' => 'Rp 10.000'],
    ];

    // ===== PAGES =====

    public function beranda(): View
    {
        return view('pages.beranda', ['fasilitas' => $this->fasilitas]);
    }

    public function informasi(): View
    {
        return view('pages.informasi', [
            'fasilitas'   => $this->fasilitas,
            'hargaTiket'  => $this->hargaTiket,
        ]);
    }

    public function penginapan(): View
    {
        return view('pages.penginapan', ['penginapan' => $this->penginapan]);
    }

    public function camping(): View
    {
        return view('pages.camping', ['camping' => $this->camping]);
    }

    public function peralatan(): View
    {
        return view('pages.peralatan', ['peralatan' => $this->peralatan]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------------------------------------
        // 1. USERS — 3 akun untuk testing semua role
        // -------------------------------------------------------
        DB::table('users')->insert([
            [
                'nama'          => 'Admin CitiisGo',
                'email'         => 'admin@citiisgo.com',
                'password_hash' => Hash::make('password123'),
                'no_hp'         => '081200000001',
                'role'          => 'admin',
                'status'        => 'aktif',
                'created_at'    => now(), 'updated_at' => now(),
            ],
            [
                'nama'          => 'Budi Santoso',
                'email'         => 'pengelola@citiisgo.com',
                'password_hash' => Hash::make('password123'),
                'no_hp'         => '081200000002',
                'role'          => 'pengelola',
                'status'        => 'aktif',
                'created_at'    => now(), 'updated_at' => now(),
            ],
            [
                'nama'          => 'Siti Rahayu',
                'email'         => 'wisatawan@citiisgo.com',
                'password_hash' => Hash::make('password123'),
                'no_hp'         => '081200000003',
                'role'          => 'wisatawan',
                'status'        => 'aktif',
                'created_at'    => now(), 'updated_at' => now(),
            ],
        ]);

        // -------------------------------------------------------
        // 2. KATEGORI WISATA
        // -------------------------------------------------------
        DB::table('kategori_wisata')->insert([
            ['nama' => 'Alam & Pegunungan', 'ikon' => 'mountain',  'deskripsi' => 'Wisata alam dan pegunungan'],
            ['nama' => 'Pantai & Bahari',   'ikon' => 'beach',     'deskripsi' => 'Wisata pantai dan laut'],
            ['nama' => 'Budaya & Sejarah',  'ikon' => 'museum',    'deskripsi' => 'Wisata budaya dan sejarah'],
            ['nama' => 'Camping & Outdoor', 'ikon' => 'tent',      'deskripsi' => 'Wisata camping dan outdoor'],
        ]);

        // -------------------------------------------------------
        // 3. WISATA (pengelola_id = 2 = Budi Santoso)
        // -------------------------------------------------------
        DB::table('wisata')->insert([
            [
                'pengelola_id' => 2, 'kategori_id' => 4,
                'nama'         => 'Bumi Perkemahan Gunung Salak',
                'deskripsi'    => 'Tempat camping dengan pemandangan Gunung Salak.',
                'alamat'       => 'Jl. Raya Gunung Salak, Bogor, Jawa Barat',
                'latitude'     => -6.7196, 'longitude' => 106.7355,
                'harga_tiket'  => 25000, 'kuota_harian' => 100, 'status' => 'aktif',
                'created_at'   => now(), 'updated_at' => now(),
            ],
            [
                'pengelola_id' => 2, 'kategori_id' => 1,
                'nama'         => 'Wisata Alam Kawah Putih',
                'deskripsi'    => 'Danau vulkanik dengan air berwarna putih kehijauan.',
                'alamat'       => 'Ciwidey, Bandung Selatan, Jawa Barat',
                'latitude'     => -7.1666, 'longitude' => 107.4018,
                'harga_tiket'  => 50000, 'kuota_harian' => 200, 'status' => 'aktif',
                'created_at'   => now(), 'updated_at' => now(),
            ],
        ]);

        // -------------------------------------------------------
        // 4. FASILITAS WISATA
        // -------------------------------------------------------
        DB::table('fasilitas_wisata')->insert([
            ['wisata_id' => 1, 'nama_fasilitas' => 'Toilet Umum',     'ikon' => 'toilet',  'tersedia' => true],
            ['wisata_id' => 1, 'nama_fasilitas' => 'Area Parkir',     'ikon' => 'parking', 'tersedia' => true],
            ['wisata_id' => 1, 'nama_fasilitas' => 'Warung Makan',    'ikon' => 'food',    'tersedia' => true],
            ['wisata_id' => 2, 'nama_fasilitas' => 'Toilet Umum',     'ikon' => 'toilet',  'tersedia' => true],
            ['wisata_id' => 2, 'nama_fasilitas' => 'Pusat Informasi', 'ikon' => 'info',    'tersedia' => true],
        ]);

        // -------------------------------------------------------
        // 5. PAKET CAMPING
        // -------------------------------------------------------
        DB::table('paket_camping')->insert([
            [
                'wisata_id' => 1, 'nama_paket' => 'Paket Basic Camping',
                'deskripsi' => 'Paket camping dasar, termasuk area tenda.',
                'harga_per_malam' => 75000, 'kapasitas_tamu' => 4,
                'total_slot' => 20, 'status' => 'aktif', 'tersedia' => true,
            ],
            [
                'wisata_id' => 1, 'nama_paket' => 'Paket Premium Camping',
                'deskripsi' => 'Paket lengkap dengan tenda + sleeping bag + makan malam.',
                'harga_per_malam' => 200000, 'kapasitas_tamu' => 2,
                'total_slot' => 10, 'status' => 'aktif', 'tersedia' => true,
            ],
        ]);

        // -------------------------------------------------------
        // 6. PENGINAPAN & KAMAR
        // -------------------------------------------------------
        DB::table('penginapan')->insert([
            ['wisata_id' => 2, 'nama' => 'Villa Kawah Putih',
             'deskripsi' => 'Villa dengan view langsung ke kawah.', 'alamat' => 'Ciwidey, Bandung'],
        ]);

        DB::table('kamar_penginapan')->insert([
            ['penginapan_id' => 1, 'tipe_kamar' => 'Standard', 'deskripsi' => 'Kamar standard.',
             'kapasitas' => 2, 'harga_per_malam' => 350000, 'total_kamar' => 5, 'tersedia' => true],
            ['penginapan_id' => 1, 'tipe_kamar' => 'Deluxe', 'deskripsi' => 'Kamar deluxe + breakfast.',
             'kapasitas' => 3, 'harga_per_malam' => 600000, 'total_kamar' => 3, 'tersedia' => true],
        ]);

        // -------------------------------------------------------
        // 7. PERALATAN
        // -------------------------------------------------------
        DB::table('peralatan')->insert([
            ['wisata_id' => 1, 'nama' => 'Tenda Dome 4 Orang', 'kategori' => 'tenda',
             'deskripsi' => 'Tenda dome tahan air.', 'harga_sewa_per_hari' => 75000,
             'total_stok' => 15, 'stok_tersedia' => 15],
            ['wisata_id' => 1, 'nama' => 'Sleeping Bag', 'kategori' => 'tidur',
             'deskripsi' => 'Sleeping bag suhu 5°C.', 'harga_sewa_per_hari' => 25000,
             'total_stok' => 30, 'stok_tersedia' => 30],
            ['wisata_id' => 1, 'nama' => 'Kompor Portable', 'kategori' => 'masak',
             'deskripsi' => 'Kompor gas portable.', 'harga_sewa_per_hari' => 30000,
             'total_stok' => 10, 'stok_tersedia' => 10],
        ]);

        $this->command->info('');
        $this->command->info('✅ Seeder CitiisGo selesai!');
        $this->command->info('   Login tersedia:');
        $this->command->info('   admin@citiisgo.com      | password123 | role: admin');
        $this->command->info('   pengelola@citiisgo.com  | password123 | role: pengelola');
        $this->command->info('   wisatawan@citiisgo.com  | password123 | role: wisatawan');
    }
}
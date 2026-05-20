<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ulasan;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    protected $fillable = [
        'pengelola_id', 'kategori_id', 'nama', 'deskripsi',
        'alamat', 'latitude', 'longitude',
        'harga_tiket', 'kuota_harian', 'status',
    ];

    protected $casts = [
        'harga_tiket' => 'decimal:2',
        'latitude'    => 'float',
        'longitude'   => 'float',
    ];

    // ---------- relasi ----------
    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriWisata::class, 'kategori_id');
    }

    public function fasilitas()
    {
        return $this->hasMany(FasilitasWisata::class, 'wisata_id');
    }

    public function galeri()
    {
        return $this->hasMany(GaleriWisata::class, 'wisata_id');
    }

    public function paketCamping()
    {
        return $this->hasMany(PaketCamping::class, 'wisata_id');
    }

    public function penginapan()
    {
        return $this->hasMany(Penginapan::class, 'wisata_id');
    }

    public function peralatan()
    {
        return $this->hasMany(Peralatan::class, 'wisata_id');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'wisata_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'wisata_id');
    }

    // Helper: foto cover dari galeri
    public function fotoCover()
    {
        return $this->hasOne(GaleriWisata::class, 'wisata_id')
                    ->where('is_cover', true);
    }
}
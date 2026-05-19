<?php
// ============================================================
// FILE 1: app/Models/KategoriWisata.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    public $timestamps = false; // tabel tidak punya created_at/updated_at

    protected $table    = 'kategori_wisata';
    protected $fillable = ['nama', 'ikon', 'deskripsi'];

    public function wisata()
    {
        return $this->hasMany(Wisata::class, 'kategori_id');
    }
}

// ============================================================
// FILE 2: app/Models/FasilitasWisata.php
// ============================================================
// namespace App\Models;
// use Illuminate\Database\Eloquent\Model;
//
// class FasilitasWisata extends Model
// {
//     public $timestamps = false;
//     protected $table    = 'fasilitas_wisata';
//     protected $fillable = ['wisata_id','nama_fasilitas','keterangan','ikon','tersedia'];
//     protected $casts    = ['tersedia' => 'boolean'];
//
//     public function wisata() { return $this->belongsTo(Wisata::class, 'wisata_id'); }
// }

// ============================================================
// FILE 3: app/Models/GaleriWisata.php
// ============================================================
// namespace App\Models;
// use Illuminate\Database\Eloquent\Model;
//
// class GaleriWisata extends Model
// {
//     public $timestamps = false;
//     protected $table    = 'galeri_wisata';
//     protected $fillable = ['wisata_id','url_foto','keterangan','is_cover'];
//     protected $casts    = ['is_cover' => 'boolean'];
//     const CREATED_AT    = 'uploaded_at';
//
//     public function wisata() { return $this->belongsTo(Wisata::class, 'wisata_id'); }
// }
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriWisata extends Model
{
    public $timestamps  = false;
    const CREATED_AT    = 'uploaded_at'; // kolom timestamp-nya namanya uploaded_at
    const UPDATED_AT    = null;

    protected $table    = 'galeri_wisata';
    protected $fillable = ['wisata_id', 'url_foto', 'keterangan', 'is_cover'];
    protected $casts    = ['is_cover' => 'boolean'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id');
    }

    // Helper: kembalikan URL lengkap foto
    public function getUrlFotoAttribute($value): string
    {
        // Jika sudah URL lengkap (http/https), langsung return
        if (str_starts_with($value, 'http')) return $value;

        return asset('storage/' . $value);
    }
}
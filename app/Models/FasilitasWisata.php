<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasWisata extends Model
{
    public $timestamps = false;

    protected $table    = 'fasilitas_wisata';
    protected $fillable = ['wisata_id', 'nama_fasilitas', 'keterangan', 'ikon', 'tersedia'];
    protected $casts    = ['tersedia' => 'boolean'];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id');
    }
}
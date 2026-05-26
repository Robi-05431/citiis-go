<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    protected $table = 'penginapan';
    protected $fillable = ['name', 'foto', 'tersedia', 'kapasitas', 'harga_per_malam', 'type', 'deskripsi'];
    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camping extends Model
{
    protected $table = 'camping';
    protected $fillable = ['name', 'foto', 'tersedia', 'kapasitas_tenda', 'harga_per_tenda', 'fitur'];
    public $timestamps = true;
}

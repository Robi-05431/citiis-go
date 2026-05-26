<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $table = 'peralatan';
    protected $fillable = ['name', 'foto', 'stok', 'harga_per_hari', 'emoji'];
    public $timestamps = true;
}

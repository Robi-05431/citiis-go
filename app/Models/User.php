<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',           // ← bukan 'name'
        'email',
        'password_hash',  // ← bukan 'password'
        'no_hp',
        'foto_profil',
        'role',
        'status',
    ];

    protected $hidden = [
        'password_hash',  // ← bukan 'password'
        'remember_token',
    ];

    // Beritahu Laravel bahwa kolom password adalah 'password_hash'
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
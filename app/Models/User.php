<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // ----------------------------------------------------------
    // Kolom yang boleh diisi (mass assignment)
    // ----------------------------------------------------------
    protected $fillable = [
        'nama',
        'email',
        'password_hash',
        'no_hp',
        'foto_profil',
        'role',
        'status',
    ];

    // ----------------------------------------------------------
    // Kolom yang disembunyikan dari response JSON
    // ----------------------------------------------------------
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    // ----------------------------------------------------------
    // Casting tipe data
    // ----------------------------------------------------------
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ----------------------------------------------------------
    // Override default password field Laravel
    // (Laravel default pakai 'password', kita pakai 'password_hash')
    // ----------------------------------------------------------
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    // ----------------------------------------------------------
    // Helper: cek role
    // ----------------------------------------------------------
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPengelola(): bool
    {
        return $this->role === 'pengelola';
    }

    public function isWisatawan(): bool
    {
        return $this->role === 'wisatawan';
    }

    // ----------------------------------------------------------
    // Relasi
    // ----------------------------------------------------------
    public function wisata()
    {
        return $this->hasMany(Wisata::class, 'pengelola_id');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'user_id');
    }

    public function bookingCamping()
    {
        return $this->hasMany(BookingCamping::class, 'user_id');
    }

    public function bookingPenginapan()
    {
        return $this->hasMany(BookingPenginapan::class, 'user_id');
    }

    public function sewaPeralatan()
    {
        return $this->hasMany(SewaPeralatan::class, 'user_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'user_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'user_id');
    }
}
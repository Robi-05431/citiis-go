<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes — Citiis'Go
|--------------------------------------------------------------------------
*/

// ===== PUBLIC PAGES =====
Route::get('/',                  [PageController::class, 'beranda'])->name('beranda');
Route::get('/informasi',         [PageController::class, 'informasi'])->name('informasi');
Route::get('/penginapan',        [PageController::class, 'penginapan'])->name('penginapan');
Route::get('/camping',           [PageController::class, 'camping'])->name('camping');
Route::get('/sewa-peralatan',    [PageController::class, 'peralatan'])->name('peralatan');

// ===== RESERVASI =====
Route::get('/reservasi',         [ReservasiController::class, 'index'])->name('reservasi');
Route::post('/reservasi',        [ReservasiController::class, 'store'])->name('reservasi.store');

// ===== AUTH =====
Route::get('/login',             [AuthController::class, 'loginForm'])->name('login');
Route::post('/login',            [AuthController::class, 'login']);
Route::get('/register',          [AuthController::class, 'registerForm'])->name('register');
Route::post('/register',         [AuthController::class, 'register']);
Route::post('/logout',           [AuthController::class, 'logout'])->name('logout');

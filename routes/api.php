<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriWisataController;
use App\Http\Controllers\API\WisataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — CitiisGo
|--------------------------------------------------------------------------
|
| Middleware tersedia:
|   auth:sanctum          → wajib login (ada token)
|   role.wisatawan        → hanya wisatawan
|   role.pengelola        → hanya pengelola
|   role.admin            → hanya admin
|   role.pengelola_admin  → pengelola ATAU admin
|
*/

// ============================================================
// AUTH — Publik (tidak perlu token)
// ============================================================
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

// ============================================================
// AUTH — Butuh login
// ============================================================
Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::post('logout',          [AuthController::class, 'logout']);
    Route::get('me',               [AuthController::class, 'me']);
    Route::post('profile',         [AuthController::class, 'updateProfile']); // POST karena kirim file
});

// ============================================================
// KATEGORI WISATA
// GET  → publik
// POST/PUT/DELETE → admin only
// ============================================================
Route::prefix('kategori')->group(function () {
    // Publik
    Route::get('/',    [KategoriWisataController::class, 'index']);
    Route::get('/{id}',[KategoriWisataController::class, 'show']);

    // Admin only
    Route::middleware(['auth:sanctum', 'role.admin'])->group(function () {
        Route::post('/',       [KategoriWisataController::class, 'store']);
        Route::put('/{id}',    [KategoriWisataController::class, 'update']);
        Route::delete('/{id}', [KategoriWisataController::class, 'destroy']);
    });
});

// ============================================================
// WISATA
// ============================================================
Route::prefix('wisata')->group(function () {

    // --- Publik (tidak perlu login) ---
    Route::get('/',        [WisataController::class, 'index']);   // list + filter + search
    Route::get('/{id}',    [WisataController::class, 'show']);    // detail wisata
    Route::get('/{id}/fasilitas', [WisataController::class, 'getFasilitas']);
    Route::get('/{id}/galeri',    [WisataController::class, 'getGaleri']);

    // --- Pengelola: wisata milik sendiri ---
    Route::middleware(['auth:sanctum', 'role.pengelola'])->group(function () {
        Route::get('/pengelola/saya', [WisataController::class, 'milikSaya']);
        Route::post('/',              [WisataController::class, 'store']);
        Route::put('/{id}',           [WisataController::class, 'update']);

        // Fasilitas
        Route::post('/{id}/fasilitas',              [WisataController::class, 'storeFasilitas']);
        Route::delete('/{wisataId}/fasilitas/{fasilitasId}', [WisataController::class, 'destroyFasilitas']);

        // Galeri
        Route::post('/{id}/galeri',               [WisataController::class, 'storeGaleri']);
        Route::delete('/{wisataId}/galeri/{galeriId}', [WisataController::class, 'destroyGaleri']);
    });

    // --- Admin: bisa update status & hapus semua wisata ---
    Route::middleware(['auth:sanctum', 'role.admin'])->group(function () {
        Route::put('/admin/{id}',    [WisataController::class, 'update']);
        Route::delete('/admin/{id}', [WisataController::class, 'destroy']);
    });
});
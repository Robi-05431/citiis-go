<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// =============================================
// AUTH ROUTES (tidak perlu token)
// =============================================
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

// =============================================
// PROTECTED ROUTES (butuh token Sanctum)
// =============================================
Route::middleware('auth:sanctum')->group(function () {

    // Auth umum
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me',      [AuthController::class, 'me']);

    // --- Khusus ADMIN ---
    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', fn() => response()->json(['message' => 'Selamat datang Admin!']));
        // tambahkan route admin lainnya di sini
    });

    // --- Khusus PENGELOLA (dan Admin) ---
    Route::middleware('is_pengelola')->prefix('pengelola')->group(function () {
        Route::get('/dashboard', fn() => response()->json(['message' => 'Selamat datang Pengelola!']));
        // tambahkan route pengelola lainnya di sini
    });

    // --- Khusus WISATAWAN ---
    Route::middleware('is_wisatawan')->prefix('wisatawan')->group(function () {
        Route::get('/dashboard', fn() => response()->json(['message' => 'Selamat datang Wisatawan!']));
        // tambahkan route wisatawan lainnya di sini
    });
});
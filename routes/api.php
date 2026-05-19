<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

// PUBLIC — tidak perlu token
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

// PROTECTED — butuh token Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me',      [AuthController::class, 'me']);

    // Khusus Admin
    Route::middleware('is_admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', fn() => response()->json(['message' => 'Dashboard Admin']));
    });

    // Khusus Pengelola (dan Admin)
    Route::middleware('is_pengelola')->prefix('pengelola')->group(function () {
        Route::get('/dashboard', fn() => response()->json(['message' => 'Dashboard Pengelola']));
    });

    // Khusus Wisatawan
    Route::middleware('is_wisatawan')->prefix('wisatawan')->group(function () {
        Route::get('/dashboard', fn() => response()->json(['message' => 'Dashboard Wisatawan']));
    });
});
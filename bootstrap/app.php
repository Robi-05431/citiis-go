<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/*
|--------------------------------------------------------------------------
| bootstrap/app.php — CitiisGo
|--------------------------------------------------------------------------
| Laravel 11 tidak pakai Kernel.php lagi.
| Middleware alias didaftarkan di sini.
*/

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Daftarkan alias middleware role
        $middleware->alias([
            'role.wisatawan'       => \App\Http\Middleware\IsWisatawan::class,
            'role.pengelola'       => \App\Http\Middleware\IsPengelola::class,
            'role.admin'           => \App\Http\Middleware\IsAdmin::class,
            'role.pengelola_admin' => \App\Http\Middleware\IsPengelolaOrAdmin::class,
        ]);

        // Pastikan Sanctum token bisa dipakai di semua API route
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle 404 dan 401 supaya response tetap JSON (bukan HTML)
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum login atau token tidak valid.',
                ], 401);
            }
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Endpoint tidak ditemukan.',
                ], 404);
            }
        });
    })->create();
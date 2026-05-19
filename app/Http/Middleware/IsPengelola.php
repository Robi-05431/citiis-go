<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsPengelola
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || $request->user()->role !== 'pengelola') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Hanya pengelola tempat wisata yang dapat mengakses endpoint ini.',
            ], 403);
        }
        return $next($request);
    }
}
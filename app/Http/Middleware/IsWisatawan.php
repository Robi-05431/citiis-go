<?php
// ============================================================
// FILE 1: app/Http/Middleware/IsWisatawan.php
// ============================================================
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsWisatawan
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user() || $request->user()->role !== 'wisatawan') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Hanya wisatawan yang dapat mengakses endpoint ini.',
            ], 403);
        }
        return $next($request);
    }
}
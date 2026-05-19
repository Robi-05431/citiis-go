<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class IsWisatawan {
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'wisatawan') {
            return $next($request);
        }
        return response()->json(['message' => 'Akses ditolak. Hanya Wisatawan.'], 403);
    }
}
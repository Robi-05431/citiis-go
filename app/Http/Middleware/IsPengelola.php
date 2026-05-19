<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class IsPengelola {
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && in_array($request->user()->role, ['admin','pengelola'])) {
            return $next($request);
        }
        return response()->json(['message' => 'Akses ditolak. Hanya Pengelola/Admin.'], 403);
    }
}

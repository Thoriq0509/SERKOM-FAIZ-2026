<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah user memiliki role
        if (!$user || !$user->role) {
            abort(403, 'Role user tidak ditemukan.');
        }

        // Cek apakah role user termasuk role yang diizinkan
        foreach ($roles as $role) {
            if (strcasecmp((string) $user->role, (string) $role) === 0) {
                return $next($request);
            }
        }

        // Jika role tidak diizinkan
        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
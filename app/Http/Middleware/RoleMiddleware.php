<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    // Cek role user sebelum akses halaman
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Redirect kalau belum login
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Pastikan user punya role
        if (! $user || ! $user->role) {
            abort(403, 'Role user tidak ditemukan.');
        }

        // Cek apakah role user termasuk yang diizinkan (case-insensitive)
        foreach ($roles as $role) {
            if (strcasecmp((string) $user->role, (string) $role) === 0) {
                return $next($request);
            }
        }

        // Role tidak diizinkan
        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
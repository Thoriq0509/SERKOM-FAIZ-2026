<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login dulu
        if (!Auth::check()) {
            return redirect('/');
        }

        // Cek apakah role user yang login ada di dalam daftar role yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request); // Jika ya, izinkan masuk
        }

        // Jika rolenya tidak sesuai, tampilkan pesan error 403 (Dilarang Masuk)
        return abort(403, 'Maaf, Anda tidak memiliki hak akses ke halaman ini.');
    }
}
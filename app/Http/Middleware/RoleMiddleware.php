<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Redirect to login if not authenticated
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Ensure user has a role
        if (! $user || ! $user->role) {
            abort(403, 'Role user tidak ditemukan.');
        }

        // Check if user's role is in the allowed list (case-insensitive)
        foreach ($roles as $role) {
            if (strcasecmp((string) $user->role, (string) $role) === 0) {
                return $next($request);
            }
        }

        // Role not allowed
        abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
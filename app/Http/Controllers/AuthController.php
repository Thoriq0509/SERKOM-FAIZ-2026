<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Memproses login user.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Ambil user yang berhasil login
            $user = Auth::user();

            // Redirect berdasarkan role
            if (strcasecmp((string) $user->role, 'Admin') === 0) {
                return redirect()->route('dashboard');
            }

            if (strcasecmp((string) $user->role, 'Operator') === 0) {
                return redirect()->route('dashboard');
            }

            // Jika role tidak dikenali
            Auth::logout();

            return redirect()
                ->route('login')
                ->withErrors([
                    'username' => 'Role akun tidak memiliki akses.',
                ]);
        }

        // Login gagal
        return back()
            ->withErrors([
                'username' => 'Username atau password salah.',
            ])
            ->withInput($request->only('username'));
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('username', $request->username)->first();

        // Username tidak ditemukan ATAU password salah
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->loginFailed($request, 'Username atau password salah.');
        }

        // Cek role (hanya admin & operator yang boleh masuk)
        $role = strtolower(trim((string) $user->role));

        if (! in_array($role, ['admin', 'operator'], true)) {
            return $this->loginFailed($request, 'Role akun tidak memiliki akses.');
        }

        // Login manual
        Auth::login($user, $request->boolean('remember'));

        // Regenerate session untuk mencegah session fixation
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Kembali ke halaman login dengan pesan error
     */
    private function loginFailed(Request $request, string $message)
    {
        return back()
            ->withErrors(['username' => $message])
            ->withInput($request->only('username'));
    }
}
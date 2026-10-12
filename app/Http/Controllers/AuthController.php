<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Tampilkan halaman login.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.string'   => 'Username tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.string'   => 'Password tidak valid.',
        ]);

        // 2. Cari user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // 3. Cek user ada & password cocok
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return $this->loginFailed($request, 'Username atau password salah.');
        }

        // 4. Cek role — hanya Admin & Operator yang boleh masuk
        $role = strtolower(trim((string) $user->role));

        if (! in_array($role, ['admin', 'operator'], true)) {
            return $this->loginFailed($request, 'Role akun tidak memiliki akses.');
        }

        // 5. Cek status aktif (opsional, kalau ada kolom is_active)
        if (isset($user->is_active) && ! $user->is_active) {
            return $this->loginFailed($request, 'Akun Anda sedang tidak aktif.');
        }

        // 6. Login manual
        Auth::login($user, $request->boolean('remember'));

        // 7. Regenerate session untuk mencegah session fixation
        $request->session()->regenerate();

        // 8. Redirect ke halaman yang dituju, atau ke dashboard
        return redirect()->intended(route('admin.dashboard'));
    }


    /**
     * Proses logout — diarahkan ke landing page.
     */
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session & regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('landing.dashboard')
            ->with('success', 'Anda telah berhasil logout.');
    }


    /**
     * Kembali ke halaman login dengan pesan error.
     */
    private function loginFailed(Request $request, string $message)
    {
        return back()
            ->withErrors(['username' => $message])
            ->withInput($request->only('username'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // tampilkan login page
    public function index()
    {
        return view('auth.login');
    }

    // login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // cari berdasar username
        $user = User::where('username', $request->username)->first();

        // Username not found OR password mismatch
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->loginFailed($request, 'Username atau password salah.');
        }

        // cek role
        $role = strtolower(trim((string) $user->role));

        if (! in_array($role, ['admin', 'operator'], true)) {
            return $this->loginFailed($request, 'Role akun tidak memiliki akses.');
        }

        // Manual login
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function loginFailed(Request $request, string $message)
    {
        return back()
            ->withErrors(['username' => $message])
            ->withInput($request->only('username'));
    }
}
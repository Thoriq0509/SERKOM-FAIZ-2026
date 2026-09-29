<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     * Memproses login.
     */
    public function login(Request $request)
    {
        // ==========================================
        // VALIDASI
        // ==========================================
        $request->validate([
            'username' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
                'string',
            ],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // ==========================================
        // CARI USER BERDASARKAN USERNAME
        // ==========================================
        $user = User::where(
            'username',
            $request->username
        )->first();

        // Username tidak ditemukan.
        if (!$user) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->withInput(
                    $request->only('username')
                );
        }

        // ==========================================
        // CEK PASSWORD
        // ==========================================
        if (!Hash::check(
            $request->password,
            $user->password
        )) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->withInput(
                    $request->only('username')
                );
        }

        // ==========================================
        // CEK ROLE
        // ==========================================
        $role = strtolower(
            trim(
                (string) $user->role
            )
        );

        if (!in_array(
            $role,
            [
                'admin',
                'operator',
            ],
            true
        )) {
            return back()
                ->withErrors([
                    'username' => 'Role akun tidak memiliki akses.',
                ])
                ->withInput(
                    $request->only('username')
                );
        }

        // ==========================================
        // LOGIN MANUAL
        // ==========================================
        Auth::login($user);

        // Regenerasi session.
        $request->session()->regenerate();

        // ==========================================
        // REDIRECT DASHBOARD
        // ==========================================
        return redirect()
            ->route('dashboard');
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }
}
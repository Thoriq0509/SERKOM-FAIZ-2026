<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* =====================================================
     |  SHOW LOGIN PAGE
     ===================================================== */
    public function index()
    {
        return view('auth.login');
    }

    /* =====================================================
     |  PROCESS LOGIN
     ===================================================== */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Username not found OR password mismatch
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->loginFailed($request, 'Username atau password salah.');
        }

        // Check role access
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

    /* =====================================================
     |  LOGOUT
     ===================================================== */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /* =====================================================
     |  HELPER
     ===================================================== */

    /**
     * Redirect back to login with error message.
     */
    private function loginFailed(Request $request, string $message)
    {
        return back()
            ->withErrors(['username' => $message])
            ->withInput($request->only('username'));
    }
}
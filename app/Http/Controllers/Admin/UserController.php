<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna sistem.
     */
    public function index()
    {
        $users = User::orderByDesc('id_user')->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Menampilkan form tambah atau edit pengguna.
     */
    public function addEdit($id = null)
    {
        try {
            $user = null;

            // Jika ada ID, berarti mode edit.
            if ($id) {
                $decryptedId = Crypt::decryptString($id);

                $user = User::where(
                    'id_user',
                    $decryptedId
                )->firstOrFail();
            }

            return view(
                'admin.user.form',
                compact('user')
            );

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }
    }

    /**
     * Menyimpan data baru atau mengubah data pengguna.
     */
    public function save(Request $request, $id = null)
    {
        $userId = null;

        // ==========================================
        // AMBIL DATA USER SAAT EDIT
        // ==========================================
        if ($id) {
            try {
                $userId = Crypt::decryptString($id);

                $user = User::where(
                    'id_user',
                    $userId
                )->firstOrFail();

            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.users.index')
                    ->with(
                        'error',
                        'Data pengguna tidak ditemukan.'
                    );
            }
        } else {
            // ==========================================
            // TAMBAH USER BARU
            // ==========================================
            $user = new User();
        }

        // ==========================================
        // VALIDASI
        // ==========================================
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'username')
                    ->ignore($userId, 'id_user'),
            ],

            'role' => [
                'required',
                Rule::in([
                    'Admin',
                    'Operator',
                ]),
            ],

            'password' => $userId
                ? 'nullable|string|min:6'
                : 'required|string|min:6',

        ], [
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 30 karakter.',
            'username.unique' => 'Username sudah digunakan.',

            'role.required' => 'Role pengguna wajib dipilih.',
            'role.in' => 'Role hanya boleh Admin atau Operator.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // ==========================================
        // SIMPAN USERNAME
        // ==========================================
        $user->username = $request->username;

        // ==========================================
        // SIMPAN ROLE
        // ==========================================
        $user->role = ucfirst(
            strtolower($request->role)
        );

        // ==========================================
        // SIMPAN PASSWORD
        // ==========================================
        if ($request->filled('password')) {
            $user->password = Hash::make(
                $request->password
            );
        }

        // ==========================================
        // SIMPAN KE DATABASE
        // ==========================================
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                $userId
                    ? 'Data pengguna berhasil diperbarui.'
                    : 'Data pengguna berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail pengguna.
     */
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);

            $user = User::where(
                'id_user',
                $decryptedId
            )->firstOrFail();

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }

        return view(
            'admin.user.show',
            compact('user')
        );
    }

    /**
     * Menghapus pengguna.
     */
    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);

            $user = User::where(
                'id_user',
                $decryptedId
            )->firstOrFail();

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }

        // ==========================================
        // JANGAN HAPUS AKUN YANG SEDANG LOGIN
        // ==========================================
        if ((int) $user->id_user === (int) Auth::id()) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun Anda sendiri.'
                );
        }

        // ==========================================
        // HAPUS USER
        // ==========================================
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Data pengguna berhasil dihapus.'
            );
    }
}
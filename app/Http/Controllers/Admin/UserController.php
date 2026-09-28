<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna sistem.
     */
    public function index()
    {
        $users = User::orderByDesc('id_user')->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Menampilkan form tambah atau ubah data pengguna.
     */
    public function addEdit($id = null)
    {
        try {
            $user = null;

            if ($id) {
                $decryptedId = Crypt::decrypt($id);

                $user = User::where('id_user', $decryptedId)->firstOrFail();
            }

            return view('admin.user.form', compact('user'));

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }
    }

    /**
     * Menyimpan data baru atau perubahan pengguna.
     */
    public function save(Request $request, $id = null)
    {
        $userId = null;

        // Jika ada ID, berarti sedang mengubah data.
        if ($id) {
            try {
                $userId = Crypt::decrypt($id);

                $user = User::where('id_user', $userId)->firstOrFail();

            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.users.index')
                    ->with('error', 'Data pengguna tidak ditemukan.');
            }
        } else {
            // Jika tidak ada ID, berarti menambah pengguna baru.
            $user = new User();
        }

        /**
         * Validasi input.
         */
        $request->validate([
            'name' => 'required|string|max:50',

            'username' => 'nullable|string|max:30|unique:users,username,' . ($userId ?? 'NULL') . ',id_user',

            'email' => 'required|email|unique:users,email,' . ($userId ?? 'NULL') . ',id_user',

            'role' => 'required|in:Admin,Operator,admin,operator',

            'password' => $userId
                ? 'nullable|min:6'
                : 'required|min:6',

        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.unique' => 'Username sudah digunakan oleh akun lain.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar pada akun lain.',
            'role.required' => 'Pilih role pengguna (Admin atau Operator).',
            'role.in' => 'Pilihan role tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        /**
         * Mengisi data pengguna.
         */
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = ucfirst(strtolower($request->role));

        /**
         * Username.
         */
        if ($request->filled('username')) {
            $user->username = $request->username;
        } elseif (!$userId) {
            $baseUsername = strtolower(
                explode('@', $request->email)[0]
            );

            $username = $baseUsername;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $user->username = $username;
        }

        /**
         * Password.
         */
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        /**
         * Simpan data.
         */
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                $userId
                    ? 'Data pengguna berhasil diperbarui.'
                    : 'Data pengguna berhasil disimpan.'
            );
    }

    /**
     * Menampilkan detail informasi pengguna.
     */
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $user = User::where('id_user', $decryptedId)->firstOrFail();

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('admin.user.show', compact('user'));
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);

            $user = User::where('id_user', $decryptedId)->firstOrFail();

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        /**
         * Proteksi:
         * Admin/operator tidak boleh menghapus akun sendiri.
         */
        if ((string) $user->id_user === (string) Auth::id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil dihapus.');
    }
}
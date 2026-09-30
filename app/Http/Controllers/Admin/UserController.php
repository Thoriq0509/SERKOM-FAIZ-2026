<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // tampilkan daftar pengguna
    public function index()
    {
        $users = User::orderByDesc('id_user')->get();

        return view('admin.users.index', compact('users'));
    }

    // rom tambah edit
    public function addEdit($id = null)
    {
        $user = $id ? $this->findUser($id) : null;

        if ($id && ! $user) {
            return $this->backWithError('Data pengguna tidak ditemukan.');
        }

        return view('admin.users.form', compact('user'));
    }

    // simpan data baru / ubah pengguna
    public function save(Request $request, $id = null)
    {
        $user = $id ? $this->findUser($id) : new User();

        if ($id && ! $user) {
            return $this->backWithError('Data pengguna tidak ditemukan.');
        }

        $validated = $request->validate(
            $this->rules($user->id_user ?? null),
            $this->messages()
        );

        $user->username = $validated['username'];
        $user->role     = $validated['role'];

        // Password hanya diubah kalau diisi
        if (! empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                $id
                    ? 'Data pengguna berhasil diperbarui.'
                    : 'Data pengguna berhasil ditambahkan.'
            );
    }

    // detail pengguna
    public function show($id)
    {
        $user = $this->findUser($id);

        if (! $user) {
            return $this->backWithError('Data pengguna tidak ditemukan.');
        }

        return view('admin.users.show', compact('user'));
    }

    // hapus pengguna
    public function destroy($id)
    {
        $user = $this->findUser($id);

        if (! $user) {
            return $this->backWithError('Data pengguna tidak ditemukan.');
        }

        // Cegah hapus akun sendiri
        if ((int) $user->id_user === (int) Auth::id()) {
            return $this->backWithError('Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil dihapus.');
    }

    // cari user berdasarkan id yang di enkripsi
    private function findUser(string $encryptedId): ?User
    {
        try {
            $id = Crypt::decryptString($encryptedId);

            return User::where('id_user', $id)->first();
        } catch (\Throwable $e) {
            return null;
        }
    }

    // Redirect ke index dengan pesan error.
    private function backWithError(string $message)
    {
        return redirect()
            ->route('admin.users.index')
            ->with('error', $message);
    }

    // aturan validasi
    private function rules(?int $userId): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'username')->ignore($userId, 'id_user'),
            ],
            'role' => [
                'required',
                Rule::in(['Admin', 'Operator']),
            ],
            'password' => $userId
                ? ['nullable', 'string', 'min:6']
                : ['required', 'string', 'min:6'],
        ];
    }

    // pesan validasi
    private function messages(): array
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.max'      => 'Username maksimal 30 karakter.',
            'username.unique'   => 'Username sudah digunakan.',

            'role.required' => 'Role pengguna wajib dipilih.',
            'role.in'       => 'Role hanya boleh Admin atau Operator.',

            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ];
    }
}
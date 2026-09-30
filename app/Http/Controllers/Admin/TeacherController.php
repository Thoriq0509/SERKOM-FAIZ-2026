<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class TeacherController extends Controller
{
    // Daftar guru
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    // Form tambah guru
    public function create()
    {
        return view('admin.teachers.form');
    }

    // Simpan guru baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_guru' => ['required', 'string', 'max:40'],
            'nip'       => ['nullable', 'string', 'max:15', Rule::unique('teachers', 'nip')],
            'mapel'     => ['nullable', 'string', 'max:40'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'nama_guru.max'      => 'Nama guru maksimal 40 karakter.',

            'nip.unique' => 'NIP sudah digunakan oleh guru lain.',
            'nip.max'    => 'NIP maksimal 15 karakter.',

            'mapel.max' => 'Mata pelajaran maksimal 40 karakter.',

            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max'   => 'Ukuran foto maksimal 2 MB.',
        ]);

        $teacher = new Teacher();
        $teacher->nama_guru = $validated['nama_guru'];
        $teacher->nip       = $validated['nip'] ?? null;
        $teacher->mapel     = $validated['mapel'] ?? null;

        // Upload foto
        if ($request->hasFile('foto')) {
            $teacher->foto = $request->file('foto')->store('teachers', 'public');
        }

        $teacher->save();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    // Detail guru
    public function show($encryptedId)
    {
        $teacher = $this->findTeacherByEncryptedId($encryptedId);

        if (! $teacher) {
            return $this->backWithError('Data guru tidak ditemukan.');
        }

        return view('admin.teachers.show', compact('teacher'));
    }

    // Form edit guru
    public function edit($encryptedId)
    {
        $teacher = $this->findTeacherByEncryptedId($encryptedId);

        if (! $teacher) {
            return $this->backWithError('Data guru tidak ditemukan.');
        }

        return view('admin.teachers.form', compact('teacher'));
    }

    // Update data guru
    public function update(Request $request, $encryptedId)
    {
        $teacher = $this->findTeacherByEncryptedId($encryptedId);

        if (! $teacher) {
            return $this->backWithError('Data guru tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_guru' => ['required', 'string', 'max:40'],
            'nip'       => [
                'nullable', 'string', 'max:15',
                Rule::unique('teachers', 'nip')->ignore($teacher->getKey(), $teacher->getKeyName()),
            ],
            'mapel' => ['nullable', 'string', 'max:40'],
            'foto'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'nama_guru.max'      => 'Nama guru maksimal 40 karakter.',

            'nip.unique' => 'NIP sudah digunakan oleh guru lain.',
            'nip.max'    => 'NIP maksimal 15 karakter.',

            'mapel.max' => 'Mata pelajaran maksimal 40 karakter.',

            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max'   => 'Ukuran foto maksimal 2 MB.',
        ]);

        $teacher->nama_guru = $validated['nama_guru'];
        $teacher->nip       = $validated['nip'] ?? null;
        $teacher->mapel     = $validated['mapel'] ?? null;

        // Upload foto baru + hapus yang lama
        if ($request->hasFile('foto')) {
            if ($teacher->foto && Storage::disk('public')->exists($teacher->foto)) {
                Storage::disk('public')->delete($teacher->foto);
            }

            $teacher->foto = $request->file('foto')->store('teachers', 'public');
        }

        $teacher->save();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    // Hapus data guru
    public function destroy($encryptedId)
    {
        $teacher = $this->findTeacherByEncryptedId($encryptedId);

        if (! $teacher) {
            return $this->backWithError('Data guru tidak ditemukan.');
        }

        // Hapus foto
        if ($teacher->foto && Storage::disk('public')->exists($teacher->foto)) {
            Storage::disk('public')->delete($teacher->foto);
        }

        $teacher->delete();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    // Cari guru berdasarkan encrypted ID
    private function findTeacherByEncryptedId($encryptedId)
    {
        try {
            $teacherId = Crypt::decryptString($encryptedId);

            return Teacher::find($teacherId);
        } catch (Throwable $e) {
            return null;
        }
    }

    // Redirect ke index dengan pesan error
    private function backWithError(string $message)
    {
        return redirect()
            ->route('admin.guru')
            ->with('error', $message);
    }
}
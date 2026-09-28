<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Menampilkan seluruh data guru.
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Menampilkan form tambah guru.
     */
    public function create()
    {
        return view('admin.teachers.form');
    }

    /**
     * Menyimpan data guru baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('teachers', 'nip'),
            ],
            'mapel' => 'nullable|string|max:40',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'nama_guru.max' => 'Nama guru maksimal 40 karakter.',

            'nip.unique' => 'NIP sudah digunakan oleh guru lain.',
            'nip.max' => 'NIP maksimal 15 karakter.',

            'mapel.max' => 'Mata pelajaran maksimal 40 karakter.',

            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $teacher = new Teacher();

        $teacher->nama_guru = $request->nama_guru;
        $teacher->nip = $request->nip;
        $teacher->mapel = $request->mapel;

        /**
         * Upload foto guru.
         */
        if ($request->hasFile('foto')) {
            $teacher->foto = $request->file('foto')
                ->store('teachers', 'public');
        }

        $teacher->save();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail guru.
     */
    public function show($id)
    {
        try {
            $teacherId = Crypt::decrypt($id);

            $teacher = Teacher::findOrFail($teacherId);

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Menampilkan form edit guru.
     */
    public function edit($id)
    {
        try {
            $teacherId = Crypt::decrypt($id);

            $teacher = Teacher::findOrFail($teacherId);

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return view('admin.teachers.form', compact('teacher'));
    }

    /**
     * Memperbarui data guru.
     */
    public function update(Request $request, $id)
    {
        try {
            $teacherId = Crypt::decrypt($id);

            $teacher = Teacher::findOrFail($teacherId);

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        $request->validate([
            'nama_guru' => 'required|string|max:40',
            'nip' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('teachers', 'nip')
                    ->ignore($teacher->id, 'id'),
            ],
            'mapel' => 'nullable|string|max:40',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'nama_guru.max' => 'Nama guru maksimal 40 karakter.',

            'nip.unique' => 'NIP sudah digunakan oleh guru lain.',
            'nip.max' => 'NIP maksimal 15 karakter.',

            'mapel.max' => 'Mata pelajaran maksimal 40 karakter.',

            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $teacher->nama_guru = $request->nama_guru;
        $teacher->nip = $request->nip;
        $teacher->mapel = $request->mapel;

        /**
         * Jika upload foto baru,
         * hapus foto lama terlebih dahulu.
         */
        if ($request->hasFile('foto')) {

            if (
                $teacher->foto &&
                Storage::disk('public')->exists($teacher->foto)
            ) {
                Storage::disk('public')->delete($teacher->foto);
            }

            $teacher->foto = $request->file('foto')
                ->store('teachers', 'public');
        }

        $teacher->save();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Menghapus data guru.
     */
    public function destroy($id)
    {
        try {
            $teacherId = Crypt::decrypt($id);

            $teacher = Teacher::findOrFail($teacherId);

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.guru')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        /**
         * Hapus foto guru dari storage.
         */
        if (
            $teacher->foto &&
            Storage::disk('public')->exists($teacher->foto)
        ) {
            Storage::disk('public')->delete($teacher->foto);
        }

        /**
         * Hapus data guru.
         */
        $teacher->delete();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
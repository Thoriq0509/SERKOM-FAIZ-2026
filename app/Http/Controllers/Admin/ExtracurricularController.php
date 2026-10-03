<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    // Daftar ekstrakurikuler
    public function index()
    {
        $extracurriculars = Extracurricular::with('pembina')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.extracurricular.index', compact('extracurriculars'));
    }

    // Form tambah ekstrakurikuler
    public function create()
    {
        return view('admin.extracurricular.form', [
            'extracurricular' => new Extracurricular(),
            'isEdit'          => false,
            'teachers'        => Teacher::orderBy('nama_guru')->get(),  // ← TAMBAH
        ]);
    }

    // Simpan ekstrakurikuler baru
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->rules(),
            $this->messages()
        );

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('extracurricular', 'public');
        }

        Extracurricular::create($validated);

        return redirect()
            ->route('admin.extracurricular.index')
            ->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

    // Detail ekstrakurikuler
    public function show($id)
    {
        $extracurricular = $this->findExtracurricular($id);

        if (! $extracurricular) {
            return $this->backWithError('Data ekstrakurikuler tidak ditemukan.');
        }

        return view('admin.extracurricular.show', compact('extracurricular'));
    }

    // Form edit ekstrakurikuler
    public function edit($id)
    {
        $extracurricular = $this->findExtracurricular($id);

        if (! $extracurricular) {
            return $this->backWithError('Data ekstrakurikuler tidak ditemukan.');
        }

        return view('admin.extracurricular.form', [
            'extracurricular' => $extracurricular,
            'isEdit'          => true,
            'teachers'        => Teacher::orderBy('nama_guru')->get(),  // ← TAMBAH
        ]);
    }

    // Update ekstrakurikuler
    public function update(Request $request, $id)
    {
        $extracurricular = $this->findExtracurricular($id);

        if (! $extracurricular) {
            return $this->backWithError('Data ekstrakurikuler tidak ditemukan.');
        }

        $validated = $request->validate(
            $this->rules(),
            $this->messages()
        );

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($extracurricular->gambar && Storage::disk('public')->exists($extracurricular->gambar)) {
                Storage::disk('public')->delete($extracurricular->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('extracurricular', 'public');
        }

        $extracurricular->update($validated);

        return redirect()
            ->route('admin.extracurricular.index')
            ->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    // Hapus ekstrakurikuler
    public function destroy($id)
    {
        $extracurricular = $this->findExtracurricular($id);

        if (! $extracurricular) {
            return $this->backWithError('Data ekstrakurikuler tidak ditemukan.');
        }

        // Hapus gambar
        if ($extracurricular->gambar && Storage::disk('public')->exists($extracurricular->gambar)) {
            Storage::disk('public')->delete($extracurricular->gambar);
        }

        $extracurricular->delete();

        return redirect()
            ->route('admin.extracurricular.index')
            ->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }

    // =========================================================
    // HELPERS
    // =========================================================

    // Cari ekstrakurikuler berdasarkan encrypted ID
    private function findExtracurricular(string $encryptedId): ?Extracurricular
    {
        try {
            return Extracurricular::find(Crypt::decryptString($encryptedId));
        } catch (\Throwable $e) {
            return null;
        }
    }

    // Redirect ke index dengan pesan error
    private function backWithError(string $message)
    {
        return redirect()
            ->route('admin.extracurricular.index')
            ->with('error', $message);
    }

    // Aturan validasi
    private function rules(): array
    {
        return [
            'nama_ekskul'    => ['required', 'string', 'max:40'],
            'id_guru'        => ['nullable', 'exists:teachers,id'],  // ← DIUBAH
            'jadwal_latihan' => ['nullable', 'string', 'max:40'],
            'deskripsi'      => ['nullable', 'string'],
            'gambar'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    // Pesan validasi
    private function messages(): array
    {
        return [
            'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'nama_ekskul.max'      => 'Nama ekstrakurikuler maksimal 40 karakter.',

            'id_guru.exists'     => 'Pembina yang dipilih tidak valid.',  // ← DIUBAH
            'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',

            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max'   => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
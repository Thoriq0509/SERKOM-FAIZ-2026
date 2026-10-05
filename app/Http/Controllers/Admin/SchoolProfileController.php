<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    // Tampilkan profil sekolah
    public function index()
    {
        $schoolProfile = SchoolProfile::first() ?? new SchoolProfile();

        return view('admin.school_profile.index', compact('schoolProfile'));
    }

    // Form edit profil sekolah
    public function edit()
    {
        $schoolProfile = SchoolProfile::first();

        if (! $schoolProfile) {
            $schoolProfile = SchoolProfile::create([
                'nama_sekolah'    => '',
                'kepala_sekolah'  => '',
                'npsn'            => '',
                'alamat'          => '',
                'kontak'          => '',
                'email'           => '',
                'visi'            => '',   // ← GANTI dari visi_misi
                'misi'            => '',   // ← TAMBAH
                'tahun_berdiri'   => null,
                'deskripsi'       => null,
                'logo'            => null,
                'foto'            => null,
                'foto_kepsek'     => null,
                'sambutan_kepsek' => null,
            ]);
        }

        return view('admin.school_profile.form', compact('schoolProfile'));
    }

    // Simpan perubahan profil sekolah
    public function update(Request $request)
    {
        $validated = $request->validate(
            $this->rules(),
            $this->messages()
        );

        $schoolProfile = SchoolProfile::first() ?? new SchoolProfile();

        // Isi data utama
        $schoolProfile->nama_sekolah    = $validated['nama_sekolah'];
        $schoolProfile->kepala_sekolah  = $validated['kepala_sekolah'];
        $schoolProfile->npsn            = $validated['npsn'];
        $schoolProfile->alamat          = $validated['alamat'];
        $schoolProfile->kontak          = $validated['kontak'];
        $schoolProfile->email           = $validated['email'] ?? null;
        $schoolProfile->visi            = $validated['visi'];   // ← GANTI
        $schoolProfile->misi            = $validated['misi'];   // ← TAMBAH
        $schoolProfile->tahun_berdiri   = $validated['tahun_berdiri'];
        $schoolProfile->deskripsi       = $validated['deskripsi'] ?? null;
        $schoolProfile->sambutan_kepsek = $validated['sambutan_kepsek'] ?? null;

        // Upload logo baru
        if ($request->hasFile('logo')) {
            $this->deleteFile($schoolProfile->logo);
            $schoolProfile->logo = $request->file('logo')->store('profil', 'public');
        }

        // Upload foto gedung baru
        if ($request->hasFile('foto')) {
            $this->deleteFile($schoolProfile->foto);
            $schoolProfile->foto = $request->file('foto')->store('profil', 'public');
        }

        // Upload foto kepala sekolah baru
        if ($request->hasFile('foto_kepsek')) {
            $this->deleteFile($schoolProfile->foto_kepsek);
            $schoolProfile->foto_kepsek = $request->file('foto_kepsek')->store('profil', 'public');
        }

        $schoolProfile->save();

        return redirect()
            ->route('admin.school_profile')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    // Hapus profil sekolah
    public function destroy()
    {
        $schoolProfile = SchoolProfile::first();

        if (! $schoolProfile) {
            return redirect()
                ->route('admin.school_profile')
                ->with('error', 'Data profil sekolah tidak ditemukan.');
        }

        $this->deleteFile($schoolProfile->logo);
        $this->deleteFile($schoolProfile->foto);
        $this->deleteFile($schoolProfile->foto_kepsek);

        $schoolProfile->delete();

        return redirect()
            ->route('admin.school_profile')
            ->with('success', 'Profil sekolah berhasil dihapus.');
    }

    // Hapus file dari storage (kalau ada)
    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    // Aturan validasi
    private function rules(): array
    {
        return [
            'nama_sekolah'    => ['required', 'string', 'max:40'],
            'kepala_sekolah'  => ['required', 'string', 'max:40'],
            'npsn'            => ['required', 'string', 'max:10'],
            'alamat'          => ['required', 'string'],
            'kontak'          => ['required', 'string', 'max:15'],
            'email'           => ['nullable', 'email', 'max:100'],

            'visi'            => ['required', 'string'],   // ← GANTI dari visi_misi
            'misi'            => ['required', 'string'],   // ← TAMBAH

            'tahun_berdiri'   => ['required', 'digits:4', 'integer'],
            'deskripsi'       => ['nullable', 'string'],
            'sambutan_kepsek' => ['nullable', 'string'],
            'logo'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'foto'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'foto_kepsek'     => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    // Pesan validasi
    private function messages(): array
    {
        return [
            'nama_sekolah.required'   => 'Nama sekolah wajib diisi.',
            'nama_sekolah.max'        => 'Nama sekolah maksimal 40 karakter.',

            'kepala_sekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'kepala_sekolah.max'      => 'Nama kepala sekolah maksimal 40 karakter.',

            'npsn.required' => 'NPSN wajib diisi.',
            'npsn.max'      => 'NPSN maksimal 10 karakter.',

            'alamat.required' => 'Alamat wajib diisi.',

            'kontak.required' => 'Kontak wajib diisi.',
            'kontak.max'      => 'Kontak maksimal 15 karakter.',

            'email.email' => 'Format email tidak valid.',
            'email.max'   => 'Email maksimal 100 karakter.',

            'visi.required' => 'Visi wajib diisi.',   // ← GANTI
            'misi.required' => 'Misi wajib diisi.',   // ← TAMBAH

            'tahun_berdiri.required' => 'Tahun berdiri wajib diisi.',
            'tahun_berdiri.digits'   => 'Tahun berdiri harus 4 digit.',
            'tahun_berdiri.integer'  => 'Tahun berdiri harus berupa angka.',

            'logo.image' => 'Logo harus berupa gambar.',
            'logo.mimes' => 'Logo harus berformat JPG, JPEG, atau PNG.',
            'logo.max'   => 'Ukuran logo maksimal 2 MB.',

            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max'   => 'Ukuran foto maksimal 2 MB.',

            'foto_kepsek.image' => 'Foto kepala sekolah harus berupa gambar.',
            'foto_kepsek.mimes' => 'Foto kepala sekolah harus berformat JPG, JPEG, atau PNG.',
            'foto_kepsek.max'   => 'Ukuran foto kepala sekolah maksimal 2 MB.',
        ];
    }
}
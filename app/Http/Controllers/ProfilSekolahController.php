<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    /**
     * Menampilkan profil sekolah.
     */
    public function index()
    {
        $profilSekolah = SchoolProfile::first();

        // Jika data profil belum tersedia, buat data awal.
        if (!$profilSekolah) {
            $profilSekolah = SchoolProfile::create([
                'nama_sekolah'   => 'Nama Sekolah',
                'kepala_sekolah' => 'Kepala Sekolah',
                'npsn'           => '12345678',
                'alamat'         => 'Jl. Pendidikan No. 1',
                'kontak'         => '08123456789',
                'visi_misi'      => "Visi:\nMenjadi sekolah unggulan yang berkarakter dan berdaya saing global.\n\nMisi:\n1. Menyelenggarakan pendidikan berkualitas.\n2. Mengembangkan potensi siswa secara optimal.",
                'tahun_berdiri'  => date('Y'),
                'deskripsi'      => 'Deskripsi singkat profil sekolah dan sambutan kepala sekolah.',
            ]);
        }

        return view('admin.school_profile.index', compact('profilSekolah'));
    }

    /**
     * Menampilkan form edit profil sekolah.
     */
    public function edit()
    {
        $profilSekolah = SchoolProfile::first();

        if (!$profilSekolah) {
            return redirect()
                ->route('admin.school_profile')
                ->with('error', 'Data profil sekolah belum tersedia.');
        }

        return view(
            'admin.school_profile.edit',
            compact('profilSekolah')
        );
    }

    /**
     * Memperbarui data profil sekolah.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah'   => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'npsn'           => 'required|string|max:10',
            'alamat'         => 'required|string',
            'kontak'         => 'required|string|max:15',
            'visi_misi'      => 'required|string',
            'tahun_berdiri'  => 'required|digits:4|integer',
            'deskripsi'      => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_sekolah.required'   => 'Nama sekolah wajib diisi.',
            'nama_sekolah.max'        => 'Nama sekolah maksimal 40 karakter.',
            'kepala_sekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'kepala_sekolah.max'      => 'Nama kepala sekolah maksimal 40 karakter.',
            'npsn.required'           => 'NPSN wajib diisi.',
            'npsn.max'                => 'NPSN maksimal 10 karakter.',
            'alamat.required'         => 'Alamat sekolah wajib diisi.',
            'kontak.required'         => 'Nomor kontak telepon wajib diisi.',
            'kontak.max'              => 'Kontak maksimal 15 karakter.',
            'visi_misi.required'      => 'Visi dan misi wajib diisi.',
            'tahun_berdiri.required'  => 'Tahun berdiri wajib diisi.',
            'tahun_berdiri.digits'    => 'Tahun berdiri harus 4 digit angka.',
            'logo.image'              => 'Logo harus berupa file gambar JPG atau PNG.',
            'logo.mimes'              => 'Logo harus berformat JPG, JPEG, atau PNG.',
            'logo.max'                => 'Ukuran logo maksimal 2 MB.',
            'foto.image'              => 'Foto gedung harus berupa file gambar JPG atau PNG.',
            'foto.mimes'              => 'Foto gedung harus berformat JPG, JPEG, atau PNG.',
            'foto.max'                => 'Ukuran foto gedung maksimal 2 MB.',
        ]);

        // Ambil data profil sekolah.
        $profilSekolah = SchoolProfile::first();

        // Jika data belum ada, buat instance baru.
        if (!$profilSekolah) {
            $profilSekolah = new SchoolProfile();
        }

        // Simpan data teks.
        $profilSekolah->nama_sekolah   = $request->nama_sekolah;
        $profilSekolah->kepala_sekolah = $request->kepala_sekolah;
        $profilSekolah->npsn           = $request->npsn;
        $profilSekolah->alamat         = $request->alamat;
        $profilSekolah->kontak         = $request->kontak;
        $profilSekolah->visi_misi      = $request->visi_misi;
        $profilSekolah->tahun_berdiri  = $request->tahun_berdiri;
        $profilSekolah->deskripsi      = $request->deskripsi;

        // Upload logo.
        if ($request->hasFile('logo')) {

            if (
                $profilSekolah->logo &&
                Storage::disk('public')->exists($profilSekolah->logo)
            ) {
                Storage::disk('public')->delete($profilSekolah->logo);
            }

            $profilSekolah->logo = $request->file('logo')
                ->store('profil', 'public');
        }

        // Upload foto gedung.
        if ($request->hasFile('foto')) {

            if (
                $profilSekolah->foto &&
                Storage::disk('public')->exists($profilSekolah->foto)
            ) {
                Storage::disk('public')->delete($profilSekolah->foto);
            }

            $profilSekolah->foto = $request->file('foto')
                ->store('profil', 'public');
        }

        // Simpan ke database.
        $profilSekolah->save();

        return redirect()
            ->route('admin.school_profile')
            ->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    /**
     * Menghapus data profil sekolah.
     */
    public function destroy()
    {
        $profilSekolah = SchoolProfile::first();

        if (!$profilSekolah) {
            return redirect()
                ->route('admin.school_profile')
                ->with('error', 'Data profil sekolah tidak ditemukan.');
        }

        // Hapus logo dari storage.
        if (
            $profilSekolah->logo &&
            Storage::disk('public')->exists($profilSekolah->logo)
        ) {
            Storage::disk('public')->delete($profilSekolah->logo);
        }

        // Hapus foto gedung dari storage.
        if (
            $profilSekolah->foto &&
            Storage::disk('public')->exists($profilSekolah->foto)
        ) {
            Storage::disk('public')->delete($profilSekolah->foto);
        }

        // Hapus data dari database.
        $profilSekolah->delete();

        return redirect()
            ->route('admin.school_profile')
            ->with('success', 'Profil sekolah berhasil dihapus.');
    }
}
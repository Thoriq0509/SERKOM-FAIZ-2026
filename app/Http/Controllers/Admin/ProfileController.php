<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 1. Menampilkan halaman utama profil (Read)
    public function index()
    {
        $profil = SchoolProfile::first() ?? new SchoolProfile();
        return view('admin.school_profile.index', compact('profil'));
    }

    // 2. Menampilkan halaman form edit (Edit View)
    public function edit()
    {
        $profil = SchoolProfile::first() ?? new SchoolProfile();
        return view('admin.school_profile.edit', compact('profil'));
    }

    // 3. Menyimpan atau Update data profil
    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|max:40',
            'kepala_sekolah' => 'nullable|max:40',
            'npsn' => 'nullable|max:10',
            'kontak' => 'nullable|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profil = SchoolProfile::first();
        if (!$profil) {
            $profil = new SchoolProfile();
        }

        // Menyimpan data teks
        $profil->nama_sekolah = $request->nama_sekolah;
        $profil->kepala_sekolah = $request->kepala_sekolah;
        $profil->npsn = $request->npsn;
        $profil->alamat = $request->alamat;
        $profil->kontak = $request->kontak;
        $profil->visi_misi = $request->visi_misi;
        $profil->tahun_berdiri = $request->tahun_berdiri;
        $profil->deskripsi = $request->deskripsi;

        // Proses Upload Foto Utama
        if ($request->hasFile('foto')) {
            if ($profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            $profil->foto = $request->file('foto')->store('profil', 'public');
        }

        // Proses Upload Logo
        if ($request->hasFile('logo')) {
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            $profil->logo = $request->file('logo')->store('profil', 'public');
        }

        $profil->save();

        return redirect()->route('admin.school_profile')->with('success', 'Profil Sekolah berhasil diperbarui!');
    }

    // 4. Menghapus / mereset data profil (Delete)
    public function destroy()
    {
        $profil = SchoolProfile::first();
        
        if ($profil) {
            // Hapus file foto & logo dari storage jika ada
            if ($profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }
            
            $profil->delete();
        }

        return redirect()->route('admin.school_profile')->with('success', 'Profil Sekolah berhasil dikosongkan/dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    /**
     * Menampilkan profil sekolah.
     */
    public function index()
    {
        $schoolProfile = SchoolProfile::first();

        if (!$schoolProfile) {
            $schoolProfile = new SchoolProfile();

            $schoolProfile->nama_sekolah = '';
            $schoolProfile->kepala_sekolah = '';
            $schoolProfile->npsn = '';
            $schoolProfile->alamat = '';
            $schoolProfile->kontak = '';
            $schoolProfile->visi_misi = '';
            $schoolProfile->tahun_berdiri = '';
            $schoolProfile->deskripsi = '';
            $schoolProfile->logo = null;
            $schoolProfile->foto = null;
        }

        return view(
            'admin.school_profile.index',
            compact('schoolProfile')
        );
    }


    /**
     * Menampilkan form edit profil sekolah.
     */
    public function edit()
    {
        $schoolProfile = SchoolProfile::first();

        if (!$schoolProfile) {
            $schoolProfile = SchoolProfile::create([
                'nama_sekolah' => '',
                'kepala_sekolah' => '',
                'npsn' => '',
                'alamat' => '',
                'kontak' => '',
                'visi_misi' => '',
                'tahun_berdiri' => null,
                'deskripsi' => null,
                'logo' => null,
                'foto' => null,
            ]);
        }

        return view(
            'admin.school_profile.form',
            compact('schoolProfile')
        );
    }


    /**
     * Menyimpan perubahan profil sekolah.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => [
                'required',
                'string',
                'max:40',
            ],

            'kepala_sekolah' => [
                'required',
                'string',
                'max:40',
            ],

            'npsn' => [
                'required',
                'string',
                'max:10',
            ],

            'alamat' => [
                'required',
                'string',
            ],

            'kontak' => [
                'required',
                'string',
                'max:15',
            ],

            'visi_misi' => [
                'required',
                'string',
            ],

            'tahun_berdiri' => [
                'required',
                'digits:4',
                'integer',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ]);


        $schoolProfile = SchoolProfile::first();

        if (!$schoolProfile) {
            $schoolProfile = new SchoolProfile();
        }


        // ==========================================
        // DATA SEKOLAH
        // ==========================================
        $schoolProfile->nama_sekolah = $validated['nama_sekolah'];

        $schoolProfile->kepala_sekolah = $validated['kepala_sekolah'];

        $schoolProfile->npsn = $validated['npsn'];

        $schoolProfile->alamat = $validated['alamat'];

        $schoolProfile->kontak = $validated['kontak'];

        $schoolProfile->visi_misi = $validated['visi_misi'];

        $schoolProfile->tahun_berdiri = $validated['tahun_berdiri'];

        $schoolProfile->deskripsi =
            $validated['deskripsi'] ?? null;


        // ==========================================
        // UPDATE LOGO
        // ==========================================
        if ($request->hasFile('logo')) {

            if (
                $schoolProfile->logo &&
                Storage::disk('public')->exists(
                    $schoolProfile->logo
                )
            ) {
                Storage::disk('public')->delete(
                    $schoolProfile->logo
                );
            }

            $schoolProfile->logo = $request
                ->file('logo')
                ->store('profil', 'public');
        }


        // ==========================================
        // UPDATE FOTO
        // ==========================================
        if ($request->hasFile('foto')) {

            if (
                $schoolProfile->foto &&
                Storage::disk('public')->exists(
                    $schoolProfile->foto
                )
            ) {
                Storage::disk('public')->delete(
                    $schoolProfile->foto
                );
            }

            $schoolProfile->foto = $request
                ->file('foto')
                ->store('profil', 'public');
        }


        // ==========================================
        // SIMPAN
        // ==========================================
        $schoolProfile->save();


        return redirect()
            ->route('admin.school_profile')
            ->with(
                'success',
                'Profil sekolah berhasil diperbarui.'
            );
    }


    /**
     * Menghapus profil sekolah.
     */
    public function destroy()
    {
        $schoolProfile = SchoolProfile::first();

        if (!$schoolProfile) {
            return redirect()
                ->route('admin.school_profile')
                ->with(
                    'error',
                    'Data profil sekolah tidak ditemukan.'
                );
        }


        // ==========================================
        // HAPUS LOGO
        // ==========================================
        if (
            $schoolProfile->logo &&
            Storage::disk('public')->exists(
                $schoolProfile->logo
            )
        ) {
            Storage::disk('public')->delete(
                $schoolProfile->logo
            );
        }


        // ==========================================
        // HAPUS FOTO
        // ==========================================
        if (
            $schoolProfile->foto &&
            Storage::disk('public')->exists(
                $schoolProfile->foto
            )
        ) {
            Storage::disk('public')->delete(
                $schoolProfile->foto
            );
        }


        // ==========================================
        // HAPUS DATA DATABASE
        // ==========================================
        $schoolProfile->delete();


        return redirect()
            ->route('admin.school_profile')
            ->with(
                'success',
                'Profil sekolah berhasil dihapus.'
            );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Panggil semua model yang dibutuhkan
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Extracurricular;
use App\Models\News;
use App\Models\Gallery;
use App\Models\SchoolProfile;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil data statistik (jumlah)
        $jumlahGuru = Teacher::count();
        $jumlahSiswa = Student::count();
        $jumlahEkskul = Extracurricular::count();

        // 2. Mengambil profil sekolah (ambil baris pertama saja)
        $profil = SchoolProfile::first();

        // 3. Mengambil data terbaru untuk tabel di dashboard (limit 3-5 data)
        $beritaTerbaru = News::latest('tanggal')->limit(3)->get();
        $galeriTerbaru = Gallery::latest('tanggal')->limit(3)->get();

        // 4. Mengirim data ke view dashboard
        return view('admin.dashboard', compact(
            'jumlahGuru', 
            'jumlahSiswa', 
            'jumlahEkskul', 
            'profil', 
            'beritaTerbaru', 
            'galeriTerbaru'
        ));
    }
}
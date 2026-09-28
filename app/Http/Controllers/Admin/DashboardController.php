<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Extracurricular;
use App\Models\News;
use App\Models\Gallery;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin.
     */
    public function index()
    {
        // ================================
        // DATA PROFIL SEKOLAH
        // ================================
        $profilSekolah = SchoolProfile::first();

        // ================================
        // TOTAL DATA
        // ================================
        $totalPengelola = User::count();
        $totalGuru = Teacher::count();
        $totalSiswa = Student::count();
        $totalEkstrakurikuler = Extracurricular::count();
        $totalBerita = News::count();
        $totalGaleri = Gallery::count();

        // ================================
        // BERITA TERBARU
        // ================================
        $beritaTerbaru = News::latest()
            ->take(5)
            ->get();

        // ================================
        // GALERI TERBARU
        // ================================
        $galeriTerbaru = Gallery::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'profilSekolah',
            'totalPengelola',
            'totalGuru',
            'totalSiswa',
            'totalEkstrakurikuler',
            'totalBerita',
            'totalGaleri',
            'beritaTerbaru',
            'galeriTerbaru'
        ));
    }
}
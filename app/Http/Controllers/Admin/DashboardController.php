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
    // Tampilkan dashboard admin
    public function index()
    {
        // Data profil sekolah
        $profilSekolah = SchoolProfile::first();

        // Total data
        $totalPengelola       = User::count();
        $totalGuru            = Teacher::count();
        $totalSiswa           = Student::count();
        $totalEkstrakurikuler = Extracurricular::count();
        $totalBerita          = News::count();
        $totalGaleri          = Gallery::count();

        // Berita terbaru
        $beritaTerbaru = News::latest()->take(5)->get();

        // Galeri terbaru
        $galeriTerbaru = Gallery::latest()->take(5)->get();

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
<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\SchoolProfile;
use App\Models\Teacher;
use App\Models\Extracurricular;

class LandingPageController extends Controller
{
    // Halaman beranda publik
    public function index()
    {
        $news = News::where('status', 'Publish')
            ->orderByDesc('tanggal')
            ->limit(3)
            ->get();

        $galleries = Gallery::orderByDesc('tanggal')
            ->limit(3)
            ->get();

        return view('landing.dashboard_page.dashboard', compact('news', 'galleries'));
    }

    // Halaman profil sekolah
    public function profile()
    {
        return view('landing.profile_page.profile');
    }

    // Halaman sejarah sekolah
    public function history()
    {
        return view('landing.profile_page.history');
    }

    // Halaman visi & misi
    public function visionMission()
    {
        return view('landing.profile_page.vision-mission');
    }

    // Halaman daftar guru
    public function teachers()
    {
        $teachers = Teacher::orderBy('nama_guru')->get();

        return view('landing.teachers_page.teachers', compact('teachers'));
    }

    // Halaman detail guru
    public function teacherShow(Teacher $teacher)
    {
        return view('landing.teachers_page.show', compact('teacher'));
    }

    // Halaman ekstrakurikuler
    public function extracurricular()
    {
        $extracurriculars = Extracurricular::with('pembina')
            ->orderBy('nama_ekskul')
            ->get();

        return view('landing.extracurricular_page.extracurricular', compact('extracurriculars'));
    }

    // Halaman detail ekstrakurikuler
    public function extracurricularShow(Extracurricular $extracurricular)
    {
        return view('landing.extracurricular_page.show', compact('extracurricular'));
    }

    // Halaman siswa
    public function students()
    {
        return view('landing.students_page.students');
    }

    // Halaman berita
    public function news()
    {
        $news = News::where('status', 'Publish')
            ->orderByDesc('tanggal')
            ->get();

        return view('landing.news_page.news', compact('news'));
    }

    // Halaman detail berita
    public function newsShow(News $news)
    {
        return view('landing.news_page.show', compact('news'));
    }

    // Halaman galeri
    public function gallery()
    {
        $galleries = Gallery::orderByDesc('tanggal')->get();

        return view('landing.gallery_page.gallery', compact('galleries'));
    }
}
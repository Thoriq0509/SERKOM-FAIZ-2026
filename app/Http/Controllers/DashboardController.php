<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman beranda publik
    public function index()
    {
        return view('landing.dashboard');
    }

    // Halaman profil sekolah (publik)
    public function profile()
    {
        return view('landing.profile');
    }

    public function history()
    {
        return view('landing.history');
    }

    public function visionMission()
    {
        return view('landing.vision-mission');
    }

    public function extracurricular()
    {
        return view('landing.extracurricular');
    }

    public function teachers()
    {
        return view('landing.teachers');
    }

    public function students()
    {
        return view('landing.students');
    }

    public function news()
    {
        return view('landing.news');
    }

    public function gallery()
    {
        return view('landing.gallery');
    }
}
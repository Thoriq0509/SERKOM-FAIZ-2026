<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman beranda publik
    public function index()
    {
        return view('public.dashboard');
    }

    // Halaman profil sekolah (publik)
    public function profile()
    {
        return view('public.profile');
    }

    public function extracurricular()
    {
        return view('public.extracurricular');
    }

    public function teachers()
    {
        return view('public.teachers');
    }

    public function students()
    {
        return view('public.students');
    }

    public function news()
    {
        return view('public.news');
    }

    public function gallery()
    {
        return view('public.gallery');
    }
}
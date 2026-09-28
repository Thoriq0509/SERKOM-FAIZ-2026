<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfilSekolahController;

// ==========================================
// 0. ROUTE PUBLIC
// ==========================================
Route::get('/', function () {
    return redirect()->route('login');
});


// ==========================================
// 1. ROUTE GUEST
// ==========================================
Route::middleware('guest')->group(function () {

    // Halaman Login
    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    // Proses Login
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.proses');
});


// ==========================================
// 2. ROUTE AUTHENTICATED
// ==========================================
Route::middleware('auth')->group(function () {

    // ==========================================
    // LOGOUT
    // ==========================================
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // ==========================================
    // ADMIN
    // ==========================================
    Route::prefix('admin')->group(function () {

        // ==========================================
        // DASHBOARD
        // Admin & Operator
        // ==========================================
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('role:Admin,Operator')
            ->name('dashboard');


        // ==========================================
        // PROFIL SEKOLAH
        // Hanya Admin
        // ==========================================
        Route::get('/profile', [ProfilSekolahController::class, 'index'])
            ->middleware('role:Admin')
            ->name('admin.school_profile');

        Route::get('/profile/edit', [ProfilSekolahController::class, 'edit'])
            ->middleware('role:Admin')
            ->name('admin.school_profile.edit');

        Route::put('/profile/update', [ProfilSekolahController::class, 'update'])
            ->middleware('role:Admin')
            ->name('admin.school_profile.update');

        Route::delete('/profile/delete', [ProfilSekolahController::class, 'destroy'])
            ->middleware('role:Admin')
            ->name('admin.school_profile.destroy');


        // ==========================================
        // DATA PENGELOLA
        // Hanya Admin
        // ==========================================

        // Daftar Data Pengelola
        Route::get('/users', [UserController::class, 'index'])
            ->middleware('role:Admin')
            ->name('admin.users.index');

        // Form Tambah Data Pengelola
        Route::get('/users/create', [UserController::class, 'addEdit'])
            ->middleware('role:Admin')
            ->name('admin.users.create');

        // Simpan Data Pengelola Baru
        Route::post('/users', [UserController::class, 'save'])
            ->middleware('role:Admin')
            ->name('admin.users.store');

        // Detail Data Pengelola
        Route::get('/users/{id}', [UserController::class, 'show'])
            ->middleware('role:Admin')
            ->name('admin.users.show');

        // Form Edit Data Pengelola
        Route::get('/users/{id}/edit', [UserController::class, 'addEdit'])
            ->middleware('role:Admin')
            ->name('admin.users.edit');

        // Update Data Pengelola
        Route::put('/users/{id}', [UserController::class, 'save'])
            ->middleware('role:Admin')
            ->name('admin.users.update');

        // Hapus Data Pengelola
        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->middleware('role:Admin')
            ->name('admin.users.destroy');


        // ==========================================
        // BERITA
        // Admin & Operator
        // ==========================================
        Route::get('/berita', function () {
            return view('admin.news.news');
        })
        ->middleware('role:Admin,Operator')
        ->name('admin.berita');


        // ==========================================
        // EKSTRAKULIKULER
        // Admin & Operator
        // ==========================================
        Route::get('/ekstrakulikuler', function () {
            return view('admin.Extracurricular.extracurricular');
        })
        ->middleware('role:Admin,Operator')
        ->name('admin.ekstrakulikuler');


        // ==========================================
        // GURU
        // Admin & Operator
        // ==========================================

        Route::get('/guru', [TeacherController::class, 'index'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru');

        Route::get('/guru/create', [TeacherController::class, 'create'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru.create');

        Route::post('/guru', [TeacherController::class, 'store'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru.store');

        Route::get('/guru/{id}', [TeacherController::class, 'show'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru.show');

        Route::get('/guru/{id}/edit', [TeacherController::class, 'edit'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru.edit');

        Route::put('/guru/{id}', [TeacherController::class, 'update'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru.update');

        Route::delete('/guru/{id}', [TeacherController::class, 'destroy'])
            ->middleware('role:Admin,Operator')
            ->name('admin.guru.destroy');


        // ==========================================
        // SISWA
        // Admin & Operator
        // ==========================================
        Route::get('/siswa', function () {
            return view('admin.students.students');
        })
        ->middleware('role:Admin,Operator')
        ->name('admin.siswa');


        // ==========================================
        // GALERI
        // Admin & Operator
        // ==========================================
        Route::get('/galeri', function () {
            return view('admin.galeries.galeries');
        })
        ->middleware('role:Admin,Operator')
        ->name('admin.galeri');

    });
});
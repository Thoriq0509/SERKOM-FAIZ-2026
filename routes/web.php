<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CekRole;

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
    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.proses');
});

// ==========================================
// 2. ROUTE AUTH
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
            ->middleware(CekRole::class . ':Admin,Operator')
            ->name('dashboard');


        // ==========================================
        // PROFIL SEKOLAH
        // Hanya Admin
        // ==========================================
        Route::get('/profil', [ProfileController::class, 'index'])
            ->middleware(CekRole::class . ':Admin')
            ->name('admin.school_profile');

        Route::get('/profil/edit', [ProfileController::class, 'edit'])
            ->middleware(CekRole::class . ':Admin')
            ->name('admin.school_profile.edit');

        Route::put('/profil/update', [ProfileController::class, 'update'])
            ->middleware(CekRole::class . ':Admin')
            ->name('admin.school_profile.update');

        Route::delete('/profil/delete', [ProfileController::class, 'destroy'])
            ->middleware(CekRole::class . ':Admin')
            ->name('admin.school_profile.destroy');


        // ==========================================
        // DATA USER
        // Hanya Admin
        // ==========================================
        Route::resource('/users', UserController::class)
            ->middleware(CekRole::class . ':Admin')
            ->names([
                'index'   => 'admin.users.index',
                'create'  => 'admin.users.create',
                'store'   => 'admin.users.store',
                'show'    => 'admin.users.show',
                'edit'    => 'admin.users.edit',
                'update'  => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]);


        // ==========================================
        // BERITA
        // Admin & Operator
        // ==========================================
        Route::get('/berita', function () {
            return view('admin.news.news');
        })
        ->middleware(CekRole::class . ':Admin,Operator')
        ->name('admin.berita');


        // ==========================================
        // EKSTRAKULIKULER
        // Admin & Operator
        // ==========================================
        Route::get('/ekstrakulikuler', function () {
            return view('admin.Extracurricular.extracurricular');
        })
        ->middleware(CekRole::class . ':Admin,Operator')
        ->name('admin.ekstrakulikuler');


        // ==========================================
        // GURU
        // Admin & Operator
        // Operator hanya bisa melihat
        // ==========================================
        Route::get('/guru', function () {
            return view('admin.teachers.teachers');
        })
        ->middleware(CekRole::class . ':Admin,Operator')
        ->name('admin.guru');


        // ==========================================
        // SISWA
        // Admin & Operator
        // Operator hanya bisa melihat
        // ==========================================
        Route::get('/siswa', function () {
            return view('admin.students.students');
        })
        ->middleware(CekRole::class . ':Admin,Operator')
        ->name('admin.siswa');


        // ==========================================
        // GALERI
        // Admin & Operator
        // ==========================================
        Route::get('/galeri', function () {
            return view('admin.galeries.galeries');
        })
        ->middleware(CekRole::class . ':Admin,Operator')
        ->name('admin.galeri');

    });
});
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SchoolProfileController;


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

    // ------------------------------------------
    // LOGIN
    // ------------------------------------------
    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

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
    // ADMIN AREA
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
        Route::get('/profil', [SchoolProfileController::class, 'index'])
            ->middleware('role:Admin')
            ->name('admin.school_profile');

        Route::get('/profil/edit', [SchoolProfileController::class, 'edit'])
            ->middleware('role:Admin')
            ->name('admin.school_profile.edit');

        Route::put('/profil/update', [SchoolProfileController::class, 'update'])
            ->middleware('role:Admin')
            ->name('admin.school_profile.update');

        Route::delete('/profil/delete', [SchoolProfileController::class, 'destroy'])
            ->middleware('role:Admin')
            ->name('admin.school_profile.destroy');


        // ==========================================
        // DATA PENGELOLA / USER
        // Hanya Admin
        // ==========================================
        Route::get('/users', [UserController::class, 'index'])
            ->middleware('role:Admin')
            ->name('admin.users.index');

        Route::get('/users/create', [UserController::class, 'addEdit'])
            ->middleware('role:Admin')
            ->name('admin.users.create');

        Route::post('/users', [UserController::class, 'save'])
            ->middleware('role:Admin')
            ->name('admin.users.store');

        Route::get('/users/{id}', [UserController::class, 'show'])
            ->middleware('role:Admin')
            ->name('admin.users.show');

        Route::get('/users/{id}/edit', [UserController::class, 'addEdit'])
            ->middleware('role:Admin')
            ->name('admin.users.edit');

        Route::put('/users/{id}', [UserController::class, 'save'])
            ->middleware('role:Admin')
            ->name('admin.users.update');

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
        // EKSTRAKURIKULER
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
        Route::get('/siswa', [StudentController::class, 'index'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa');

        Route::get('/siswa/create', [StudentController::class, 'create'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa.create');

        Route::post('/siswa', [StudentController::class, 'store'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa.store');

        Route::get('/siswa/{id}', [StudentController::class, 'show'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa.show');

        Route::get('/siswa/{id}/edit', [StudentController::class, 'edit'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa.edit');

        Route::put('/siswa/{id}', [StudentController::class, 'update'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa.update');

        Route::delete('/siswa/{id}', [StudentController::class, 'destroy'])
            ->middleware('role:Admin,Operator')
            ->name('admin.siswa.destroy');


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
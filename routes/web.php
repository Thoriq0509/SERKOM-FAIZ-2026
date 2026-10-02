<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Landing\LandingController;

// Public — redirect ke login
Route::get('/', fn () => redirect()->route('login'));

// Guest
Route::middleware('guest')->group(function () {
    Route::get ('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// Autekansi
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->group(function () {

        // Dashboard - Admin & Operator
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('role:Admin,Operator')
            ->name('dashboard');

        // Profil Sekolah - Admin & Operator
        Route::prefix('profil')->middleware('role:Admin,Operator')->group(function () {
            Route::get   ('/',       [SchoolProfileController::class, 'index'])  ->name('admin.school_profile');
            Route::get   ('/edit',   [SchoolProfileController::class, 'edit'])   ->name('admin.school_profile.edit');
            Route::put   ('/update', [SchoolProfileController::class, 'update']) ->name('admin.school_profile.update');
            Route::delete('/delete', [SchoolProfileController::class, 'destroy'])->name('admin.school_profile.destroy');
        });

        // Data Pengelola - Admin only
        Route::prefix('users')->middleware('role:Admin')->group(function () {
            Route::get   ('/',           [UserController::class, 'index'])  ->name('admin.users.index');
            Route::get   ('/create',     [UserController::class, 'addEdit'])->name('admin.users.create');
            Route::post  ('/',           [UserController::class, 'save'])   ->name('admin.users.store');
            Route::get   ('/{id}',       [UserController::class, 'show'])   ->name('admin.users.show');
            Route::get   ('/{id}/edit',  [UserController::class, 'addEdit'])->name('admin.users.edit');
            Route::put   ('/{id}',       [UserController::class, 'save'])   ->name('admin.users.update');
            Route::delete('/{id}',       [UserController::class, 'destroy'])->name('admin.users.destroy');
        });

        // Guru - Admin only
        Route::prefix('guru')->middleware('role:Admin')->group(function () {
            Route::get   ('/',          [TeacherController::class, 'index'])  ->name('admin.guru');
            Route::get   ('/create',    [TeacherController::class, 'create']) ->name('admin.guru.create');
            Route::post  ('/',          [TeacherController::class, 'store'])  ->name('admin.guru.store');
            Route::get   ('/{id}',      [TeacherController::class, 'show'])   ->name('admin.guru.show');
            Route::get   ('/{id}/edit', [TeacherController::class, 'edit'])   ->name('admin.guru.edit');
            Route::put   ('/{id}',      [TeacherController::class, 'update']) ->name('admin.guru.update');
            Route::delete('/{id}',      [TeacherController::class, 'destroy'])->name('admin.guru.destroy');
        });

        // Siswa - Admin only
        Route::prefix('siswa')->middleware('role:Admin')->group(function () {
            Route::get   ('/',          [StudentController::class, 'index'])  ->name('admin.siswa');
            Route::get   ('/create',    [StudentController::class, 'create']) ->name('admin.siswa.create');
            Route::post  ('/',          [StudentController::class, 'store'])  ->name('admin.siswa.store');
            Route::get   ('/{id}',      [StudentController::class, 'show'])   ->name('admin.siswa.show');
            Route::get   ('/{id}/edit', [StudentController::class, 'edit'])   ->name('admin.siswa.edit');
            Route::put   ('/{id}',      [StudentController::class, 'update']) ->name('admin.siswa.update');
            Route::delete('/{id}',      [StudentController::class, 'destroy'])->name('admin.siswa.destroy');
        });

        // News - Admin & Operator
        Route::prefix('news')->middleware('role:Admin,Operator')->group(function () {
            Route::get   ('/',          [NewsController::class, 'index'])  ->name('admin.news.index');
            Route::get   ('/create',    [NewsController::class, 'create']) ->name('admin.news.create');
            Route::post  ('/',          [NewsController::class, 'store'])  ->name('admin.news.store');
            Route::get   ('/{id}',      [NewsController::class, 'show'])   ->name('admin.news.show');
            Route::get   ('/{id}/edit', [NewsController::class, 'edit'])   ->name('admin.news.edit');
            Route::put   ('/{id}',      [NewsController::class, 'update']) ->name('admin.news.update');
            Route::delete('/{id}',      [NewsController::class, 'destroy'])->name('admin.news.destroy');
        });

        // Extracurricular - Admin & Operator
        Route::prefix('extracurricular')->middleware('role:Admin,Operator')->group(function () {
            Route::get   ('/',          [ExtracurricularController::class, 'index'])  ->name('admin.extracurricular.index');
            Route::get   ('/create',    [ExtracurricularController::class, 'create']) ->name('admin.extracurricular.create');
            Route::post  ('/',          [ExtracurricularController::class, 'store'])  ->name('admin.extracurricular.store');
            Route::get   ('/{id}',      [ExtracurricularController::class, 'show'])   ->name('admin.extracurricular.show');
            Route::get   ('/{id}/edit', [ExtracurricularController::class, 'edit'])   ->name('admin.extracurricular.edit');
            Route::put   ('/{id}',      [ExtracurricularController::class, 'update']) ->name('admin.extracurricular.update');
            Route::delete('/{id}',      [ExtracurricularController::class, 'destroy'])->name('admin.extracurricular.destroy');
        });

        // Gallery - Admin & Operator
        Route::prefix('gallery')->middleware('role:Admin,Operator')->group(function () {
            Route::get   ('/',          [GalleryController::class, 'index'])  ->name('admin.gallery.index');
            Route::get   ('/create',    [GalleryController::class, 'create']) ->name('admin.gallery.create');
            Route::post  ('/',          [GalleryController::class, 'store'])  ->name('admin.gallery.store');
            Route::get   ('/{id}',      [GalleryController::class, 'show'])   ->name('admin.gallery.show');
            Route::get   ('/{id}/edit', [GalleryController::class, 'edit'])   ->name('admin.gallery.edit');
            Route::put   ('/{id}',      [GalleryController::class, 'update']) ->name('admin.gallery.update');
            Route::delete('/{id}',      [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
        });

    });
});
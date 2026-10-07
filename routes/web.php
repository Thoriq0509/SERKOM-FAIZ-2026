<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\GalleryController;


/*
|--------------------------------------------------------------------------
| PUBLIC — Landing Page
|--------------------------------------------------------------------------
*/

Route::controller(LandingPageController::class)->group(function () {

    // Static pages
    Route::get('/',               'index')        ->name('landing.dashboard');
    Route::get('/profile',        'profile')      ->name('landing.profile');
    Route::get('/history',        'history')      ->name('landing.history');
    Route::get('/vision-mission', 'visionMission')->name('landing.vision-mission');

    // Teachers
    Route::get('/teachers',                'teachers')   ->name('landing.teachers');
    Route::get('/teachers/{teacher:slug}', 'teacherShow')->name('landing.teachers.show');

    // Students
    Route::get('/students', 'students')->name('landing.students');

    // Extracurricular
    Route::get('/extracurricular',                        'extracurricular')    ->name('landing.extracurricular');
    Route::get('/extracurricular/{extracurricular:slug}', 'extracurricularShow')->name('landing.extracurricular.show');

    // News
    Route::get('/news',             'news')    ->name('landing.news');
    Route::get('/news/{news:slug}', 'newsShow')->name('landing.news.show');

    // Gallery
    Route::get('/gallery', 'gallery')->name('landing.gallery');

});


/*
|--------------------------------------------------------------------------
| GUEST — Login
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get ('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});


/*
|--------------------------------------------------------------------------
| AUTH — Area Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {

        /*
        |------------------------------------------------------------------
        | Dashboard — Admin & Operator
        |------------------------------------------------------------------
        */
        Route::middleware('role:Admin,Operator')->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // Profil Sekolah
            Route::prefix('profil')->name('school_profile')->group(function () {
                Route::get   ('/',       [SchoolProfileController::class, 'index'])  ->name('');
                Route::get   ('/edit',   [SchoolProfileController::class, 'edit'])   ->name('.edit');
                Route::put   ('/update', [SchoolProfileController::class, 'update']) ->name('.update');
                Route::delete('/delete', [SchoolProfileController::class, 'destroy'])->name('.destroy');
            });

            // News
            Route::prefix('news')->name('news.')->group(function () {
                Route::get   ('/',          [NewsController::class, 'index'])  ->name('index');
                Route::get   ('/create',    [NewsController::class, 'create']) ->name('create');
                Route::post  ('/',          [NewsController::class, 'store'])  ->name('store');
                Route::get   ('/{id}',      [NewsController::class, 'show'])   ->name('show');
                Route::get   ('/{id}/edit', [NewsController::class, 'edit'])   ->name('edit');
                Route::put   ('/{id}',      [NewsController::class, 'update']) ->name('update');
                Route::delete('/{id}',      [NewsController::class, 'destroy'])->name('destroy');
            });

            // Extracurricular
            Route::prefix('extracurricular')->name('extracurricular.')->group(function () {
                Route::get   ('/',          [ExtracurricularController::class, 'index'])  ->name('index');
                Route::get   ('/create',    [ExtracurricularController::class, 'create']) ->name('create');
                Route::post  ('/',          [ExtracurricularController::class, 'store'])  ->name('store');
                Route::get   ('/{id}',      [ExtracurricularController::class, 'show'])   ->name('show');
                Route::get   ('/{id}/edit', [ExtracurricularController::class, 'edit'])   ->name('edit');
                Route::put   ('/{id}',      [ExtracurricularController::class, 'update']) ->name('update');
                Route::delete('/{id}',      [ExtracurricularController::class, 'destroy'])->name('destroy');
            });

            // Gallery
            Route::prefix('gallery')->name('gallery.')->group(function () {
                Route::get   ('/',          [GalleryController::class, 'index'])  ->name('index');
                Route::get   ('/create',    [GalleryController::class, 'create']) ->name('create');
                Route::post  ('/',          [GalleryController::class, 'store'])  ->name('store');
                Route::get   ('/{id}',      [GalleryController::class, 'show'])   ->name('show');
                Route::get   ('/{id}/edit', [GalleryController::class, 'edit'])   ->name('edit');
                Route::put   ('/{id}',      [GalleryController::class, 'update']) ->name('update');
                Route::delete('/{id}',      [GalleryController::class, 'destroy'])->name('destroy');
            });

        });

        /*
        |------------------------------------------------------------------
        | Admin only
        |------------------------------------------------------------------
        */
        Route::middleware('role:Admin')->group(function () {

            // Users
            Route::prefix('users')->name('users.')->group(function () {
                Route::get   ('/',          [UserController::class, 'index'])  ->name('index');
                Route::get   ('/create',    [UserController::class, 'addEdit'])->name('create');
                Route::post  ('/',          [UserController::class, 'save'])   ->name('store');
                Route::get   ('/{id}',      [UserController::class, 'show'])   ->name('show');
                Route::get   ('/{id}/edit', [UserController::class, 'addEdit'])->name('edit');
                Route::put   ('/{id}',      [UserController::class, 'save'])   ->name('update');
                Route::delete('/{id}',      [UserController::class, 'destroy'])->name('destroy');
            });

            // Guru
            Route::prefix('guru')->name('guru.')->group(function () {
                Route::get   ('/',          [TeacherController::class, 'index'])  ->name('index');
                Route::get   ('/create',    [TeacherController::class, 'create']) ->name('create');
                Route::post  ('/',          [TeacherController::class, 'store'])  ->name('store');
                Route::get   ('/{id}',      [TeacherController::class, 'show'])   ->name('show');
                Route::get   ('/{id}/edit', [TeacherController::class, 'edit'])   ->name('edit');
                Route::put   ('/{id}',      [TeacherController::class, 'update']) ->name('update');
                Route::delete('/{id}',      [TeacherController::class, 'destroy'])->name('destroy');
            });

            // Siswa
            Route::prefix('siswa')->name('siswa.')->group(function () {
                Route::get   ('/',          [StudentController::class, 'index'])  ->name('index');
                Route::get   ('/create',    [StudentController::class, 'create']) ->name('create');
                Route::post  ('/',          [StudentController::class, 'store'])  ->name('store');
                Route::get   ('/{id}',      [StudentController::class, 'show'])   ->name('show');
                Route::get   ('/{id}/edit', [StudentController::class, 'edit'])   ->name('edit');
                Route::put   ('/{id}',      [StudentController::class, 'update']) ->name('update');
                Route::delete('/{id}',      [StudentController::class, 'destroy'])->name('destroy');
            });

        });

    });
});
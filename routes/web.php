<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');

/*
|--------------------------------------------------------------------------
| Auth (real, database-backed)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// GET logout kept for the existing "Keluar" links in the UI.
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/forgot-password', fn () => view('auth.forgot'))->name('password.request');

/*
|--------------------------------------------------------------------------
| Member area (auth required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/materi', [MateriController::class, 'index'])->name('materi');
        Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan');
        Route::get('/sertifikasi', [CertificateController::class, 'index'])->name('sertifikasi');
    });

    Route::post('/sertifikasi/issue', [CertificateController::class, 'issue'])->name('certificate.issue');

    // Lesson flow: video -> theory -> quiz -> result
    Route::get('/member/video/{slug}', [MateriController::class, 'video'])->name('member.video');
    Route::get('/member/teori/{slug}', [MateriController::class, 'theory'])->name('member.theory');
    Route::get('/member/kuis/{slug}', [QuizController::class, 'show'])->name('member.kuis');
    Route::post('/member/kuis/{slug}', [QuizController::class, 'submit'])->name('member.kuis.submit');
});

/*
|--------------------------------------------------------------------------
| Admin area (auth + admin role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::get('/materi', [AdminController::class, 'materi'])->name('materi');
    Route::post('/materi', [AdminController::class, 'storeMateri'])->name('materi.store');
    Route::delete('/materi/{materi}', [AdminController::class, 'destroyMateri'])->name('materi.destroy');

    Route::get('/kuis', [AdminController::class, 'kuis'])->name('kuis');
    Route::post('/kuis', [AdminController::class, 'storeKuis'])->name('kuis.store');
    Route::delete('/kuis/{kuis}', [AdminController::class, 'destroyKuis'])->name('kuis.destroy');

    Route::get('/paket', [AdminController::class, 'paket'])->name('paket');
    Route::post('/paket', [AdminController::class, 'storePaket'])->name('paket.store');
    Route::delete('/paket/{paket}', [AdminController::class, 'destroyPaket'])->name('paket.destroy');

    Route::get('/sertifikasi', [AdminController::class, 'sertifikasi'])->name('sertifikasi');
});

<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

// ========================
// MEMBER DASHBOARD ROUTES
// ========================
Route::middleware(['auth'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        Route::view('/', 'member.dashboard.index')->name('index');
        Route::view('/materi', 'member.dashboard.materi')->name('materi');
        Route::view('/laporan', 'member.dashboard.laporan')->name('laporan');
        Route::view('/sertifikasi', 'member.dashboard.sertifikasi')->name('sertifikasi');
        Route::view('/teori', 'member.dashboard.teori')->name('teori');

        Route::get('/video/{slug}', function ($slug) {
            return view('member.dashboard.video', compact('slug'));
        })->name('video');
    });

// ========================
// ADMIN (sementara)
// ========================
Route::view('/admin/login', 'admin.login')->name('admin.login');
Route::view('/admin/dashboard', 'admin.dashboard')->middleware('auth')->name('admin.dashboard');

require __DIR__.'/auth.php';

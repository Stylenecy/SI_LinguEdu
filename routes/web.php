<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Halaman utama
Route::view('/', 'home')->name('home');

// ======== AUTH SIMULASI TANPA DATABASE ========

// GET - Halaman Login
Route::view('/login', 'auth.login')->name('login.simulasi');

// POST - Aksi Login (simulasi)
Route::post('/login', function (Request $request) {
    // Simulasi: langsung login tanpa cek apapun
    session(['user' => $request->input('email', 'guest@example.com')]);
    return redirect()->route('dashboard.index');
})->name('login.simulasi.post');

// GET - Halaman Register
Route::view('/register', 'auth.register')->name('register.simulasi');

// GET - Logout simulasi
Route::get('/logout', function () {
    session()->forget('user');
    return redirect()->route('login.simulasi');
})->name('logout.simulasi');

// ======== DASHBOARD PAGES ========
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::view('/', 'dashboard.index')->name('index');
    Route::view('/materi', 'dashboard.materi')->name('materi');
    Route::view('/laporan', 'dashboard.laporan')->name('laporan');
    Route::view('/sertifikasi', 'dashboard.sertifikasi')->name('sertifikasi');
});

// Lupa Password simulasi
Route::get('/forgot-password', function () {
    return 'Halaman lupa password masih dalam pengembangan.';
})->name('password.request');

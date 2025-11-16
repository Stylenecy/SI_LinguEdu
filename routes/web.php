<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Halaman utama
Route::view('/', 'home')->name('home');

// ======== AUTH SIMULASI TANPA DATABASE ========

// GET - Halaman Login
Route::view('/login', 'auth.login')->name('login.simulasi');


Route::post('/login', function (Request $request) {

    $email = $request->email;
    $password = $request->password;

    // 🔐 Cek Login Admin
    if ($email === 'adminlinguedu@gmail.com' && $password === 'admin1234') {
        session(['user_role' => 'admin']);
        session(['user_email' => $email]);
        return redirect()->route('admin.dashboard'); // → menuju dashboard admin
    }

    // 🔐 Login Simulasi User Biasa
    session(['user_role' => 'user']);
    session(['user_email' => $email]);
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
    Route::view('/', 'member.dashboard.index')->name('index');
    Route::view('/materi', 'member.dashboard.materi')->name('materi');
    Route::view('/laporan', 'member.dashboard.laporan')->name('laporan');
    Route::view('/sertifikasi', 'member.dashboard.sertifikasi')->name('sertifikasi');
});



// Lupa Password simulasi
Route::get('/forgot-password', function () {
    return 'Halaman lupa password masih dalam pengembangan.';
})->name('password.request');

Route::view('/dashboard/video', 'member.dashboard.video')->name('dashboard.video');
Route::get('/member/video/{slug}', function ($slug) {
    return view('member.dashboard.video', ['slug' => $slug]);
})->name('member.video');
Route::get('/member/teori', function () {
    return view('member.dashboard.teori');
})->name('member.teori');


// Login Admin simulasi
Route::view('/admin/login', 'auth.loginadmin')->name('admin.login');
Route::post('/admin/login', function (Request $request) {
    session(['admin' => true]);
    return redirect('/admin/dashboard');
})->name('admin.login.post');


// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard');
})->name('admin.dashboard');


// ======== Menu Pengaturan Admin ========

// Manajemen User
Route::get('/admin/users', function () {
    return view('Admin.Pages.users');
})->name('admin.users');

// Setting Paket
Route::get('/admin/paket', function () {
    return view('Admin.Pages.paket');
})->name('admin.paket');

// Setting Materi
Route::get('/admin/materi', function () {
    return view('Admin.Pages.materi');
})->name('admin.materi');

// Setting Kuis
Route::get('/admin/kuis', function () {
    return view('Admin.Pages.kuis');
})->name('admin.kuis');

// Setting Sertifikasi
Route::get('/admin/sertifikasi', function () {
    return view('Admin.Pages.sertifikasi');
})->name('admin.sertifikasi');



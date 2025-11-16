<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/login-simulasi', function () {
    return view('auth.login');
})->name('auth.login.simulasi');

Route::get('/register-simulasi', function () {
    return view('auth.register');
})->name('auth.register.simulasi');

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
})->name('dashboard');

Route::get('/paket', function () {
    return view('Admin.paket');
})->name('paket');

Route::get('/materi', function () {
    return view('Admin.materi');
})->name('materi');

Route::get('/kuis', function () {
    return view('Admin.kuis');
})->name('kuis');

Route::get('/sertifikasi', function () {
    return view('Admin.sertifikasi');
})->name('sertifikasi');

Route::get('/manajemen-user', function () {
    return view('Admin.manajemen-user');
})->name('manajemen-user');

Route::get('/logout', function () {
    return redirect('/'); // kembali ke halaman login
})->name('logout');

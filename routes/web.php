<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/paket', function () {
    return view('paket');
})->name('paket');

Route::get('/materi', function () {
    return view('materi');
})->name('materi');

Route::get('/kuis', function () {
    return view('kuis');
})->name('kuis');

Route::get('/sertifikasi', function () {
    return view('sertifikasi');
})->name('sertifikasi');

Route::get('/manajemen-user', function () {
    return view('manajemen-user');
})->name('manajemen-user');

Route::get('/logout', function () {
    return redirect('/'); // kembali ke halaman login
})->name('logout');

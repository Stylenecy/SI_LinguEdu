<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// auth simulasi
Route::view('/', 'home')->name('home');
Route::view('/login', 'auth.login')->name('login.simulasi');
Route::view('/register', 'auth.register')->name('register.simulasi');
Route::view('/logout', 'logout')->name('logout.simulasi');
// dashboard pages
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::view('/', 'dashboard.index')->name('index');
    Route::view('/materi', 'dashboard.materi')->name('materi');
    Route::view('/laporan', 'dashboard.laporan')->name('laporan');
    Route::view('/sertifikasi', 'dashboard.sertifikasi')->name('sertifikasi');
});

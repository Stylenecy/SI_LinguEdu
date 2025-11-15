<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Lupa Password simulasi
Route::get('/forgot-password', function () {
    return 'Halaman lupa password masih dalam pengembangan.';
})->name('password.request');

Route::view('/dashboard/video', 'dashboard.video')->name('dashboard.video');

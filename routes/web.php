<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Ini adalah file gabungan yang benar.
| 1. Rute "simulasi" (login, register, admin) telah DIHAPUS.
| 2. Rute "welcome" default telah DIHAPUS.
| 3. Rute "home" (halaman utama) dari Clara DIPAKAI.
| 4. Semua rute UI (dashboard member & admin) dari Clara & Adhi DIPAKAI.
| 5. Rute backend dari Breeze (auth.php, /dashboard, /profile) DIPAKAI.
|--------------------------------------------------------------------------
*/

// Halaman utama (Dari Frontend)
Route::view('/', 'home')->name('home');

// ======== RUTE UI MEMBER (DARI FRONTEND CLARA) ========
// Nanti kita akan proteksi ini dengan middleware 'auth'
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::view('/', 'member.dashboard.index')->name('index');
    Route::view('/materi', 'member.dashboard.materi')->name('materi');
    Route::view('/laporan', 'member.dashboard.laporan')->name('laporan');
    Route::view('/sertifikasi', 'member.dashboard.sertifikasi')->name('sertifikasi');
    Route::view('/video', 'member.dashboard.video')->name('video');
});

Route::get('/member/video/{slug}', function ($slug) {
    return view('member.dashboard.video', ['slug' => $slug]);
})->name('member.video');

Route::get('/member/teori', function () {
    return view('member.dashboard.teori');
})->name('member.teori');


// ======== RUTE UI ADMIN (DARI FRONTEND ADHI) ========
// Nanti kita akan proteksi ini dengan middleware 'auth' & 'admin'
Route::view('/admin/login', 'auth.loginadmin')->name('admin.login'); // Halaman UI, BUKAN logic
Route::view('/admin/users', 'Admin.manajemen-user')->name('admin.users');
Route::view('/admin/dashboard', 'Admin.dashboard')->name('admin.dashboard');


// ======== RUTE ASLI DARI BREEZE (BACKEND) ========

// Rute default '/dashboard' dari Breeze
// Kita modifikasi agar mengarah ke dashboard member (nanti kita tambah logic role)
Route::get('/dashboard', function () {
    return redirect()->route('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute profile BREEZE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ini adalah rute ASLI untuk login, register, logout, dll.
require __DIR__.'/auth.php';
?>

{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.main')

@section('title', 'Dashboard - LinguEdu')

@section('content')
<div class="space-y-10 animate-fade-in">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-4xl font-extrabold text-indigo-700 tracking-tight drop-shadow-sm">
                Selamat Datang Kembali 👋
            </h2>
            <p class="text-gray-500 mt-1 text-base">Terus lanjutkan perjalanan belajarmu hari ini!</p>
        </div>
        <a href="{{ route('materi.simulasi') }}"
           class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl shadow-lg hover:scale-105 transform transition duration-300 hover:shadow-indigo-400/40">
           🚀 Mulai Pelajaran Berikutnya
        </a>
    </div>

    {{-- Statistik Utama --}}
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        {{-- Card 1 --}}
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 flex items-center gap-4 border border-indigo-100 hover:scale-[1.02] hover:shadow-indigo-200 transition">
            <div class="bg-gradient-to-br from-indigo-200 to-indigo-400 text-indigo-700 p-4 rounded-2xl shadow-inner">
                <i class="fa-solid fa-user-graduate text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Level Saat Ini</p>
                <h3 class="text-2xl font-bold text-gray-800">Level 1</h3>
            </div>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 flex items-center gap-4 border border-purple-100 hover:scale-[1.02] hover:shadow-purple-200 transition">
            <div class="bg-gradient-to-br from-purple-200 to-purple-400 text-purple-700 p-4 rounded-2xl shadow-inner">
                <i class="fa-solid fa-book-open text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Modul Selesai</p>
                <h3 class="text-2xl font-bold text-gray-800">2 / 6</h3>
            </div>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 flex items-center gap-4 border border-yellow-100 hover:scale-[1.02] hover:shadow-yellow-200 transition">
            <div class="bg-gradient-to-br from-yellow-200 to-yellow-400 text-yellow-700 p-4 rounded-2xl shadow-inner">
                <i class="fa-solid fa-award text-3xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Rata-rata Nilai</p>
                <h3 class="text-2xl font-bold text-gray-800">92%</h3>
            </div>
        </div>
    </div>

    {{-- Progress Keseluruhan --}}
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-indigo-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-lg text-gray-800">Progres Keseluruhan</h3>
            <span class="text-sm text-gray-500 font-medium">66% selesai</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 h-4 rounded-full transition-all duration-700" style="width: 66%"></div>
        </div>
    </div>

    {{-- Daftar Kuis --}}
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-indigo-100">
        <h3 class="font-semibold text-lg text-gray-800 mb-6">Progres Kuis</h3>

        <div class="space-y-4">
            {{-- Kuis 1 --}}
            <div class="flex justify-between items-center bg-gradient-to-r from-indigo-50 to-indigo-100 p-4 rounded-xl shadow-sm hover:scale-[1.01] transition">
                <div>
                    <p class="font-semibold text-sm text-gray-800">Kuis 1: Pengenalan</p>
                    <p class="text-xs text-green-600 mt-1">✅ Lulus</p>
                </div>
                <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
            </div>

            {{-- Kuis 2 --}}
            <div class="flex justify-between items-center bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-xl shadow-sm hover:scale-[1.01] transition">
                <div>
                    <p class="font-semibold text-sm text-gray-800">Kuis 2: Pemahaman Dasar</p>
                    <p class="text-xs text-yellow-600 mt-1">🔁 Mengulang</p>
                </div>
                <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 60%"></div>
                </div>
            </div>

            {{-- Kuis 3 --}}
            <div class="flex justify-between items-center bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl shadow-sm hover:scale-[1.01] transition">
                <div>
                    <p class="font-semibold text-sm text-gray-800">Kuis 3: Latihan Soal</p>
                    <p class="text-xs text-gray-500 mt-1">🔒 Belum Dibuka</p>
                </div>
                <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-gray-400 h-2 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Animasi sederhana --}}
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.6s ease-in-out;
}
</style>
@endsection

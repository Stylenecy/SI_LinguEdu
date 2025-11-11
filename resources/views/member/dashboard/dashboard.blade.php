{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.main')

@section('title', 'Dashboard - LinguEdu')

@section('content')
    <div class="space-y-8">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-indigo-700">Selamat Datang Kembali 👋</h2>
                <p class="text-gray-500 mt-1">Terus lanjutkan perjalanan belajarmu hari ini</p>
            </div>
            <a href="{{ route('materi.simulasi') }}"
                class="bg-indigo-600 text-white px-6 py-2 rounded-xl shadow hover:bg-indigo-700 transition">
                Mulai Pelajaran Berikutnya
            </a>
        </div>

        {{-- Statistik Utama --}}
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
                    <i class="fa-solid fa-user-graduate text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Level Saat Ini</p>
                    <h3 class="text-xl font-semibold text-gray-800">Level 1</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-xl">
                    <i class="fa-solid fa-book-open text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Modul Selesai</p>
                    <h3 class="text-xl font-semibold text-gray-800">2 / 6</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">
                    <i class="fa-solid fa-award text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Rata-rata Nilai</p>
                    <h3 class="text-xl font-semibold text-gray-800">92%</h3>
                </div>
            </div>
        </div>

        {{-- Progress Keseluruhan --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-lg text-gray-800">Progres Keseluruhan</h3>
                <span class="text-sm text-gray-500">66% selesai</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div class="bg-indigo-600 h-3 rounded-full" style="width: 66%"></div>
            </div>
        </div>

        {{-- Daftar Kuis --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="font-semibold text-lg text-gray-800 mb-4">Progres Kuis</h3>

            <div class="space-y-3">
                <div class="flex justify-between items-center bg-indigo-50 p-3 rounded-xl">
                    <div>
                        <p class="font-medium text-sm text-gray-800">Kuis 1: Pengenalan</p>
                        <p class="text-xs text-green-600">✅ Lulus</p>
                    </div>
                    <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>

                <div class="flex justify-between items-center bg-purple-50 p-3 rounded-xl">
                    <div>
                        <p class="font-medium text-sm text-gray-800">Kuis 2: Pemahaman Dasar</p>
                        <p class="text-xs text-yellow-600">🔁 Mengulang</p>
                    </div>
                    <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 60%"></div>
                    </div>
                </div>

                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                    <div>
                        <p class="font-medium text-sm text-gray-800">Kuis 3: Latihan Soal</p>
                        <p class="text-xs text-gray-500">🔒 Belum Dibuka</p>
                    </div>
                    <div class="w-32 bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div class="bg-gray-400 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

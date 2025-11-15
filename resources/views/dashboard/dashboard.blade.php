{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.main')

@section('title', 'Dashboard - LinguEdu')

@section('content')
<div class="space-y-10 animate-fade-in">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-4xl font-extrabold text-indigo-700 tracking-tight drop-shadow-sm">
                Selamat Datang Kembali 👋 {{ Auth::user()->name ?? 'Pengguna' }}
            </h2>
            <p class="text-gray-500 mt-1 text-base">Terus lanjutkan perjalanan belajarmu hari ini!</p>
        </div>
        <a href="{{ route('materi.simulasi') }}"
           class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl shadow-lg hover:scale-105 transform transition duration-300 hover:shadow-indigo-400/40">
           🚀 Mulai Pelajaran Berikutnya
        </a>
    </div>

    {{-- Notifikasi Progres --}}
    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-100 rounded-2xl shadow p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                <i class="fa-solid fa-bell text-lg"></i>
            </div>
            <div>
                <p class="font-medium text-gray-800">Kamu sudah menyelesaikan 2 modul minggu ini 🎉</p>
                <p class="text-sm text-gray-500">Tetap semangat untuk mencapai target mingguanmu!</p>
            </div>
        </div>
        <a href="#" class="text-sm text-indigo-600 font-semibold hover:underline">Lihat Detail</a>
    </div>

    {{-- Statistik Utama --}}
    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <x-dashboard.card color="indigo" icon="fa-user-graduate" title="Level Saat Ini" value="Level 1"/>
        <x-dashboard.card color="purple" icon="fa-book-open" title="Modul Selesai" value="2 / 6"/>
        <x-dashboard.card color="yellow" icon="fa-award" title="Rata-rata Nilai" value="92%"/>
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

    {{-- Aktivitas Terbaru --}}
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-purple-100">
        <h3 class="font-semibold text-lg text-gray-800 mb-6">Aktivitas Terbaru</h3>
        <ul class="space-y-4">
            <li class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-100 p-3 rounded-full text-indigo-600">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">Menyelesaikan Modul 2: Tata Bahasa</p>
                        <p class="text-gray-500 text-sm">2 jam yang lalu</p>
                    </div>
                </div>
                <span class="text-green-600 font-semibold text-sm">✅ Selesai</span>
            </li>
            <li class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">Mengulang Kuis: Pemahaman Dasar</p>
                        <p class="text-gray-500 text-sm">Kemarin</p>
                    </div>
                </div>
                <span class="text-yellow-600 font-semibold text-sm">🔁 Mengulang</span>
            </li>
        </ul>
    </div>

    {{-- Rekomendasi Pembelajaran Berikutnya --}}
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-2xl font-bold">Rekomendasi Selanjutnya 💡</h3>
                <p class="text-indigo-100 mt-1">"Pelajari Modul 3: Percakapan Dasar Bahasa Inggris"</p>
            </div>
            <a href="{{ route('materi.modul3') }}"
               class="bg-white text-indigo-700 px-6 py-2 rounded-xl shadow hover:bg-indigo-50 transition font-semibold">
               Mulai Sekarang →
            </a>
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

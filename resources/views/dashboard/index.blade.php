@extends('layouts.main')
@section('title', 'Dashboard - LinguEdu')

@section('content')
<main class="flex-1 p-8 overflow-y-auto bg-gray-100">
  <!-- Greeting -->
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-bold text-gray-800">Halo, <span class="text-blue-600">User LinguEdu!</span></h1>
      <p class="text-gray-500">Selamat datang kembali 👋 Semangat belajar hari ini!</p>
    </div>
    <div class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg font-semibold">
      Level 1 — 0/20 XP
    </div>
  </div>

  <!-- Progress -->
  <div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h2 class="font-bold text-lg mb-2">🎯 Progres Belajar</h2>
    <div class="w-full bg-gray-200 rounded-full h-4">
      <div class="bg-blue-600 h-4 rounded-full transition-all duration-500" style="width: 20%;"></div>
    </div>
    <p class="text-sm text-gray-500 mt-2">Kamu telah menyelesaikan 4 dari 20 materi.</p>
  </div>

  <!-- Statistik -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-blue-50 p-6 rounded-xl shadow-sm hover:shadow-md transition">
      <h3 class="font-semibold text-blue-700 text-lg">📘 Total Materi</h3>
      <p class="text-3xl font-bold mt-2">12</p>
      <p class="text-sm text-gray-500 mt-1">Materi aktif saat ini</p>
    </div>

    <div class="bg-green-50 p-6 rounded-xl shadow-sm hover:shadow-md transition">
      <h3 class="font-semibold text-green-700 text-lg">✅ Kuis Diselesaikan</h3>
      <p class="text-3xl font-bold mt-2">8</p>
      <p class="text-sm text-gray-500 mt-1">Tingkat akurasi: 80%</p>
    </div>

    <div class="bg-yellow-50 p-6 rounded-xl shadow-sm hover:shadow-md transition">
      <h3 class="font-semibold text-yellow-700 text-lg">🏆 Sertifikat</h3>
      <p class="text-3xl font-bold mt-2">1</p>
      <p class="text-sm text-gray-500 mt-1">Telah diraih!</p>
    </div>
  </div>

  <!-- Akses Cepat -->
  <h2 class="text-xl font-semibold mb-4 text-gray-800">🚀 Akses Cepat</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- Materi -->
    <div class="relative group rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">
      <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://cdn-icons-png.flaticon.com/512/3135/3135715.png'); opacity: 0.15;">
      </div>
      <div
        class="absolute inset-0 bg-gradient-to-t from-blue-100/90 to-transparent group-hover:from-blue-200/80 transition duration-500">
      </div>
      <div class="relative text-center p-8">
        <div class="flex justify-center mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
               class="w-16 h-16 transition-transform duration-500 group-hover:-translate-y-2 group-hover:scale-110" alt="Materi Icon">
        </div>
        <h3 class="font-bold text-2xl text-gray-800">Materi</h3>
        <p class="text-gray-700 mt-2">Belajar sesuai levelmu</p>
        <a href="{{ route('dashboard.materi') }}"
          class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
          Mulai
        </a>
      </div>
    </div>

    <!-- Laporan -->
    <div class="relative group rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">
      <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://cdn-icons-png.flaticon.com/512/3135/3135800.png'); opacity: 0.15;">
      </div>
      <div
        class="absolute inset-0 bg-gradient-to-t from-green-100/90 to-transparent group-hover:from-green-200/80 transition duration-500">
      </div>
      <div class="relative text-center p-8">
        <div class="flex justify-center mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/3135/3135800.png"
               class="w-16 h-16 transition-transform duration-500 group-hover:-translate-y-2 group-hover:scale-110" alt="Laporan Icon">
        </div>
        <h3 class="font-bold text-2xl text-gray-800">Laporan</h3>
        <p class="text-gray-700 mt-2">Pantau progresmu</p>
        <a href="{{ route('dashboard.laporan') }}"
          class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
          Lihat
        </a>
      </div>
    </div>

    <!-- Sertifikasi -->
    <div class="relative group rounded-xl overflow-hidden shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">
      <div class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://cdn-icons-png.flaticon.com/512/2278/2278992.png'); opacity: 0.15;">
      </div>
      <div
        class="absolute inset-0 bg-gradient-to-t from-yellow-100/90 to-transparent group-hover:from-yellow-200/80 transition duration-500">
      </div>
      <div class="relative text-center p-8">
        <div class="flex justify-center mb-4">
          <img src="https://cdn-icons-png.flaticon.com/512/2278/2278992.png"
               class="w-16 h-16 transition-transform duration-500 group-hover:-translate-y-2 group-hover:scale-110" alt="Sertifikasi Icon">
        </div>
        <h3 class="font-bold text-2xl text-gray-800">Sertifikasi</h3>
        <p class="text-gray-700 mt-2">Uji kemampuanmu</p>
        <a href="{{ route('dashboard.sertifikasi') }}"
          class="inline-block mt-4 px-4 py-2 bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600 transition">
          Mulai
        </a>
      </div>
    </div>
  </div>

  <!-- Tips -->
  <div class="mt-10 bg-white rounded-lg p-6 shadow-md">
    <h2 class="font-semibold text-lg mb-3">💡 Tips Hari Ini</h2>
    <p class="text-gray-600">Cobalah menyelesaikan minimal satu kuis hari ini untuk menjaga konsistensi belajarmu!</p>
    <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
      Lihat Tips Lainnya
    </button>
  </div>
</main>
@endsection

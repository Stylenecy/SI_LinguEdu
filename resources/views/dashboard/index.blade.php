@extends('layouts.main')
@section('title', 'Dashboard - LinguEdu')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-100">

  <!-- Sidebar -->
  <aside class="w-full md:w-64 bg-white shadow-lg p-6 space-y-6 border-r border-gray-200">
    <div class="flex items-center justify-between">
      <h2 class="text-2xl font-bold text-blue-600">LinguEdu</h2>
    </div>

    <nav class="space-y-2">
      <a href="{{ route('dashboard.index') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard.index') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
        🏠 <span>Dashboard</span>
      </a>
      <a href="{{ route('dashboard.materi') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard.materi') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
        📚 <span>Materi</span>
      </a>
      <a href="{{ route('dashboard.laporan') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard.laporan') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
        📊 <span>Laporan Progres</span>
      </a>
      <a href="{{ route('dashboard.sertifikasi') }}" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg {{ request()->routeIs('dashboard.sertifikasi') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
        🎓 <span>Ujian Sertifikasi</span>
      </a>
      <a href="#" 
         class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-50">
        ⚙️ <span>Pengaturan</span>
      </a>
    </nav>

    <hr class="border-gray-200">

    <div>
      <a href="{{ route('logout.simulasi') }}" 
         class="block text-red-600 font-semibold hover:underline">
        🚪 Logout
      </a>
    </div>
  </aside>

  <!-- Konten Utama -->
  <main class="flex-1 p-8 overflow-y-auto">
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
    <h2 class="text-xl font-semibold mb-4">🚀 Akses Cepat</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="bg-blue-600 text-white p-6 rounded-lg shadow-sm text-center hover:bg-blue-700 transition">
        <h3 class="font-bold text-lg">Materi</h3>
        <p class="text-sm mt-2 opacity-80">Belajar sesuai levelmu</p>
        <a href="{{ route('dashboard.materi') }}" class="inline-block mt-3 px-4 py-2 bg-white text-blue-700 rounded-lg font-semibold hover:bg-blue-100">Mulai</a>
      </div>

      <div class="bg-green-600 text-white p-6 rounded-lg shadow-sm text-center hover:bg-green-700 transition">
        <h3 class="font-bold text-lg">Laporan</h3>
        <p class="text-sm mt-2 opacity-80">Pantau progresmu</p>
        <a href="{{ route('dashboard.laporan') }}" class="inline-block mt-3 px-4 py-2 bg-white text-green-700 rounded-lg font-semibold hover:bg-green-100">Lihat</a>
      </div>

      <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-sm text-center hover:bg-yellow-600 transition">
        <h3 class="font-bold text-lg">Sertifikasi</h3>
        <p class="text-sm mt-2 opacity-80">Uji kemampuanmu</p>
        <a href="{{ route('dashboard.sertifikasi') }}" class="inline-block mt-3 px-4 py-2 bg-white text-yellow-700 rounded-lg font-semibold hover:bg-yellow-100">Mulai</a>
      </div>
    </div>

    <!-- Notifikasi & Tips -->
    <div class="mt-10 bg-white rounded-lg p-6 shadow-md">
      <h2 class="font-semibold text-lg mb-3">💡 Tips Hari Ini</h2>
      <p class="text-gray-600">Cobalah menyelesaikan minimal satu kuis hari ini untuk menjaga konsistensi belajarmu!</p>
      <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        Lihat Tips Lainnya
      </button>
    </div>
  </main>
</div>
@endsection

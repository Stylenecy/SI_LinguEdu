@extends('layouts.main')
@section('title', 'Materi - LinguEdu')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-full md:w-64 bg-white shadow-md p-6">
    <a href="{{ route('dashboard.index') }}" class="block text-blue-600 font-bold mb-4 hover:underline">← Kembali ke Dashboard</a>
    <nav class="space-y-2">
      <a href="#" class="block px-3 py-2 rounded hover:bg-blue-50 text-gray-700 font-medium">Profil Saya</a>
      <a href="#" class="block px-3 py-2 rounded hover:bg-blue-50 text-gray-700 font-medium">Laporan Progres</a>
      <a href="#" class="block px-3 py-2 rounded hover:bg-blue-50 text-gray-700 font-medium">Pusat Bantuan</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8">
    <div class="mb-6">
      <h1 class="text-2xl font-bold">Materi Belajar</h1>
      <p class="text-gray-600">Ikuti urutan pembelajaran: <span class="font-semibold text-blue-600">Video → Teori → Kuis</span></p>
    </div>

    <!-- Grid Materi -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Level 1 - Dapat Diakses -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-xl transition group">
        <h3 class="font-semibold mb-2 text-blue-600 group-hover:text-blue-700">Level 1: Salam & Perkenalan</h3>
        <p class="text-gray-600 text-sm mb-4">Dasar percakapan harian untuk mengenal dan menyapa orang lain.</p>

        <!-- Progress -->
        <div class="mb-3">
          <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-700">Progres</span>
            <span class="text-blue-600 font-semibold">100%</span>
          </div>
          <div class="w-full bg-gray-200 h-2 rounded">
            <div class="bg-blue-500 h-2 rounded" style="width:100%"></div>
          </div>
        </div>

        <p class="text-sm mb-3">
          <span class="font-semibold text-green-600">Status:</span> Selesai ✅
        </p>

        <!-- Tombol Aksi -->
        <div class="flex flex-wrap gap-2 mt-3">
          <a href="#" class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition text-sm">🎬 Video</a>
          <a href="#" class="flex-1 text-center bg-yellow-400 text-white px-3 py-2 rounded hover:bg-yellow-500 transition text-sm">📖 Teori</a>
          <a href="#" class="flex-1 text-center bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600 transition text-sm">🧩 Kuis</a>
        </div>
      </div>

      <!-- Level 2 - Dapat Diakses jika Level 1 Selesai -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-xl transition group">
        <h3 class="font-semibold mb-2 text-blue-600 group-hover:text-blue-700">Level 2: Angka & Hari</h3>
        <p class="text-gray-600 text-sm mb-4">Pelajari angka, hari, dan bagaimana mengucapkannya dalam percakapan.</p>

        <!-- Progress -->
        <div class="mb-3">
          <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-700">Progres</span>
            <span class="text-blue-600 font-semibold">50%</span>
          </div>
          <div class="w-full bg-gray-200 h-2 rounded">
            <div class="bg-blue-400 h-2 rounded" style="width:50%"></div>
          </div>
        </div>

        <p class="text-sm mb-3">
          <span class="font-semibold text-yellow-600">Status:</span> Sedang Belajar ⏳
        </p>

        <div class="flex flex-wrap gap-2 mt-3">
          <a href="#" class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition text-sm">🎬 Video</a>
          <a href="#" class="flex-1 text-center bg-yellow-400 text-white px-3 py-2 rounded hover:bg-yellow-500 transition text-sm">📖 Teori</a>
          <a href="#" class="flex-1 text-center bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600 transition text-sm">🧩 Kuis</a>
        </div>
      </div>

      <!-- Level 3 - Terkunci -->
      <div class="bg-gray-200 p-6 rounded-lg shadow-inner relative overflow-hidden group cursor-not-allowed opacity-80">
        <!-- Overlay untuk efek terkunci -->
        <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm flex flex-col justify-center items-center text-white">
          <i class="fa-solid fa-lock text-5xl mb-3 animate-bounce"></i>
          <p class="font-semibold text-lg">Terkunci</p>
          <p class="text-sm text-gray-200">Selesaikan Level 2 untuk membuka Level 3 🔓</p>
        </div>

        <!-- Konten (tidak bisa diklik) -->
        <div class="opacity-30 select-none">
          <h3 class="font-semibold mb-2 text-blue-600">Level 3: Keluarga & Profesi</h3>
          <p class="text-gray-600 text-sm mb-4">Pelajari cara memperkenalkan anggota keluarga dan profesi seseorang.</p>
          <div class="w-full bg-gray-300 h-2 rounded mt-2">
            <div class="bg-blue-300 h-2 rounded" style="width:0%"></div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

{{-- Animasi CSS --}}
<style>
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-8px); }
}
.animate-bounce {
  animation: bounce 1s infinite;
}
</style>
@endsection

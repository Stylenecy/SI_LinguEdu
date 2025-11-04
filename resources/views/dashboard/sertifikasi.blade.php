@extends('layouts.main')
@section('title', 'Sertifikasi - LinguEdu')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">

  <!-- Header -->
  <div class="text-center mb-10">
    <h1 class="text-3xl font-bold text-gray-800">🎓 Ujian Sertifikasi</h1>
    <p class="text-gray-600 mt-2">Buktikan kemampuanmu setelah menyelesaikan seluruh materi dan kuis!</p>
  </div>

  <!-- Status Sertifikasi -->
  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 text-center transition hover:shadow-xl">
    <div class="mb-4">
      <i class="fas fa-lock text-6xl text-gray-400 mb-4 animate-bounce"></i>
      <h2 class="text-xl font-semibold text-gray-800 mb-2">Ujian Belum Tersedia</h2>
      <p class="text-gray-600">Kamu belum mencapai <span class="font-semibold text-blue-600">Level 3</span>.  
      Selesaikan semua materi untuk membuka ujian sertifikasi dan mendapatkan penghargaan!</p>
    </div>

    <!-- Progress Keseluruhan -->
    <div class="mt-6">
      <div class="flex justify-between text-sm mb-1">
        <span class="text-gray-700 font-medium">Progres Belajar</span>
        <span class="text-blue-600 font-semibold">66%</span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-green-500 h-3 rounded-full transition-all duration-700" style="width:66%"></div>
      </div>
    </div>

    <!-- Tombol Ujian (Nonaktif) -->
    <div class="mt-8">
      <button disabled class="bg-gray-400 text-white px-6 py-3 rounded-lg cursor-not-allowed shadow-md w-full md:w-auto">
        🔒 Mulai Ujian Sertifikasi
      </button>
      <p class="text-gray-500 text-sm mt-3">Selesaikan semua level terlebih dahulu untuk mengaktifkan tombol ini.</p>
    </div>
  </div>

  <!-- Info Sertifikasi -->
  <div class="max-w-3xl mx-auto mt-10 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-2xl shadow-lg p-8">
    <h3 class="text-lg font-semibold mb-2">✨ Tentang Ujian Sertifikasi</h3>
    <p class="text-sm opacity-90">
      Ujian sertifikasi adalah tahap akhir pembelajaran di LinguEdu.  
      Setelah lulus, kamu akan mendapatkan <span class="font-semibold">Sertifikat Kompetensi Bahasa</span>  
      yang dapat kamu unduh dan bagikan ke portofolio kamu.
    </p>
  </div>

</div>

{{-- Animasi --}}
<style>
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-6px); }
}
.animate-bounce {
  animation: bounce 1.5s infinite;
}
</style>
@endsection

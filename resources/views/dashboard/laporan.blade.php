@extends('layouts.main')
@section('title', 'Laporan Progres - LinguEdu')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-100">

  <!-- Sidebar -->
  <aside class="w-full md:w-64 bg-white shadow-md p-6 border-r border-gray-200">
    <a href="{{ route('dashboard.index') }}" class="block text-blue-600 font-bold mb-6 hover:underline">← Kembali ke Dashboard</a>

    <nav class="space-y-2">
      <a href="{{ route('dashboard.index') }}" class="block px-3 py-2 rounded-lg hover:bg-blue-50">🏠 Dashboard</a>
      <a href="{{ route('dashboard.materi') }}" class="block px-3 py-2 rounded-lg hover:bg-blue-50">📚 Materi</a>
      <a href="{{ route('dashboard.laporan') }}" class="block px-3 py-2 rounded-lg bg-blue-100 text-blue-700 font-semibold">📊 Laporan Progres</a>
      <a href="{{ route('dashboard.sertifikasi') }}" class="block px-3 py-2 rounded-lg hover:bg-blue-50">🎓 Sertifikasi</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
      <div>
        <h1 class="text-3xl font-bold text-gray-800">📊 Laporan Progres Belajarmu</h1>
        <p class="text-gray-500">Pantau hasil kuis dan capaian belajar kamu di sini.</p>
      </div>
      <div class="mt-4 md:mt-0 space-x-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">⬇️ Ekspor PDF</button>
        <button class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">⬇️ Ekspor Excel</button>
      </div>
    </div>

    <!-- Statistik Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="font-semibold text-gray-500 text-sm">Total Kuis Dikerjakan</h3>
        <p class="text-3xl font-bold text-blue-600 mt-1">8</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="font-semibold text-gray-500 text-sm">Rata-rata Nilai</h3>
        <p class="text-3xl font-bold text-green-600 mt-1">82%</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="font-semibold text-gray-500 text-sm">Tingkat Kelulusan</h3>
        <p class="text-3xl font-bold text-yellow-600 mt-1">75%</p>
      </div>
    </div>

    <!-- Progress Keseluruhan -->
    <div class="bg-white p-6 rounded-xl shadow-md">
      <div class="flex justify-between items-center mb-2">
        <h2 class="font-semibold text-gray-700">Progres Keseluruhan</h2>
        <span class="text-sm text-gray-500">75% selesai</span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 h-4 rounded-full transition-all duration-700" style="width: 75%;"></div>
      </div>
    </div>

    <!-- Filter & Pencarian -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      <input type="text" placeholder="🔍 Cari kuis..." class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 outline-none">
      <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400">
        <option value="all">Semua Status</option>
        <option value="passed">Lulus</option>
        <option value="failed">Gagal</option>
        <option value="retry">Mengulang</option>
      </select>
    </div>

    <!-- Tabel Laporan -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
      <table class="w-full text-left border-collapse">
        <thead class="bg-blue-50">
          <tr>
            <th class="p-3 text-gray-700 font-semibold">#</th>
            <th class="p-3 text-gray-700 font-semibold">Nama Kuis</th>
            <th class="p-3 text-gray-700 font-semibold">Nilai</th>
            <th class="p-3 text-gray-700 font-semibold">Status</th>
            <th class="p-3 text-gray-700 font-semibold">Tanggal</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          <tr class="hover:bg-blue-50 transition">
            <td class="p-3 font-semibold text-gray-600">1</td>
            <td class="p-3">Salam & Perkenalan</td>
            <td class="p-3 text-green-600 font-bold">85</td>
            <td class="p-3"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Lulus</span></td>
            <td class="p-3 text-gray-500">20 Okt 2025</td>
          </tr>
          <tr class="hover:bg-blue-50 transition">
            <td class="p-3 font-semibold text-gray-600">2</td>
            <td class="p-3">Angka & Hari</td>
            <td class="p-3 text-red-600 font-bold">60</td>
            <td class="p-3"><span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">Gagal</span></td>
            <td class="p-3 text-gray-500">22 Okt 2025</td>
          </tr>
          <tr class="hover:bg-blue-50 transition">
            <td class="p-3 font-semibold text-gray-600">3</td>
            <td class="p-3">Keluarga & Teman</td>
            <td class="p-3 text-yellow-600 font-bold">70</td>
            <td class="p-3"><span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">Mengulang</span></td>
            <td class="p-3 text-gray-500">28 Okt 2025</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Catatan Motivasi -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6 rounded-xl shadow-lg mt-8">
      <h3 class="font-bold text-lg mb-2">✨ Tetap Semangat!</h3>
      <p class="text-sm opacity-90">Kamu hampir mencapai targetmu. Teruskan progres belajarmu dan tingkatkan nilai kuis berikutnya!</p>
    </div>

  </main>
</div>

{{-- Animasi Masuk --}}
<style>
@keyframes fade-in {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
.fade-in { animation: fade-in 0.5s ease-in-out; }
</style>
@endsection

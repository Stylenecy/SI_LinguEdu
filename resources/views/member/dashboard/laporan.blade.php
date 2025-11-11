@extends('layouts.main')
@section('title', 'Laporan Progres - LinguEdu')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-100">
  <aside class="w-full md:w-64 bg-white shadow-md p-6">
    <a href="{{ route('dashboard.index') }}" class="block text-blue-600 font-bold mb-4 hover:underline">← Kembali ke Dashboard</a>
  </aside>

  <main class="flex-1 p-8">
    <h1 class="text-2xl font-bold mb-6">Laporan Progres</h1>
    <table class="w-full bg-white shadow-md rounded-lg">
      <thead class="bg-blue-50">
        <tr>
          <th class="p-3 text-left">Kuis</th>
          <th class="p-3 text-left">Nilai</th>
          <th class="p-3 text-left">Status</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        <tr>
          <td class="p-3">Kuis Salam & Perkenalan</td>
          <td class="p-3">80</td>
          <td class="p-3 text-green-600 font-semibold">Lulus</td>
        </tr>
        <tr>
          <td class="p-3">Kuis Angka & Hari</td>
          <td class="p-3">60</td>
          <td class="p-3 text-red-600 font-semibold">Gagal</td>
        </tr>
      </tbody>
    </table>
  </main>
</div>
@endsection

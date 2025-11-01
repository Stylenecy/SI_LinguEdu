@extends('layouts.main')
@section('title', 'Materi - LinguEdu')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-gray-100">
  <aside class="w-full md:w-64 bg-white shadow-md p-6">
    <a href="{{ route('dashboard.index') }}" class="block text-blue-600 font-bold mb-4 hover:underline">← Kembali ke Dashboard</a>
  </aside>

  <main class="flex-1 p-8">
    <h1 class="text-2xl font-bold mb-4">Materi Belajar</h1>
    <p class="text-gray-600 mb-6">Pilih materi dan ikuti urutan: Video → Teori → Kuis.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-semibold mb-2 text-blue-600">Level 1: Salam & Perkenalan</h3>
        <p class="text-gray-600 text-sm">Dasar percakapan harian.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
        <h3 class="font-semibold mb-2 text-blue-600">Level 2: Angka & Hari</h3>
        <p class="text-gray-600 text-sm">Belajar angka dan menyebut hari.</p>
      </div>
    </div>
  </main>
</div>
@endsection

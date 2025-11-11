@extends('layouts.main')
@section('title', 'Sertifikasi - LinguEdu')

@section('content')
    <div class="min-h-screen flex flex-col md:flex-row bg-gray-100">
        <aside class="w-full md:w-64 bg-white shadow-md p-6">
            <a href="{{ route('dashboard.index') }}" class="block text-blue-600 font-bold mb-4 hover:underline">← Kembali ke
                Dashboard</a>
        </aside>

        <main class="flex-1 p-8 text-center">
            <h1 class="text-2xl font-bold mb-4">Ujian Sertifikasi</h1>
            <p class="text-gray-600 mb-6">Ujian ini hanya bisa diakses jika kamu sudah menyelesaikan semua level.</p>

            <div class="bg-white rounded-xl p-8 shadow-lg inline-block">
                <i class="fas fa-lock text-5xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Kamu belum mencapai Level 3. Selesaikan semua materi untuk membuka ujian
                    sertifikasi.</p>
            </div>
        </main>
    </div>
@endsection

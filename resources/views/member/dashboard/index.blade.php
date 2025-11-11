@extends('layouts.main')
@section('title', 'Dashboard - LinguEdu')

@section('content')
    <div class="min-h-screen flex flex-col md:flex-row bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-white shadow-md p-6 space-y-4">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">LinguEdu</h2>
            <nav class="space-y-2">
                <a href="{{ route('dashboard.index') }}"
                    class="block px-4 py-2 rounded-lg bg-blue-50 text-blue-700 font-medium">🏠 Dashboard</a>
                <a href="{{ route('dashboard.materi') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50">📚 Materi</a>
                <a href="{{ route('dashboard.laporan') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50">📊 Laporan
                    Progres</a>
                <a href="{{ route('dashboard.sertifikasi') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-50">🎓 Ujian
                    Sertifikasi</a>
            </nav>
            <hr>
            <a href="{{ route('logout.simulasi') }}"
                class="block mt-4 text-red-600 font-semibold hover:underline">Logout</a>
        </aside>

        <!-- Konten -->
        <main class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Dashboard LinguEdu!</h1>
            <p class="text-gray-600 mb-8">Kamu bisa mengakses materi, kuis, dan laporan progres di sini.</p>

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <p>🎯 Progres kamu: <b>Level 1</b> (0/20 XP)</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 p-6 rounded-lg shadow-sm text-center">
                    <h3 class="font-bold text-lg text-blue-600">Materi</h3>
                    <p class="text-gray-500 text-sm mt-2">Belajar sesuai level dan kuis interaktif</p>
                    <a href="{{ route('dashboard.materi') }}"
                        class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Akses</a>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow-sm text-center">
                    <h3 class="font-bold text-lg text-green-600">Laporan</h3>
                    <p class="text-gray-500 text-sm mt-2">Pantau nilai kuis dan progresmu</p>
                    <a href="{{ route('dashboard.laporan') }}"
                        class="inline-block mt-3 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Lihat</a>
                </div>
                <div class="bg-yellow-50 p-6 rounded-lg shadow-sm text-center">
                    <h3 class="font-bold text-lg text-yellow-600">Sertifikasi</h3>
                    <p class="text-gray-500 text-sm mt-2">Ujian akhir untuk pengguna level 3</p>
                    <a href="{{ route('dashboard.sertifikasi') }}"
                        class="inline-block mt-3 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Mulai</a>
                </div>
            </div>
        </main>
    </div>
@endsection

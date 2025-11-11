<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - LinguEdu')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/materi.css') }}">
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <h1 class="text-2xl font-extrabold text-indigo-700 tracking-wide">🌐 LinguEdu</h1>
        <nav class="flex gap-6 text-gray-700">
            <a href="{{ route('dashboard.index') }}" class="hover:text-indigo-600 font-semibold">Dashboard</a>
            <a href="{{ route('dashboard.materi') }}" class="hover:text-indigo-600 font-semibold">Materi</a>
            <a href="{{ route('dashboard.laporan') }}" class="hover:text-indigo-600 font-semibold">Progress</a>
            <a href="{{ route('dashboard.sertifikasi') }}" class="hover:text-indigo-600 font-semibold">Sertifikasi</a>
        </nav>
        <a href="{{ route('login.simulasi') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 font-semibold shadow">
            🚪 Keluar
        </a>
    </header>

    <!-- Konten -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 text-gray-600 border-t border-indigo-100">
        <p>© {{ date('Y') }} LinguEdu — Semua Hak Dilindungi</p>
    </footer>

    @stack('scripts')
</body>

</html>

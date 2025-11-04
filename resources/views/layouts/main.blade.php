<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="flex bg-gray-100 min-h-screen">
  
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-lg border-r border-gray-200 fixed top-0 left-0 h-screen overflow-y-auto">
    <div class="p-6 space-y-6">
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
    </div>
  </aside>

  <!-- Konten utama -->
  <div class="flex-1 ml-64">
    @yield('content')
  </div>

</body>
</html>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — LinguEdu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @stack('head')
</head>
<body class="min-h-screen bg-paper antialiased">

    {{-- ===== Mobile overlay ===== --}}
    <div id="adminOverlay" class="fixed inset-0 z-30 hidden bg-ink-900/40 backdrop-blur-sm lg:hidden"></div>

    {{-- ===== Sidebar ===== --}}
    <aside id="adminSidebar"
           class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-line bg-surface transition-transform duration-300 lg:translate-x-0">

        {{-- Logo --}}
        <div class="flex h-16 items-center gap-2.5 border-b border-line px-5">
            <span class="grid h-9 w-9 place-items-center rounded-xl text-white shadow-[var(--shadow-glow)]"
                  style="background-image:linear-gradient(135deg,var(--color-brand-500),var(--color-brand-700))">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 5h11M4 5v11m0-11 8 8m4 3 4 0m-4 0-3-7 7 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span class="text-xl font-display font-semibold text-ink">Lingu<span class="text-brand">Edu</span></span>
            <span class="badge badge-brand ml-auto">Admin</span>
        </div>

        {{-- Nav --}}
        <nav class="flex flex-1 flex-col gap-1 overflow-y-auto p-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 13h7V4H4v9Zm0 7h7v-5H4v5Zm9 0h7v-9h-7v9Zm0-16v5h7V4h-7Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.users') ? 'nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M16 19v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm13 10v-2a4 4 0 0 0-3-3.87M16 3.13A4 4 0 0 1 16 11" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Pengguna
            </a>
            <a href="{{ route('admin.materi') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.materi') ? 'nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Materi
            </a>
            <a href="{{ route('admin.kuis') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.kuis') ? 'nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M9.09 9a3 3 0 1 1 5.83 1c0 2-3 3-3 3M12 17h.01M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Kuis
            </a>
            <a href="{{ route('admin.paket') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.paket') ? 'nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z M3.27 6.96 12 12.01l8.73-5.05M12 22.08V12" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Paket
            </a>
            <a href="{{ route('admin.sertifikasi') }}" class="nav-link flex items-center gap-3 {{ request()->routeIs('admin.sertifikasi') ? 'nav-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M15 15a6 6 0 1 0-6 0m6 0-3 7-3-7m6 0a6 6 0 0 1-6 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Sertifikat
            </a>
        </nav>

        {{-- Footer --}}
        <div class="border-t border-line p-4">
            <div class="mb-3 flex items-center gap-2.5 px-1">
                <span class="grid h-9 w-9 place-items-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-medium text-ink">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="truncate text-xs text-muted">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost w-full">
                    <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 14 5-5-5-5m5 5H9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== Main area ===== --}}
    <div class="lg:pl-64">

        {{-- Topbar --}}
        <header class="sticky top-0 z-20 border-b border-line bg-surface/80 backdrop-blur-xl">
            <div class="flex h-16 items-center justify-between px-5 sm:px-8">
                <div class="flex items-center gap-3">
                    <button id="adminMenuBtn" class="grid h-9 w-9 place-items-center rounded-lg border border-line lg:hidden" aria-label="Menu">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </button>
                    <h1 class="font-display text-xl font-semibold text-ink">@yield('page_title', 'Dashboard')</h1>
                </div>
                <a href="{{ route('home') }}" class="btn btn-outline btn-sm">
                    <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4"><path d="M15 3h6v6m0-6L10 14M19 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Lihat situs
                </a>
            </div>
        </header>

        <main class="container-page py-8">
            @yield('content')
        </main>
    </div>

    <script>
        (function () {
            const btn = document.getElementById('adminMenuBtn');
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminOverlay');
            function open() { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); }
            function close() { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); }
            btn && btn.addEventListener('click', open);
            overlay && overlay.addEventListener('click', close);
        })();
    </script>
    @stack('scripts')
</body>
</html>

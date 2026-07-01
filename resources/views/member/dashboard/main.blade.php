<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LinguEdu Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @stack('head')
</head>
<body class="min-h-screen flex flex-col bg-paper antialiased">

    {{-- ===== Top navbar ===== --}}
    <header class="sticky top-0 z-50 border-b border-line bg-surface/80 backdrop-blur-xl">
        <div class="container-page flex h-16 items-center justify-between">
            <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2.5">
                <span class="grid h-9 w-9 place-items-center rounded-xl text-white shadow-[var(--shadow-glow)]"
                      style="background-image:linear-gradient(135deg,var(--color-brand-500),var(--color-brand-700))">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 5h11M4 5v11m0-11 8 8m4 3 4 0m-4 0-3-7 7 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span class="text-xl font-display font-semibold text-ink">Lingu<span class="text-brand">Edu</span></span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('dashboard.index') }}"   class="nav-link {{ request()->routeIs('dashboard.index') ? 'nav-link-active' : '' }}">Dashboard</a>
                <a href="{{ route('dashboard.materi') }}"   class="nav-link {{ request()->routeIs('dashboard.materi') || request()->routeIs('member.*') ? 'nav-link-active' : '' }}">Materi</a>
                <a href="{{ route('dashboard.laporan') }}"  class="nav-link {{ request()->routeIs('dashboard.laporan') ? 'nav-link-active' : '' }}">Progress</a>
                <a href="{{ route('dashboard.sertifikasi') }}" class="nav-link {{ request()->routeIs('dashboard.sertifikasi') ? 'nav-link-active' : '' }}">Sertifikat</a>
            </nav>

            <div class="flex items-center gap-3">
                <div class="hidden items-center gap-2.5 sm:flex">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </span>
                    <span class="text-sm font-medium text-ink">{{ auth()->user()->name ?? 'User' }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="btn btn-ghost btn-sm">Keluar</button>
                </form>
                <button id="menuBtn" class="grid h-9 w-9 place-items-center rounded-lg border border-line md:hidden" aria-label="Menu">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
            </div>
        </div>
        {{-- mobile menu --}}
        <div id="mobileMenu" class="hidden border-t border-line md:hidden">
            <nav class="container-page flex flex-col gap-1 py-3">
                <a href="{{ route('dashboard.index') }}"   class="nav-link {{ request()->routeIs('dashboard.index') ? 'nav-link-active' : '' }}">Dashboard</a>
                <a href="{{ route('dashboard.materi') }}"   class="nav-link {{ request()->routeIs('dashboard.materi') ? 'nav-link-active' : '' }}">Materi</a>
                <a href="{{ route('dashboard.laporan') }}"  class="nav-link {{ request()->routeIs('dashboard.laporan') ? 'nav-link-active' : '' }}">Progress</a>
                <a href="{{ route('dashboard.sertifikasi') }}" class="nav-link {{ request()->routeIs('dashboard.sertifikasi') ? 'nav-link-active' : '' }}">Sertifikat</a>
            </nav>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-line bg-surface">
        <div class="container-page flex flex-col items-center justify-between gap-2 py-6 text-sm text-muted sm:flex-row">
            <p>© {{ date('Y') }} <span class="font-semibold text-brand">LinguEdu</span> — Belajar bahasa Inggris dengan menyenangkan.</p>
            <p class="text-xs">Beginner · Intermediate · Advanced</p>
        </div>
    </footer>

    <script>
        const mb = document.getElementById('menuBtn'), mm = document.getElementById('mobileMenu');
        mb && mb.addEventListener('click', () => mm.classList.toggle('hidden'));
    </script>
    @stack('scripts')
</body>
</html>

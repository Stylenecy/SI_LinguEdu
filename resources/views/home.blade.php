@extends('layouts.main')
@section('title', 'LinguEdu — Belajar Bahasa Inggris dari Nol sampai Mahir')

@section('content')
<div class="mesh-warm">
    {{-- ===== Navbar ===== --}}
    <header class="sticky top-0 z-50 border-b border-line bg-surface/70 backdrop-blur-xl">
        <div class="container-page flex h-16 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <span class="grid h-9 w-9 place-items-center rounded-xl text-white shadow-[var(--shadow-glow)]"
                      style="background-image:linear-gradient(135deg,var(--color-brand-500),var(--color-brand-700))">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 5h11M4 5v11m0-11 8 8m4 3 4 0m-4 0-3-7 7 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span class="text-xl font-display font-semibold text-ink">Lingu<span class="text-brand">Edu</span></span>
            </a>
            <nav class="hidden items-center gap-1 md:flex">
                <a href="#cara" class="nav-link">Cara Belajar</a>
                <a href="#level" class="nav-link">Level</a>
                <a href="#paket" class="nav-link">Paket</a>
            </nav>
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar Gratis</a>
            </div>
        </div>
    </header>

    {{-- ===== Hero ===== --}}
    <section class="container-page grid items-center gap-12 py-16 lg:grid-cols-2 lg:py-24">
        <div>
            <span class="eyebrow">English · Beginner → Advanced</span>
            <h1 class="mt-4 text-4xl font-semibold leading-[1.05] text-ink sm:text-5xl lg:text-6xl">
                Kuasai bahasa Inggris,<br><span class="text-brand">satu level setiap saat.</span>
            </h1>
            <p class="mt-6 max-w-md text-lg text-muted">
                Belajar lewat video, pahami teori, lalu uji dengan kuis interaktif. Naik level, lacak progres,
                dan raih sertifikat resmi LinguEdu.
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Mulai Belajar Gratis →</a>
                <a href="{{ route('login') }}" class="btn btn-white btn-lg">Sudah punya akun</a>
            </div>
            <div class="mt-10 flex flex-wrap gap-x-8 gap-y-3 text-sm text-muted">
                <span class="flex items-center gap-2"><span class="text-brand">●</span> 9 materi terstruktur</span>
                <span class="flex items-center gap-2"><span class="text-brand">●</span> Kuis otomatis dinilai</span>
                <span class="flex items-center gap-2"><span class="text-brand">●</span> Sertifikat kelulusan</span>
            </div>
        </div>

        {{-- Floating mock card --}}
        <div class="relative">
            <div class="card card-hover mx-auto max-w-sm p-6">
                <div class="flex items-center justify-between">
                    <span class="badge badge-brand">Level 1 · Beginner</span>
                    <span class="text-xs text-muted">3/3 selesai</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-ink">Greetings &amp; Introductions</h3>
                <p class="mt-1 text-sm text-muted">Menyapa &amp; memperkenalkan diri dengan percaya diri.</p>
                <div class="mt-4 track"><div class="track-fill" style="width:100%"></div></div>
                <div class="mt-5 flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-full bg-brand-50 text-lg">🎬</span>
                    <span class="grid h-10 w-10 place-items-center rounded-full bg-brand-50 text-lg">📖</span>
                    <span class="grid h-10 w-10 place-items-center rounded-full bg-brand-50 text-lg">🎯</span>
                    <span class="ml-auto badge badge-success">Skor 100</span>
                </div>
            </div>
            <div class="card absolute -bottom-6 -left-2 hidden w-44 p-4 sm:block">
                <p class="text-xs text-muted">Progres kamu</p>
                <p class="font-display text-3xl font-semibold text-brand">78%</p>
                <div class="mt-2 track"><div class="track-fill" style="width:78%"></div></div>
            </div>
        </div>
    </section>
</div>

{{-- ===== How it works ===== --}}
<section id="cara" class="container-page py-20">
    <div class="mx-auto max-w-2xl text-center">
        <span class="eyebrow">Cara Belajar</span>
        <h2 class="mt-3 text-3xl font-semibold text-ink sm:text-4xl">Tiga langkah tiap materi</h2>
        <p class="mt-3 text-muted">Alur sederhana yang terbukti: tonton, pahami, lalu praktik.</p>
    </div>
    <div class="mt-12 grid gap-6 md:grid-cols-3">
        @foreach ([
            ['🎬','Tonton Video','Penjelasan singkat dan jelas dari setiap topik.'],
            ['📖','Pahami Teori','Rangkuman materi yang mudah dicerna, bisa dibaca ulang.'],
            ['🎯','Kerjakan Kuis','Uji pemahaman — skor ≥70 untuk membuka materi berikutnya.'],
        ] as $i => $s)
            <div class="card card-hover p-7">
                <div class="flex items-center gap-3">
                    <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-2xl">{{ $s[0] }}</span>
                    <span class="font-display text-3xl text-brand-200">0{{ $i + 1 }}</span>
                </div>
                <h3 class="mt-5 text-xl font-semibold text-ink">{{ $s[1] }}</h3>
                <p class="mt-2 text-muted">{{ $s[2] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ===== Levels ===== --}}
<section id="level" class="border-y border-line bg-surface py-20">
    <div class="container-page">
        <div class="mx-auto max-w-2xl text-center">
            <span class="eyebrow">Kurikulum</span>
            <h2 class="mt-3 text-3xl font-semibold text-ink sm:text-4xl">Tiga level, alur naik bertahap</h2>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['Beginner','Dasar percakapan: sapaan, angka, present simple.','brand', ['Greetings','Numbers &amp; Time','Present Simple']],
                ['Intermediate','Tata bahasa menengah & ekspresi sehari-hari.','accent', ['Past Simple','Comparatives','Modal Verbs']],
                ['Advanced','Struktur kompleks & ungkapan natural.','success', ['Present Perfect','Conditionals','Idioms']],
            ] as $i => $lv)
                <div class="card card-hover overflow-hidden p-0">
                    <div class="flex items-center justify-between px-6 py-5"
                         style="background-image:linear-gradient(135deg,var(--color-brand-{{ [600,500,700][$i] }}),var(--color-brand-800))">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-widest text-white/70">Level {{ $i + 1 }}</p>
                            <h3 class="font-display text-2xl font-semibold text-white">{{ $lv[0] }}</h3>
                        </div>
                        <span class="font-display text-4xl text-white/30">{{ $i + 1 }}</span>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-muted">{{ $lv[1] }}</p>
                        <ul class="mt-4 space-y-2 text-sm text-ink">
                            @foreach ($lv[3] as $t)
                                <li class="flex items-center gap-2"><span class="text-brand">✓</span> {!! $t !!}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== Packages ===== --}}
<section id="paket" class="container-page py-20">
    <div class="mx-auto max-w-2xl text-center">
        <span class="eyebrow">Paket</span>
        <h2 class="mt-3 text-3xl font-semibold text-ink sm:text-4xl">Mulai gratis, lanjut saat siap</h2>
    </div>
    <div class="mt-12 grid gap-6 md:grid-cols-3">
        @foreach ([
            ['Free Trial','Gratis','Akses Level 1 selamanya.', ['Materi Level 1','Kuis interaktif','Lacak progres'], false],
            ['Premium Bulanan','Rp49.000','Semua level + sertifikat, per bulan.', ['Semua 3 level','Sertifikat kelulusan','Semua kuis & teori'], true],
            ['Premium Tahunan','Rp349.000','Hemat 40% + bimbingan tutor, setahun.', ['Semua fitur Premium','Bimbingan tutor','Akses 1 tahun'], false],
        ] as $p)
            <div class="card {{ $p[4] ? 'ring-2 ring-brand-400' : '' }} relative p-7">
                @if ($p[4])<span class="badge badge-accent absolute -top-3 left-1/2 -translate-x-1/2">Terpopuler</span>@endif
                <h3 class="text-lg font-semibold text-ink">{{ $p[0] }}</h3>
                <p class="mt-3 font-display text-4xl font-semibold text-brand">{{ $p[1] }}</p>
                <p class="mt-2 text-sm text-muted">{{ $p[2] }}</p>
                <ul class="mt-5 space-y-2 text-sm text-ink">
                    @foreach ($p[3] as $f)
                        <li class="flex items-center gap-2"><span class="text-brand">✓</span> {{ $f }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" class="btn {{ $p[4] ? 'btn-primary' : 'btn-outline' }} mt-6 w-full">Pilih Paket</a>
            </div>
        @endforeach
    </div>
</section>

{{-- ===== CTA band ===== --}}
<section class="container-page pb-20">
    <div class="mesh-brand relative overflow-hidden rounded-3xl px-8 py-16 text-center shadow-[var(--shadow-lift)]">
        <h2 class="font-display text-3xl font-semibold text-white sm:text-4xl">Siap naik level hari ini?</h2>
        <p class="mx-auto mt-3 max-w-md text-white/80">Buat akun gratis dalam 30 detik dan mulai materi pertamamu.</p>
        <a href="{{ route('register') }}" class="btn btn-white btn-lg mt-8">Daftar Sekarang — Gratis</a>
    </div>
</section>

<footer class="border-t border-line bg-surface">
    <div class="container-page flex flex-col items-center justify-between gap-3 py-8 text-sm text-muted sm:flex-row">
        <span>© {{ date('Y') }} <span class="font-semibold text-brand">LinguEdu</span></span>
        <span class="text-xs">Dibuat untuk pembelajar bahasa Inggris Indonesia.</span>
    </div>
</footer>
@endsection

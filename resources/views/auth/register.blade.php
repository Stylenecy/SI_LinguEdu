@extends('layouts.main')
@section('title', 'Daftar — LinguEdu')

@section('content')
<div class="grid min-h-screen lg:grid-cols-2">
    {{-- Form --}}
    <div class="order-2 flex items-center justify-center bg-paper px-6 py-12 lg:order-1">
        <div class="w-full max-w-sm">
            <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-2 text-sm text-muted lg:hidden">← Kembali</a>
            <span class="eyebrow">Gratis selamanya untuk Level 1</span>
            <h1 class="mt-2 text-3xl font-semibold text-ink">Gabung ke LinguEdu</h1>
            <p class="mt-2 text-sm text-muted">Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-brand hover:underline">Masuk di sini</a>
            </p>

            @if ($errors->any())
                <div class="alert alert-danger mt-6">
                    <ul class="list-disc space-y-0.5 ps-5">
                        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="name" class="field-label">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                           class="field" placeholder="Nama kamu">
                </div>
                <div>
                    <label for="email" class="field-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="field" placeholder="email@anda.com">
                </div>
                <div>
                    <label for="password" class="field-label">Password</label>
                    <input type="password" id="password" name="password" required class="field" placeholder="Minimal 6 karakter">
                </div>
                <div>
                    <label for="password_confirmation" class="field-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="field" placeholder="Ulangi password">
                </div>
                <button type="submit" class="btn btn-primary w-full">Daftar Sekarang</button>
            </form>
            <p class="mt-4 text-center text-xs text-muted">Dengan mendaftar, kamu menyetujui ketentuan LinguEdu.</p>
        </div>
    </div>

    {{-- Brand panel --}}
    <div class="mesh-brand relative order-1 hidden flex-col justify-between p-12 lg:order-2 lg:flex">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 self-end">
            <span class="text-xl font-display font-semibold text-white">LinguEdu</span>
            <span class="grid h-9 w-9 place-items-center rounded-xl bg-white/15 text-white">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 5h11M4 5v11m0-11 8 8m4 3 4 0m-4 0-3-7 7 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
        </a>
        <div>
            <h2 class="font-display text-4xl font-semibold leading-tight text-white">Mulai dari nol,<br>sampai mahir.</h2>
            <ul class="mt-6 space-y-3 text-white/85">
                <li class="flex items-center gap-3"><span class="grid h-8 w-8 place-items-center rounded-full bg-white/15">🎬</span> Video + teori tiap materi</li>
                <li class="flex items-center gap-3"><span class="grid h-8 w-8 place-items-center rounded-full bg-white/15">🎯</span> Kuis dinilai otomatis</li>
                <li class="flex items-center gap-3"><span class="grid h-8 w-8 place-items-center rounded-full bg-white/15">🎓</span> Sertifikat kelulusan</li>
            </ul>
        </div>
        <p class="text-sm text-white/50">© {{ date('Y') }} LinguEdu</p>
    </div>
</div>
@endsection

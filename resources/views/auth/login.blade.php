@extends('layouts.main')
@section('title', 'Masuk — LinguEdu')

@section('content')
<div class="grid min-h-screen lg:grid-cols-2">
    {{-- Brand panel --}}
    <div class="mesh-brand relative hidden flex-col justify-between p-12 lg:flex">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <span class="grid h-9 w-9 place-items-center rounded-xl bg-white/15 text-white">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 5h11M4 5v11m0-11 8 8m4 3 4 0m-4 0-3-7 7 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <span class="text-xl font-display font-semibold text-white">LinguEdu</span>
        </a>
        <div>
            <h2 class="font-display text-4xl font-semibold leading-tight text-white">Lanjutkan<br>perjalanan belajarmu.</h2>
            <p class="mt-4 max-w-sm text-white/75">Masuk untuk membuka materi berikutnya, melihat progres, dan mengejar sertifikatmu.</p>
        </div>
        <p class="text-sm text-white/50">© {{ date('Y') }} LinguEdu</p>
    </div>

    {{-- Form --}}
    <div class="flex items-center justify-center bg-paper px-6 py-12">
        <div class="w-full max-w-sm">
            <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-2 text-sm text-muted lg:hidden">← Kembali</a>
            <span class="eyebrow">Selamat datang kembali</span>
            <h1 class="mt-2 text-3xl font-semibold text-ink">Masuk ke LinguEdu</h1>
            <p class="mt-2 text-sm text-muted">Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-brand hover:underline">Daftar gratis</a>
            </p>

            @if ($errors->any())
                <div class="alert alert-danger mt-6">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="email" class="field-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="field" placeholder="email@anda.com">
                </div>
                <div>
                    <label for="password" class="field-label">Password</label>
                    <input type="password" id="password" name="password" required class="field" placeholder="••••••••">
                </div>
                <label class="flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" name="remember" class="rounded border-line text-brand-600 focus:ring-brand-400"> Ingat saya
                </label>
                <button type="submit" class="btn btn-primary w-full">Masuk</button>
            </form>

            <div class="mt-6 flex items-center justify-between text-sm">
                <a href="{{ route('password.request') }}" class="text-muted hover:text-brand">Lupa password?</a>
                <a href="{{ route('admin.login') }}" class="text-muted hover:text-brand">Masuk sebagai admin →</a>
            </div>

            <div class="mt-8 rounded-2xl border border-line bg-surface p-4 text-xs text-muted">
                <p class="font-semibold text-ink">Akun demo</p>
                <p class="mt-1">Siswa: <span class="text-brand">siswa@linguedu.com</span> / password</p>
                <p>Admin: <span class="text-brand">adminlinguedu@gmail.com</span> / admin1234</p>
            </div>
        </div>
    </div>
</div>
@endsection

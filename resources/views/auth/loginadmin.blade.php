@extends('layouts.main')
@section('title', 'Admin — LinguEdu')

@section('content')
<div class="grid min-h-screen place-items-center bg-paper px-6 py-12">
    <div class="w-full max-w-sm">
        <div class="card p-8">
            <div class="flex items-center gap-2.5">
                <span class="grid h-10 w-10 place-items-center rounded-xl text-white shadow-[var(--shadow-glow)]"
                      style="background-image:linear-gradient(135deg,var(--color-brand-500),var(--color-brand-700))">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M12 3 4 6v5c0 4.5 3 8 8 10 5-2 8-5.5 8-10V6l-8-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                </span>
                <div>
                    <h1 class="text-lg font-semibold text-ink">Admin Panel</h1>
                    <p class="text-xs text-muted">LinguEdu — khusus administrator</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mt-6">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="email" class="field-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="field" placeholder="adminlinguedu@gmail.com">
                </div>
                <div>
                    <label for="password" class="field-label">Password</label>
                    <input type="password" id="password" name="password" required class="field" placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary w-full">Masuk sebagai Admin</button>
            </form>
        </div>
        <div class="mt-4 text-center text-sm">
            <a href="{{ route('login') }}" class="text-muted hover:text-brand">← Masuk sebagai siswa</a>
        </div>
    </div>
</div>
@endsection

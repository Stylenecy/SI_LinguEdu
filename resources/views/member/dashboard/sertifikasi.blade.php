@extends('member.dashboard.main')
@section('title', 'Sertifikat — LinguEdu')

@push('head')
<style>
    @media print {
        header, footer, .no-print { display: none !important; }
        body { background: #fff !important; }
        #certificate { box-shadow: none !important; border-width: 6px !important; }
    }
</style>
@endpush

@section('content')
<div class="container-page py-10" style="max-width:52rem">
    <div class="text-center">
        <span class="eyebrow">Sertifikasi</span>
        <h1 class="mt-3 font-display text-3xl font-semibold text-ink sm:text-4xl">Sertifikat LinguEdu</h1>
        <p class="mt-2 text-muted">Terbit setelah kamu menyelesaikan semua materi Level 1–3.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mt-6 text-center">{{ session('status') }}</div>
    @endif

    @if ($certificate)
        {{-- Issued --}}
        <div id="certificate" class="mt-8 overflow-hidden rounded-3xl border-[10px] p-10 text-center shadow-[var(--shadow-lift)]"
             style="border-color:var(--color-brand-600); background:radial-gradient(60rem 30rem at 50% -20%, var(--color-brand-50), var(--color-surface))">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-muted">Certificate of Completion</p>
            <h2 class="mt-3 font-display text-5xl font-semibold text-brand">LinguEdu</h2>
            <p class="mt-6 text-muted">Dengan ini menyatakan bahwa</p>
            <p class="mt-2 font-display text-3xl font-semibold text-ink">{{ $user->name }}</p>
            <p class="mt-2 text-muted">telah menyelesaikan</p>
            <p class="mt-1 text-lg font-semibold text-ink">English Proficiency Program · Beginner → Advanced</p>
            <p class="mt-4 text-ink">Nilai Akhir: <b class="text-brand">{{ $certificate->final_score }}</b> / 100</p>
            <div class="mx-auto my-6 h-px w-2/3 bg-[color:var(--color-line)]"></div>
            <div class="flex items-center justify-between text-xs text-muted">
                <span>No: {{ $certificate->certificate_number }}</span>
                <span>{{ $certificate->issued_at->translatedFormat('d M Y') }}</span>
            </div>
        </div>
        <div class="no-print mt-5 text-center">
            <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak / Simpan PDF</button>
        </div>
    @elseif ($eligible)
        {{-- Eligible --}}
        <div class="card mt-8 p-10 text-center">
            <div class="text-5xl">✅</div>
            <h2 class="mt-3 font-display text-2xl font-semibold text-ink">Semua level selesai!</h2>
            <p class="mt-2 text-muted">Nilai akhir kamu: <b class="text-brand">{{ $finalScore }}</b> / 100. Terbitkan sertifikatmu sekarang.</p>
            <form method="POST" action="{{ route('certificate.issue') }}" class="mt-6">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Terbitkan Sertifikat 🎓</button>
            </form>
        </div>
    @else
        {{-- Locked --}}
        <div class="card mt-8 p-10 text-center">
            <div class="text-5xl opacity-60">🔒</div>
            <h2 class="mt-3 font-display text-2xl font-semibold text-ink">Sertifikat Masih Terkunci</h2>
            <p class="mt-2 text-muted">Selesaikan semua materi hingga Level 3 (Advanced) untuk membuka sertifikat.</p>
            <a href="{{ route('dashboard.materi') }}" class="btn btn-primary mt-6">Lanjut Belajar</a>
        </div>
    @endif
</div>
@endsection

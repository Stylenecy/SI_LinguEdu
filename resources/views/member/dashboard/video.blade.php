@extends('member.dashboard.main')
@section('title', $lesson->title . ' — Video')

@section('content')
<div class="container-page py-10" style="max-width:64rem">
    <a href="{{ route('dashboard.materi') }}" class="text-sm text-muted hover:text-brand">← Kembali ke Materi</a>

    <div class="mt-4 flex items-center gap-3">
        <span class="badge badge-brand">Level {{ $lesson->level }} · {{ $lesson->levelName() }}</span>
        <span class="badge badge-muted">Langkah 1 dari 3 · Video</span>
    </div>
    <h1 class="mt-3 font-display text-3xl font-semibold text-ink">{{ $lesson->title }}</h1>
    <p class="mt-2 max-w-2xl text-muted">{{ $lesson->description }}</p>

    <div class="mt-6 overflow-hidden rounded-3xl border border-line bg-black shadow-[var(--shadow-lift)]">
        <div class="relative w-full" style="aspect-ratio:16/9">
            <iframe class="absolute inset-0 h-full w-full"
                src="https://www.youtube.com/embed/{{ $lesson->video_url ?: 'Kvb4gfoMprM' }}?rel=0&modestbranding=1"
                title="{{ $lesson->title }}" allowfullscreen></iframe>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <div class="flex items-center gap-2 text-sm text-muted">
            <span class="h-2 w-8 rounded-full bg-brand-500"></span>
            <span class="h-2 w-8 rounded-full bg-brand-100"></span>
            <span class="h-2 w-8 rounded-full bg-brand-100"></span>
        </div>
        <a href="{{ route('member.theory', $lesson->slug) }}" class="btn btn-primary btn-lg">Lanjut ke Teori 📖</a>
    </div>
</div>
@endsection

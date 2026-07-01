@extends('member.dashboard.main')
@section('title', $lesson->title . ' — Teori')

@section('content')
<div class="container-page py-10" style="max-width:48rem">
    <a href="{{ route('member.video', $lesson->slug) }}" class="text-sm text-muted hover:text-brand">← Kembali ke Video</a>

    <div class="mt-4 flex items-center gap-3">
        <span class="badge badge-brand">Level {{ $lesson->level }} · {{ $lesson->levelName() }}</span>
        <span class="badge badge-muted">Langkah 2 dari 3 · Teori</span>
    </div>
    <h1 class="mt-3 font-display text-3xl font-semibold text-ink">{{ $lesson->title }}</h1>

    <article class="card mt-6 p-8 leading-relaxed text-ink
                    [&_p]:mt-3 [&_ul]:mt-3 [&_ul]:list-disc [&_ul]:ps-6 [&_li]:mt-1.5
                    [&_b]:text-brand-700 [&_i]:text-ink">
        {!! $lesson->theory ?: '<p class="text-muted">Materi teori belum tersedia.</p>' !!}
    </article>

    <div class="mt-8 text-center">
        @if ($lesson->questions()->exists())
            <a href="{{ route('member.kuis', $lesson->slug) }}" class="btn btn-primary btn-lg">Mulai Kuis 🎯</a>
            <p class="mt-2 text-sm text-muted">Skor minimal 70 untuk menyelesaikan materi ini.</p>
        @else
            <span class="text-muted">Belum ada kuis untuk materi ini.</span>
        @endif
    </div>
</div>
@endsection

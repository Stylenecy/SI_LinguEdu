@extends('member.dashboard.main')
@section('title', $lesson->title . ' — Kuis')

@section('content')
<div class="container-page py-10" style="max-width:44rem">
    <div class="flex items-center gap-3">
        <span class="badge badge-brand">Level {{ $lesson->level }} · {{ $lesson->levelName() }}</span>
        <span class="badge badge-muted">Langkah 3 dari 3 · Kuis</span>
    </div>
    <h1 class="mt-3 font-display text-3xl font-semibold text-ink">Kuis: {{ $lesson->title }}</h1>
    <p class="mt-2 text-muted">Jawab semua soal. Skor minimal <b class="text-brand">70</b> untuk lulus.</p>

    @if ($errors->any())
        <div class="alert alert-danger mt-5">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('member.kuis.submit', $lesson->slug) }}" class="mt-6 space-y-5">
        @csrf
        @foreach ($lesson->questions as $i => $q)
            <div class="card p-6">
                <div class="flex gap-3">
                    <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-brand-50 text-sm font-semibold text-brand-700">{{ $i + 1 }}</span>
                    <h3 class="font-semibold text-ink">{{ $q->question }}</h3>
                </div>
                <div class="mt-4 space-y-2.5">
                    @foreach ($q->options() as $letter => $text)
                        <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-line bg-paper px-4 py-3 text-sm transition-all hover:border-brand-300 has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50">
                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $letter }}" required
                                   class="text-brand-600 focus:ring-brand-400">
                            <span class="font-semibold uppercase text-brand-700">{{ $letter }}</span>
                            <span class="text-ink">{{ $text }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex items-center justify-between">
            <a href="{{ route('member.theory', $lesson->slug) }}" class="btn btn-ghost">← Teori</a>
            <button type="submit" class="btn btn-primary btn-lg">Kumpulkan Jawaban</button>
        </div>
    </form>
</div>
@endsection

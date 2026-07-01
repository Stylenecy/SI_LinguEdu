@extends('member.dashboard.main')
@section('title', 'Hasil Kuis — ' . $lesson->title)

@section('content')
<div class="container-page py-10" style="max-width:44rem">
    {{-- Score card --}}
    <div class="card overflow-hidden p-0 text-center">
        <div class="{{ $passed ? 'mesh-brand' : '' }} px-8 py-10" @unless($passed) style="background:linear-gradient(135deg,var(--color-accent-400),var(--color-accent-600))" @endunless>
            <div class="text-6xl">{{ $passed ? '🎉' : '💪' }}</div>
            <p class="mt-3 text-sm font-medium uppercase tracking-widest text-white/70">Skor kamu</p>
            <p class="font-display text-6xl font-semibold text-white">{{ $score }}</p>
            <p class="mt-1 text-white/80">{{ $correct }} dari {{ $total }} jawaban benar</p>
        </div>
        <div class="p-6">
            @if ($passed)
                <p class="text-ink">✅ Materi <b>{{ $lesson->title }}</b> telah selesai!</p>
            @else
                <p class="text-ink">Skor minimal <b>70</b> untuk lulus. Pelajari ulang dan coba lagi!</p>
            @endif
            <div class="mt-5 flex flex-wrap justify-center gap-2.5">
                <a href="{{ route('member.kuis', $lesson->slug) }}" class="btn btn-outline">Ulangi Kuis</a>
                <a href="{{ route('dashboard.materi') }}" class="btn btn-primary">Kembali ke Materi</a>
                <a href="{{ route('dashboard.laporan') }}" class="btn btn-ghost">Lihat Progress</a>
            </div>
        </div>
    </div>

    {{-- Review --}}
    <h2 class="mt-10 text-lg font-semibold text-ink">Pembahasan</h2>
    <div class="mt-4 space-y-3">
        @foreach ($review as $i => $r)
            <div class="card border-l-4 p-5" style="border-left-color: {{ $r['is_correct'] ? 'var(--color-success)' : 'var(--color-danger)' }}">
                <p class="font-semibold text-ink">{{ $i + 1 }}. {{ $r['question'] }}</p>
                <p class="mt-1.5 text-sm">
                    Jawabanmu:
                    <b class="{{ $r['is_correct'] ? 'text-[color:var(--color-success)]' : 'text-[color:var(--color-danger)]' }}">
                        {{ $r['given'] ? strtoupper($r['given']) : '—' }}
                    </b>
                    @unless ($r['is_correct'])
                        <span class="text-muted">· Benar: <b class="text-[color:var(--color-success)]">{{ strtoupper($r['correct']) }}</b></span>
                    @endunless
                </p>
                @if (!empty($r['explanation']))
                    <p class="mt-1 text-sm text-muted"><i>{{ $r['explanation'] }}</i></p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

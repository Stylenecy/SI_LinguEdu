@extends('member.dashboard.main')
@section('title', 'Materi — LinguEdu')

@section('content')
<div class="container-page py-10">
    <div class="text-center">
        <span class="eyebrow">Kurikulum Bahasa Inggris</span>
        <h1 class="mt-3 font-display text-3xl font-semibold text-ink sm:text-4xl">Materi Pembelajaran</h1>
        <p class="mt-2 text-muted">Selesaikan semua materi di tiap level untuk membuka level berikutnya.</p>
    </div>

    {{-- Level chips --}}
    <div class="mt-8 flex flex-wrap justify-center gap-3">
        @foreach ([1 => 'Beginner', 2 => 'Intermediate', 3 => 'Advanced'] as $lvl => $name)
            <button class="chip btn-level {{ $lvl == 1 ? 'chip-active' : '' }}" data-level="{{ $lvl }}">
                Level {{ $lvl }} · {{ $name }} @unless ($unlocked[$lvl] ?? false) <span class="opacity-70">🔒</span> @endunless
            </button>
        @endforeach
    </div>

    @foreach ($byLevel as $level => $lessons)
        <section class="level-section mt-10" id="level{{ $level }}" @if($level != 1) hidden @endif>
            <div class="mb-5 flex items-center gap-3">
                <h2 class="font-display text-2xl font-semibold text-ink">Level {{ $level }} — {{ ['', 'Beginner', 'Intermediate', 'Advanced'][$level] ?? '' }}</h2>
                @unless ($unlocked[$level] ?? false)
                    <span class="badge badge-muted">🔒 Selesaikan level sebelumnya</span>
                @endunless
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($lessons as $m)
                    @php $done = in_array($m->id, $completedIds); $open = $unlocked[$level] ?? false; @endphp
                    <div class="card {{ $open ? 'card-hover' : 'opacity-60' }} overflow-hidden p-0">
                        <div class="relative h-40 overflow-hidden bg-brand-50">
                            <img src="{{ $m->image_url }}" alt="{{ $m->title }}" class="h-full w-full object-cover"
                                 onerror="this.style.display='none'">
                            <div class="absolute left-3 top-3 flex gap-2">
                                <span class="badge bg-white/90 text-brand-700">Materi {{ $loop->iteration }}</span>
                                @if ($done)<span class="badge badge-success bg-white/90">✓ Selesai</span>@endif
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <h3 class="text-lg font-semibold text-ink">{{ $m->title }}</h3>
                            <p class="mt-1 flex-1 text-sm text-muted">{{ $m->description }}</p>
                            <div class="mt-4 track"><div class="track-fill" style="width: {{ $done ? 100 : 0 }}%"></div></div>
                            @if ($open)
                                <a href="{{ route('member.video', $m->slug) }}" class="btn btn-primary mt-5 w-full">
                                    {{ $done ? 'Ulangi Materi' : 'Mulai Belajar' }} →
                                </a>
                            @else
                                <button class="btn btn-outline mt-5 w-full cursor-not-allowed opacity-60" disabled>🔒 Terkunci</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

<script>
    document.querySelectorAll('.btn-level').forEach(btn => {
        btn.addEventListener('click', () => {
            const lvl = btn.dataset.level;
            document.querySelectorAll('.level-section').forEach(s => s.hidden = true);
            const sec = document.getElementById('level' + lvl);
            if (sec) sec.hidden = false;
            document.querySelectorAll('.btn-level').forEach(b => b.classList.remove('chip-active'));
            btn.classList.add('chip-active');
        });
    });
</script>
@endsection

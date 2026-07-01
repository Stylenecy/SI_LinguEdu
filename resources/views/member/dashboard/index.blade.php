@extends('member.dashboard.main')
@section('title', 'Dashboard — LinguEdu')

@section('content')
<div class="container-page py-10">

    @if (session('status'))
        <div class="alert alert-success mb-6">{{ session('status') }}</div>
    @endif

    {{-- Hero / progress --}}
    <div class="mesh-brand relative overflow-hidden rounded-3xl p-8 shadow-[var(--shadow-lift)] sm:p-10">
        <div class="flex flex-col gap-8 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <span class="badge bg-white/15 text-white">Level {{ $currentLevel }} · {{ ['', 'Beginner', 'Intermediate', 'Advanced'][$currentLevel] ?? 'Advanced' }}</span>
                <h1 class="mt-4 font-display text-3xl font-semibold text-white sm:text-4xl">Halo, {{ $user->name }} 👋</h1>
                <p class="mt-2 max-w-md text-white/80">Teruskan momentummu. Selesaikan materi berikutnya untuk membuka level dan mengejar sertifikat.</p>
                <a href="{{ route('dashboard.materi') }}" class="btn btn-white mt-6">Lanjut Belajar →</a>
            </div>
            {{-- Progress ring --}}
            <div class="shrink-0 self-center">
                <div class="relative grid h-36 w-36 place-items-center rounded-full"
                     style="background:conic-gradient(white {{ $percent * 3.6 }}deg, rgba(255,255,255,.2) 0)">
                    <div class="grid h-28 w-28 place-items-center rounded-full" style="background:var(--color-brand-700)">
                        <span class="font-display text-3xl font-semibold text-white">{{ $percent }}%</span>
                    </div>
                </div>
                <p class="mt-3 text-center text-sm text-white/80">{{ $completed }}/{{ $totalLessons }} materi</p>
            </div>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="mt-8 grid gap-5 md:grid-cols-3">
        @foreach ([
            ['📘','Materi','Video, teori & kuis tiap level.','dashboard.materi','btn-primary'],
            ['📊','Progress','Lihat materi selesai & nilai kuis.','dashboard.laporan','btn-outline'],
            ['🎓','Sertifikat','Selesaikan semua level & raih sertifikat.','dashboard.sertifikasi','btn-outline'],
        ] as $c)
            <a href="{{ route($c[3]) }}" class="card card-hover block p-7">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-2xl">{{ $c[0] }}</span>
                <h3 class="mt-5 text-xl font-semibold text-ink">{{ $c[1] }}</h3>
                <p class="mt-1 text-sm text-muted">{{ $c[2] }}</p>
                <span class="btn {{ $c[4] }} btn-sm mt-5">Buka</span>
            </a>
        @endforeach
    </div>

    {{-- Level overview --}}
    <div class="mt-10">
        <h2 class="text-lg font-semibold text-ink">Peta Level</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-3">
            @foreach ([1 => 'Beginner', 2 => 'Intermediate', 3 => 'Advanced'] as $lvl => $name)
                @php $unlocked = $lvl == 1 || $user->hasCompletedLevel($lvl - 1); $done = $user->hasCompletedLevel($lvl); @endphp
                <div class="panel p-5 {{ $unlocked ? '' : 'opacity-60' }}">
                    <div class="flex items-center justify-between">
                        <span class="font-display text-2xl text-brand-200">0{{ $lvl }}</span>
                        @if ($done) <span class="badge badge-success">Selesai</span>
                        @elseif ($unlocked) <span class="badge badge-brand">Terbuka</span>
                        @else <span class="badge badge-muted">🔒 Terkunci</span> @endif
                    </div>
                    <h3 class="mt-2 font-semibold text-ink">{{ $name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

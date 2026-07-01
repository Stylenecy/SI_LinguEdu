@extends('member.dashboard.main')
@section('title', 'Progress — LinguEdu')

@section('content')
<div class="container-page py-10">
    <span class="eyebrow">Laporan</span>
    <h1 class="mt-3 font-display text-3xl font-semibold text-ink sm:text-4xl">Progres Belajar</h1>

    {{-- Stat cards --}}
    <div class="mt-8 grid gap-5 sm:grid-cols-3">
        <div class="card p-6">
            <p class="text-sm text-muted">Level saat ini</p>
            <p class="mt-2 font-display text-2xl font-semibold text-ink">Level {{ $currentLevel }}</p>
            <p class="text-sm text-brand">{{ ['', 'Beginner', 'Intermediate', 'Advanced'][$currentLevel] ?? 'Advanced' }}</p>
        </div>
        <div class="card p-6">
            <p class="text-sm text-muted">Materi diselesaikan</p>
            <p class="mt-2 font-display text-2xl font-semibold text-ink">{{ $completed }} / {{ $totalLessons }}</p>
            <div class="mt-3 track"><div class="track-fill" style="width: {{ $percent }}%"></div></div>
        </div>
        <div class="card p-6">
            <p class="text-sm text-muted">Rata-rata nilai kuis</p>
            <p class="mt-2 font-display text-2xl font-semibold text-brand">{{ $avgScore }}<span class="text-base text-muted"> / 100</span></p>
            <p class="text-sm text-muted">dari materi yang selesai</p>
        </div>
    </div>

    {{-- Activity table --}}
    <div class="card mt-8 overflow-hidden p-0">
        <div class="border-b border-line px-6 py-4">
            <h2 class="font-semibold text-ink">Detail Aktivitas</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-line text-left text-muted">
                        <th class="px-6 py-3 font-medium">Materi</th>
                        <th class="px-6 py-3 font-medium">Level</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Nilai</th>
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($completedLessons as $l)
                        <tr class="border-b border-line last:border-0">
                            <td class="px-6 py-4 font-medium text-ink">{{ $l->title }}</td>
                            <td class="px-6 py-4 text-muted">{{ $l->levelName() }}</td>
                            <td class="px-6 py-4"><span class="badge badge-success">Selesai</span></td>
                            <td class="px-6 py-4 text-ink">{{ $l->pivot->score ?? '-' }}</td>
                            <td class="px-6 py-4 text-muted">{{ $l->pivot->completed_at ? \Carbon\Carbon::parse($l->pivot->completed_at)->translatedFormat('d M Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-muted">
                                Belum ada materi selesai. Mulai dari <a href="{{ route('dashboard.materi') }}" class="font-semibold text-brand hover:underline">halaman Materi</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

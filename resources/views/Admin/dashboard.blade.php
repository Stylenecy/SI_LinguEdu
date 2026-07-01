@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

    {{-- Flash & Validation --}}
    @if (session('status'))
        <div class="alert alert-success mb-5">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mb-5">
            <ul class="list-disc ps-5">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    {{-- Intro --}}
    <div class="mb-8 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="eyebrow">Panel Admin</p>
            <h2 class="mt-1 font-display text-3xl font-semibold text-ink">Selamat datang kembali</h2>
            <p class="mt-1 text-sm text-muted">Ringkasan aktivitas platform LinguEdu.</p>
        </div>
        <div class="text-sm font-medium text-muted" id="clock"></div>
    </div>

    {{-- Statistik Ringkas --}}
    @php
        $statCards = [
            ['label' => 'Total Pengguna', 'value' => $stats['users'] ?? 0,        'accent' => 'brand'],
            ['label' => 'Materi',         'value' => $stats['lessons'] ?? 0,       'accent' => 'accent'],
            ['label' => 'Soal Kuis',      'value' => $stats['questions'] ?? 0,     'accent' => 'brand'],
            ['label' => 'Sertifikat',     'value' => $stats['certificates'] ?? 0,  'accent' => 'success'],
            ['label' => 'Paket',          'value' => $stats['packages'] ?? 0,      'accent' => 'accent'],
        ];
    @endphp
    <div class="mb-8 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5">
        @foreach ($statCards as $c)
            <div class="card card-hover p-5">
                <div class="mb-3 flex items-center justify-between">
                    <span class="badge badge-{{ $c['accent'] }}">{{ $c['label'] }}</span>
                    <span class="grid h-9 w-9 place-items-center rounded-xl bg-brand-50 text-brand-600">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M3 3v18h18M7 14l3-3 3 3 5-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                </div>
                <p class="font-display text-4xl font-semibold text-ink">{{ $c['value'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Recent Users & Materi per Level --}}
    <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- User Terbaru --}}
        <div class="card p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="font-display text-lg font-semibold text-ink">Pengguna Terbaru</h3>
                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-brand hover:underline">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-muted">
                            <th class="py-2 font-medium">Nama</th>
                            <th class="py-2 font-medium">Email</th>
                            <th class="py-2 font-medium">Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentUsers as $user)
                            <tr class="border-b border-line">
                                <td class="py-3 font-medium text-ink">{{ $user->name }}</td>
                                <td class="py-3 text-muted">{{ $user->email }}</td>
                                <td class="py-3 text-muted">{{ $user->created_at?->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-6 text-center text-muted">Belum ada pengguna.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Materi per Level --}}
        @php
            $levelLabels = [1 => 'Beginner', 2 => 'Intermediate', 3 => 'Advanced'];
            $levelMax = max(1, ($lessonsByLevel[1] ?? 0), ($lessonsByLevel[2] ?? 0), ($lessonsByLevel[3] ?? 0));
        @endphp
        <div class="card p-6">
            <h3 class="mb-4 font-display text-lg font-semibold text-ink">Materi per Level</h3>
            <div class="space-y-5">
                @foreach ($levelLabels as $lvl => $label)
                    @php $count = $lessonsByLevel[$lvl] ?? 0; @endphp
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <span class="text-sm font-medium text-ink">{{ $label }}</span>
                            <span class="badge badge-brand">{{ $count }} materi</span>
                        </div>
                        <div class="track">
                            <div class="track-fill" style="width: {{ round($count / $levelMax * 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- MENU PENGATURAN --}}
    <div class="card p-6">
        <h3 class="mb-5 font-display text-lg font-semibold text-ink">Menu Pengaturan</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

            <a href="{{ route('admin.users') }}" class="panel card-hover flex items-start gap-3 p-4">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M16 19v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm13 10v-2a4 4 0 0 0-3-3.87" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <div>
                    <h4 class="font-semibold text-ink">Manajemen Pengguna</h4>
                    <p class="mt-0.5 text-sm text-muted">Kelola data member &amp; admin.</p>
                </div>
            </a>

            <a href="{{ route('admin.paket') }}" class="panel card-hover flex items-start gap-3 p-4">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <div>
                    <h4 class="font-semibold text-ink">Setting Paket</h4>
                    <p class="mt-0.5 text-sm text-muted">Atur paket langganan &amp; harga.</p>
                </div>
            </a>

            <a href="{{ route('admin.materi') }}" class="panel card-hover flex items-start gap-3 p-4">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <div>
                    <h4 class="font-semibold text-ink">Setting Materi</h4>
                    <p class="mt-0.5 text-sm text-muted">Kelola materi pembelajaran.</p>
                </div>
            </a>

            <a href="{{ route('admin.kuis') }}" class="panel card-hover flex items-start gap-3 p-4">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M9.09 9a3 3 0 1 1 5.83 1c0 2-3 3-3 3M12 17h.01M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <div>
                    <h4 class="font-semibold text-ink">Setting Kuis</h4>
                    <p class="mt-0.5 text-sm text-muted">Atur soal kuis &amp; evaluasi.</p>
                </div>
            </a>

            <a href="{{ route('admin.sertifikasi') }}" class="panel card-hover flex items-start gap-3 p-4">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5"><path d="M15 15a6 6 0 1 0-6 0m6 0-3 7-3-7m6 0a6 6 0 0 1-6 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <div>
                    <h4 class="font-semibold text-ink">Setting Sertifikasi</h4>
                    <p class="mt-0.5 text-sm text-muted">Konfigurasi sertifikat &amp; tes.</p>
                </div>
            </a>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    function updateClock() {
        const el = document.getElementById('clock');
        if (el) el.textContent = new Date().toLocaleTimeString('id-ID');
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endpush

@extends('layouts.admin')

@section('title', 'Manajemen Kuis & Evaluasi')
@section('page_title', 'Kuis')

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
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="eyebrow">Manajemen</p>
            <h2 class="mt-1 font-display text-3xl font-semibold text-ink">Kuis &amp; Evaluasi</h2>
            <p class="mt-1 text-sm text-muted">Kelola soal kuis sesuai materi yang tersedia.</p>
        </div>
        <button type="button" onclick="document.getElementById('addKuis').classList.toggle('hidden')" class="btn btn-primary">
            + Tambah Soal
        </button>
    </div>

    {{-- Form Tambah Soal --}}
    <div id="addKuis" class="card mb-6 p-6 {{ $errors->any() ? '' : 'hidden' }}">
        <h3 class="mb-5 font-display text-lg font-semibold text-ink">Tambah Soal</h3>
        <form method="POST" action="{{ route('admin.kuis.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="field-label">Materi</label>
                    <select name="lesson_id" class="field" required>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="field-label">Pertanyaan</label>
                    <textarea name="question" class="field" rows="3" required>{{ old('question') }}</textarea>
                </div>
                <div>
                    <label class="field-label">Pilihan A</label>
                    <input type="text" name="option_a" value="{{ old('option_a') }}" class="field" required>
                </div>
                <div>
                    <label class="field-label">Pilihan B</label>
                    <input type="text" name="option_b" value="{{ old('option_b') }}" class="field" required>
                </div>
                <div>
                    <label class="field-label">Pilihan C</label>
                    <input type="text" name="option_c" value="{{ old('option_c') }}" class="field" required>
                </div>
                <div>
                    <label class="field-label">Pilihan D</label>
                    <input type="text" name="option_d" value="{{ old('option_d') }}" class="field" required>
                </div>
                <div>
                    <label class="field-label">Jawaban Benar</label>
                    <select name="correct_option" class="field" required>
                        <option value="a">Pilihan A</option>
                        <option value="b">Pilihan B</option>
                        <option value="c">Pilihan C</option>
                        <option value="d">Pilihan D</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="field-label">Penjelasan (opsional)</label>
                    <textarea name="explanation" class="field" rows="2">{{ old('explanation') }}</textarea>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" onclick="document.getElementById('addKuis').classList.add('hidden')" class="btn btn-ghost">Batal</button>
            </div>
        </form>
    </div>

    {{-- Daftar Soal per Materi --}}
    <div class="space-y-5">
        @forelse ($lessons as $lesson)
            <div class="card p-6">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h3 class="font-display text-lg font-semibold text-ink">{{ $lesson->title }}</h3>
                    <span class="badge badge-muted">{{ $lesson->questions->count() }} soal</span>
                </div>

                @if ($lesson->questions->isEmpty())
                    <p class="text-sm text-muted">Belum ada soal untuk materi ini.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($lesson->questions as $q)
                            <div class="panel p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <p class="font-medium text-ink">{{ $q->question }}</p>
                                    <form method="POST" action="{{ route('admin.kuis.destroy', $q) }}"
                                          onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm" style="color: var(--color-danger)">Hapus</button>
                                    </form>
                                </div>
                                @php $correct = strtolower($q->correct_option); @endphp
                                <div class="mt-3 grid grid-cols-1 gap-2 sm:grid-cols-2">
                                    @foreach (['a' => $q->option_a, 'b' => $q->option_b, 'c' => $q->option_c, 'd' => $q->option_d] as $key => $opt)
                                        <div class="flex items-center gap-2 rounded-xl border border-line px-3 py-2 text-sm {{ $correct === $key ? 'bg-success-50' : '' }}">
                                            <span class="badge {{ $correct === $key ? 'badge-success' : 'badge-muted' }}">{{ strtoupper($key) }}</span>
                                            <span class="{{ $correct === $key ? 'font-medium text-ink' : 'text-muted' }}">{{ $opt }}</span>
                                            @if ($correct === $key)
                                                <svg viewBox="0 0 24 24" fill="none" class="ml-auto h-4 w-4" style="color: var(--color-success)"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="card p-8 text-center">
                <p class="text-muted">Belum ada materi. Tambahkan materi terlebih dahulu.</p>
            </div>
        @endforelse
    </div>
@endsection

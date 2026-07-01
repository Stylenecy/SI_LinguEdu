@extends('layouts.admin')

@section('title', 'Manajemen Materi')
@section('page_title', 'Materi')

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

    @php
        $levelLabels = [1 => 'Beginner', 2 => 'Intermediate', 3 => 'Advanced'];
    @endphp

    {{-- Intro --}}
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="eyebrow">Manajemen</p>
            <h2 class="mt-1 font-display text-3xl font-semibold text-ink">Materi</h2>
            <p class="mt-1 text-sm text-muted">Kelola materi pembelajaran per level.</p>
        </div>
        <button type="button" onclick="document.getElementById('addMateri').classList.toggle('hidden')" class="btn btn-primary">
            + Tambah Materi
        </button>
    </div>

    {{-- Form Tambah --}}
    <div id="addMateri" class="card mb-6 p-6 {{ $errors->any() ? '' : 'hidden' }}">
        <h3 class="mb-5 font-display text-lg font-semibold text-ink">Tambah Materi</h3>
        <form method="POST" action="{{ route('admin.materi.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="field-label">Level</label>
                    <select name="level" class="field" required>
                        @foreach ($levelLabels as $lvl => $label)
                            <option value="{{ $lvl }}">{{ $lvl }} - {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label">Judul Materi</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="field" required>
                </div>
                <div class="md:col-span-2">
                    <label class="field-label">Deskripsi</label>
                    <textarea name="description" class="field" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="field-label">Teori / Materi</label>
                    <textarea name="theory" class="field" rows="4">{{ old('theory') }}</textarea>
                </div>
                <div>
                    <label class="field-label">URL Video</label>
                    <input type="text" name="video_url" value="{{ old('video_url') }}" class="field" placeholder="https://...">
                </div>
                <div>
                    <label class="field-label">URL Gambar</label>
                    <input type="text" name="image_url" value="{{ old('image_url') }}" class="field" placeholder="https://...">
                </div>
                <div>
                    <label class="field-label">Urutan (opsional)</label>
                    <input type="number" name="order" value="{{ old('order') }}" class="field">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" onclick="document.getElementById('addMateri').classList.add('hidden')" class="btn btn-ghost">Batal</button>
            </div>
        </form>
    </div>

    {{-- Tabel Materi --}}
    <div class="card p-6">
        <h3 class="mb-4 font-display text-lg font-semibold text-ink">Daftar Materi</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-line text-left text-muted">
                        <th class="py-3 font-medium">Level</th>
                        <th class="py-3 font-medium">Judul</th>
                        <th class="py-3 font-medium">Deskripsi</th>
                        <th class="py-3 text-center font-medium">Jml Soal</th>
                        <th class="py-3 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lessons->sortBy('level') as $lesson)
                        <tr class="border-b border-line align-top">
                            <td class="py-3">
                                <span class="badge badge-brand">{{ $levelLabels[$lesson->level] ?? $lesson->level }}</span>
                            </td>
                            <td class="py-3">
                                <div class="font-semibold text-ink">{{ $lesson->title }}</div>
                                <div class="text-xs text-muted">{{ $lesson->slug }}</div>
                            </td>
                            <td class="py-3 text-muted">{{ $lesson->description }}</td>
                            <td class="py-3 text-center">
                                <span class="badge badge-muted">{{ $lesson->questions_count }}</span>
                            </td>
                            <td class="py-3 text-center">
                                <form method="POST" action="{{ route('admin.materi.destroy', $lesson) }}"
                                      onsubmit="return confirm('Hapus materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm" style="color: var(--color-danger)">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-muted">Belum ada materi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

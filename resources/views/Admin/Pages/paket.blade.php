@extends('layouts.admin')

@section('title', 'Manajemen Paket')
@section('page_title', 'Paket')

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
            <h2 class="mt-1 font-display text-3xl font-semibold text-ink">Paket Belajar</h2>
            <p class="mt-1 text-sm text-muted">Atur paket langganan, harga, dan durasi.</p>
        </div>
        <button type="button" onclick="openAddModal()" class="btn btn-primary">+ Tambah Paket</button>
    </div>

    {{-- Tabel Paket --}}
    <div class="card p-6">
        <h3 class="mb-4 font-display text-lg font-semibold text-ink">Daftar Paket</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-line text-left text-muted">
                        <th class="py-3 font-medium">Nama Paket</th>
                        <th class="py-3 font-medium">Deskripsi</th>
                        <th class="py-3 text-center font-medium">Harga</th>
                        <th class="py-3 text-center font-medium">Bahasa</th>
                        <th class="py-3 text-center font-medium">Durasi</th>
                        <th class="py-3 text-center font-medium">Status</th>
                        <th class="py-3 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $p)
                        <tr class="border-b border-line align-top">
                            <td class="py-3 font-semibold text-ink">{{ $p->name }}</td>
                            <td class="py-3 text-muted">{{ $p->description }}</td>
                            <td class="py-3 text-center font-semibold text-ink">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                            <td class="py-3 text-center">
                                <span class="badge badge-brand">{{ $p->language }}</span>
                            </td>
                            <td class="py-3 text-center text-muted">{{ $p->duration_days }} hari</td>
                            <td class="py-3 text-center">
                                @if ($p->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-muted">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3 text-center">
                                <form method="POST" action="{{ route('admin.paket.destroy', $p) }}"
                                      onsubmit="return confirm('Hapus paket {{ $p->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm" style="color: var(--color-danger)">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-muted">Belum ada paket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-ink-900/40 p-4 backdrop-blur-sm">
        <form method="POST" action="{{ route('admin.paket.store') }}" class="card w-full max-w-lg p-6">
            @csrf
            <h3 class="mb-5 font-display text-xl font-semibold text-ink">Tambah Paket</h3>

            <div class="space-y-4">
                <div>
                    <label class="field-label">Nama Paket</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="field" required>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="description" class="field" rows="3">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="field-label">Harga (Rp)</label>
                    <input name="price" value="{{ old('price') }}" type="number" class="field" required>
                </div>
                <div>
                    <label class="field-label">Bahasa</label>
                    <input name="language" value="{{ old('language') }}" type="text" class="field" placeholder="Inggris / Jepang / Korea" required>
                </div>
                <div>
                    <label class="field-label">Durasi (hari)</label>
                    <input name="duration_days" value="{{ old('duration_days') }}" type="number" class="field" required>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="btn btn-ghost">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    function openAddModal() {
        const m = document.getElementById('addModal');
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function closeAddModal() {
        const m = document.getElementById('addModal');
        m.classList.add('hidden');
        m.classList.remove('flex');
    }

    // Re-open modal automatically if validation failed
    @if ($errors->any())
        openAddModal();
    @endif
</script>
@endpush

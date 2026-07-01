@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page_title', 'Pengguna')

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
            <h2 class="mt-1 font-display text-3xl font-semibold text-ink">Pengguna</h2>
            <p class="mt-1 text-sm text-muted">Kelola member dan admin platform.</p>
        </div>
        <div class="text-sm font-medium text-muted" id="clock"></div>
    </div>

    {{-- Tab navigasi --}}
    <div class="mb-6 flex flex-wrap gap-2">
        <button type="button" onclick="showPage('list')" id="tab-list" class="chip chip-active">Daftar Pengguna</button>
        <button type="button" onclick="showPage('create')" id="tab-create" class="chip">Tambah Pengguna</button>
    </div>

    {{-- ========== LIST ========== --}}
    <div id="page-list" class="page-section">
        <div class="card p-6">
            <h3 class="mb-4 font-display text-lg font-semibold text-ink">Daftar Pengguna</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-line text-left text-muted">
                            <th class="py-3 font-medium">Nama</th>
                            <th class="py-3 font-medium">Email</th>
                            <th class="py-3 font-medium">Role</th>
                            <th class="py-3 text-center font-medium">Selesai</th>
                            <th class="py-3 font-medium">Bergabung</th>
                            <th class="py-3 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $u)
                            <tr class="border-b border-line">
                                <td class="py-3 font-medium text-ink">{{ $u->name }}</td>
                                <td class="py-3 text-muted">{{ $u->email }}</td>
                                <td class="py-3">
                                    <span class="badge {{ $u->role === 'admin' ? 'badge-brand' : 'badge-muted' }}">{{ ucfirst($u->role) }}</span>
                                </td>
                                <td class="py-3 text-center text-ink">{{ $u->completed_count }}</td>
                                <td class="py-3 text-muted">{{ $u->created_at?->format('d M Y') }}</td>
                                <td class="py-3 text-center">
                                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                                          onsubmit="return confirm('Hapus user {{ $u->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm" style="color: var(--color-danger)">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-muted">Belum ada pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ========== CREATE ========== --}}
    <div id="page-create" class="page-section hidden">
        <div class="card p-6">
            <h3 class="mb-5 font-display text-lg font-semibold text-ink">Tambah Pengguna Baru</h3>

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="field-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="field" placeholder="Masukkan nama user">
                    </div>
                    <div>
                        <label class="field-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="field" placeholder="email@contoh.com">
                    </div>
                    <div>
                        <label class="field-label">Password</label>
                        <input type="password" name="password" required class="field" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="field-label">Role</label>
                        <select name="role" class="field">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-6">Simpan Pengguna</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function showPage(page) {
        document.querySelectorAll('.page-section').forEach(e => e.classList.add('hidden'));
        document.getElementById('page-' + page).classList.remove('hidden');
        ['list', 'create'].forEach(p => document.getElementById('tab-' + p).classList.remove('chip-active'));
        document.getElementById('tab-' + page).classList.add('chip-active');
    }

    function updateClock() {
        const el = document.getElementById('clock');
        if (el) el.textContent = new Date().toLocaleTimeString('id-ID');
    }
    setInterval(updateClock, 1000);
    updateClock();

    @if ($errors->any())
        showPage('create');
    @endif
</script>
@endpush

@extends('layouts.main')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
            + Tambah User
        </button>
    </div>

    {{-- Search + Filter --}}
    <div class="bg-white p-4 shadow rounded-xl mb-4 flex flex-col md:flex-row justify-between gap-3">

        <input type="text" placeholder="Cari pengguna..."
            class="px-4 py-2 border rounded-lg w-full md:w-1/2 focus:ring-2 focus:ring-blue-500 outline-none">

        <select class="px-4 py-2 border rounded-lg">
            <option value="">Filter: Semua</option>
            <option value="">Belum Terverifikasi</option>
            <option value="">Sudah Terverifikasi</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                {{-- Dummy User List --}}
                @foreach([
                    ['nama' => 'Andi Wijaya', 'email' => 'andi@example.com', 'status' => 'Pending'],
                    ['nama' => 'Rina Sakura', 'email' => 'rina@example.com', 'status' => 'Aktif'],
                    ['nama' => 'Dewi Putri', 'email' => 'dewi@example.com', 'status' => 'Aktif'],
                ] as $user)

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $user['nama'] }}</td>
                    <td class="px-4 py-3">{{ $user['email'] }}</td>
                    <td class="px-4 py-3">
                        @if($user['status'] == 'Pending')
                            <span class="text-yellow-600 font-semibold">⏳ Pending</span>
                        @else
                            <span class="text-green-600 font-semibold">✔ Aktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 flex items-center gap-3 justify-center">
                        <button class="text-blue-600 hover:underline text-sm">Edit</button>
                        <button class="text-red-600 hover:underline text-sm">Hapus</button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

@endsection

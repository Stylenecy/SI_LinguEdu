{{-- paket.blade.php (All-in-One Paket Management UI) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navigation to Dashboard -->
    <div class="w-full bg-white shadow border-b py-4 px-6 mb-6 flex justify-between items-center">
        <h1 class="text-xl font-bold">Manajemen Paket – LinguEdu</h1>
        <a href="/dashboard" class="bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded">← Kembali ke Dashboard</a>
    </div>

    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6">

        <!-- NAV TABS -->
        <div class="flex gap-3 mb-6">
            <button onclick="showTab('list')" id="btn-list" class="tab-btn bg-blue-600 text-white px-4 py-2 rounded">Daftar Paket</button>
            <button onclick="showTab('create')" id="btn-create" class="tab-btn bg-gray-300 px-4 py-2 rounded">Tambah Paket</button>
        </div>

        <!-- LIST PACKAGE -->
        <div id="tab-list" class="tab-page">
            <h2 class="text-lg font-semibold mb-4">Daftar Paket</h2>
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 border">Nama Paket</th>
                        <th class="py-2 border">Durasi</th>
                        <th class="py-2 border">Harga</th>
                        <th class="py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody id="package-table">
                    <tr>
                        <td class="border p-2">Basic</td>
                        <td class="border p-2">1 Bulan</td>
                        <td class="border p-2">Rp 99.000</td>
                        <td class="border p-2 text-center">
                            <button onclick="openEdit('Basic','1 Bulan','Rp 99.000')" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                            <button onclick="openDelete('Basic')" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="border p-2">Intermediate</td>
                        <td class="border p-2">3 Bulan</td>
                        <td class="border p-2">Rp 249.000</td>
                        <td class="border p-2 text-center">
                            <button onclick="openEdit('Intermediate','3 Bulan','Rp 249.000')" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                            <button onclick="openDelete('Intermediate')" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="border p-2">Advanced + Sertifikasi</td>
                        <td class="border p-2">6 Bulan</td>
                        <td class="border p-2">Rp 499.000</td>
                        <td class="border p-2 text-center">
                            <button onclick="openEdit('Advanced + Sertifikasi','6 Bulan','Rp 499.000')" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                            <button onclick="openDelete('Advanced + Sertifikasi')" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- CREATE PACKAGE -->
        <div id="tab-create" class="tab-page hidden">
            <h2 class="text-lg font-semibold mb-4">Tambah Paket</h2>
            <form class="space-y-4">
                <div>
                    <label class="font-semibold">Nama Paket</label>
                    <input type="text" class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="font-semibold">Durasi</label>
                    <input type="text" class="w-full border p-2 rounded" placeholder="Contoh: 1 Bulan">
                </div>
                <div>
                    <label class="font-semibold">Harga</label>
                    <input type="text" class="w-full border p-2 rounded" placeholder="Contoh: Rp 100.000">
                </div>
                <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>

        <!-- EDIT MODAL -->
        <div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-40 hidden flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-lg font-bold mb-4">Edit Paket</h2>
                <form class="space-y-3">
                    <div>
                        <label class="font-semibold">Nama Paket</label>
                        <input id="edit-name" type="text" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="font-semibold">Durasi</label>
                        <input id="edit-duration" type="text" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="font-semibold">Harga</label>
                        <input id="edit-price" type="text" class="w-full border p-2 rounded">
                    </div>
                </form>
                <div class="flex justify-end mt-4 gap-2">
                    <button onclick="closeEdit()" class="px-3 py-1 bg-gray-400 rounded">Batal</button>
                    <button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
                </div>
            </div>
        </div>

        <!-- DELETE MODAL -->
        <div id="modal-delete" class="fixed inset-0 bg-black bg-opacity-40 hidden flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-80 text-center">
                <h2 class="text-lg font-bold mb-4">Hapus Paket</h2>
                <p id="delete-text">Apakah Anda yakin?</p>
                <div class="flex justify-center mt-4 gap-2">
                    <button onclick="closeDelete()" class="px-3 py-1 bg-gray-400 rounded">Batal</button>
                    <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        function showTab(tab) {
            document.querySelectorAll('.tab-page').forEach(e => e.classList.add('hidden'));
            document.getElementById('tab-' + tab).classList.remove('hidden');
            document.querySelectorAll('.tab-btn').forEach(e => e.classList.remove('bg-blue-600','text-white'));
            document.getElementById('btn-' + tab).classList.add('bg-blue-600','text-white');
        }

        function openEdit(name, duration, price) {
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-duration').value = duration;
            document.getElementById('edit-price').value = price;
            document.getElementById('modal-edit').classList.remove('hidden');
        }
        function closeEdit() {
            document.getElementById('modal-edit').classList.add('hidden');
        }

        function openDelete(name) {
            document.getElementById('delete-text').innerText = `Hapus paket "${name}"?`;
            document.getElementById('modal-delete').classList.remove('hidden');
        }
        function closeDelete() {
            document.getElementById('modal-delete').classList.add('hidden');
        }
    </script>

</body>
</html>
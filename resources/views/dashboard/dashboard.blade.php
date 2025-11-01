@extends('layouts.main')
@section('title', 'Dashboard - LinguEdu')

@section('content')
<div id="app" class="flex flex-col md:flex-row min-h-screen bg-gray-50">

    <!-- Sidebar Navigasi -->
    <aside class="bg-primary text-white w-full md:w-64 min-h-screen p-6 flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-8">LinguEdu</h1>
            <nav class="space-y-3">
                <a href="{{ route('dashboard.simulasi') }}" class="block py-2 px-3 rounded-lg hover:bg-primary-dark transition">🏠 Dashboard</a>
                <a href="{{ route('materi.simulasi') }}" class="block py-2 px-3 rounded-lg hover:bg-primary-dark transition">📚 Materi</a>
                <a href="{{ route('kuis.simulasi') }}" class="block py-2 px-3 rounded-lg hover:bg-primary-dark transition">🧩 Kuis</a>
                <a href="{{ route('report.simulasi') }}" class="block py-2 px-3 rounded-lg hover:bg-primary-dark transition">📈 Progress</a>
                <a href="{{ route('sertifikasi.simulasi') }}" class="block py-2 px-3 rounded-lg hover:bg-primary-dark transition">🎓 Sertifikasi</a>
            </nav>
        </div>
        <div>
            <a href="{{ route('login.simulasi') }}" class="block mt-6 py-2 px-4 text-center bg-white text-primary font-semibold rounded-lg hover:bg-primary-light hover:text-primary-dark transition">Keluar</a>
        </div>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang di Dashboard LinguEdu</h2>
        <p class="text-gray-600 mb-8">Mulailah perjalanan belajar bahasa asingmu. Pilih menu di samping untuk mengakses materi, kuis, dan laporan kemajuanmu.</p>

        <!-- Contoh Ringkasan Progress -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Level Saat Ini</h3>
                <p class="text-4xl font-bold text-primary">2</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Skor Rata-rata</h3>
                <p id="avgScore" class="text-4xl font-bold text-green-500">85</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Status Akun</h3>
                <p class="text-4xl font-bold text-emerald-600">Aktif</p>
            </div>
        </div>

        <!-- Grafik Progress -->
        <div class="bg-white rounded-2xl shadow p-6 mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Laporan Kemajuan</h3>
            <canvas id="progressChart" height="100"></canvas>
        </div>

        <!-- Simulasi Kuis -->
        <div class="bg-white rounded-2xl shadow p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Simulasi Kuis</h3>
            <p class="text-gray-600 mb-4">Jawab pertanyaan berikut dan lihat skor Anda otomatis.</p>

            <form id="quizForm" class="space-y-4">
                <div>
                    <label class="font-medium text-gray-700">1. Apa arti kata "Hello" dalam Bahasa Indonesia?</label><br>
                    <input type="radio" name="q1" value="benar"> Halo<br>
                    <input type="radio" name="q1" value="salah"> Selamat tinggal<br>
                </div>
                <div>
                    <label class="font-medium text-gray-700">2. Bagaimana mengucapkan "Terima Kasih" dalam Bahasa Inggris?</label><br>
                    <input type="radio" name="q2" value="salah"> Please<br>
                    <input type="radio" name="q2" value="benar"> Thank You<br>
                </div>
                <div>
                    <label class="font-medium text-gray-700">3. "Gracias" berasal dari bahasa...</label><br>
                    <input type="radio" name="q3" value="salah"> Mandarin<br>
                    <input type="radio" name="q3" value="benar"> Spanyol<br>
                </div>

                <button type="submit" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition">Kirim Jawaban</button>
            </form>

            <div id="scoreResult" class="mt-6 hidden">
                <h4 class="text-xl font-semibold text-gray-800">Hasil Skor Anda:</h4>
                <p id="scoreValue" class="text-3xl font-bold text-primary mt-2"></p>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Grafik Progress Dummy
const ctx = document.getElementById('progressChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Level 1', 'Level 2', 'Level 3', 'Level 4'],
        datasets: [{
            label: 'Skor Rata-rata',
            data: [70, 80, 85, 90],
            borderColor: '#5E60CE',
            backgroundColor: '#E9E9FF',
            tension: 0.3,
            fill: true
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true, max: 100 } } }
});

// Simulasi Kuis Otomatis
document.getElementById('quizForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let benar = 0;
    const total = 3;
    const jawaban = document.querySelectorAll('input[type=radio]:checked');
    jawaban.forEach(j => { if (j.value === 'benar') benar++; });

    const score = Math.round((benar / total) * 100);
    document.getElementById('scoreValue').innerText = score + ' / 100';
    document.getElementById('scoreResult').classList.remove('hidden');
    document.getElementById('avgScore').innerText = score;
});
</script>
@endpush

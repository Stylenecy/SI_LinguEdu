@extends('main')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard LinguEdu</h1>
        <div class="text-sm text-gray-600 font-semibold" id="clock"></div>
    </div>

    {{-- Notifikasi Verifikasi Akun --}}
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 shadow-sm rounded-lg animate-pulse">
        ⚠️ <strong>{{ $pendingVerifications ?? 12 }}</strong> akun menunggu verifikasi! 
        <a href="#" class="underline text-yellow-700 hover:text-yellow-900">Lihat sekarang</a>
    </div>

    {{-- Statistik Member & Penghasilan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        {{-- Statistik Member --}}
        <div class="bg-white shadow rounded-xl p-5 relative">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Statistik Member</h2>
            <div class="flex flex-col lg:flex-row justify-between items-center">
                <div>
                    <p class="text-gray-600">Total Member:</p>
                    <p class="text-2xl font-bold text-blue-600">1,245</p>
                    <p class="text-gray-500 text-sm">+23 minggu ini</p>
                </div>
                <div class="w-full lg:w-1/2">
                    <canvas id="memberChart" class="max-h-48"></canvas>
                </div>
            </div>
        </div>

        {{-- Grafik Penghasilan --}}
        <div class="bg-white shadow rounded-xl p-5">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Grafik Penghasilan</h2>
            <canvas id="incomeChart" class="max-h-48"></canvas>
        </div>
    </div>

    {{-- Ulasan Member --}}
    <div class="bg-white shadow rounded-xl p-5 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Ulasan Member</h2>
            <button id="loadMoreBtn" class="text-blue-600 hover:underline text-sm">Lihat lebih banyak</button>
        </div>
        <div id="reviewsContainer" class="space-y-3">
            <div class="p-3 border rounded-md bg-gray-50">
                <p class="text-gray-700 text-sm">"Aplikasi LinguEdu sangat membantu saya memahami bahasa Jepang!"</p>
                <span class="text-xs text-gray-500">— Rina (5 menit lalu)</span>
            </div>
            <div class="p-3 border rounded-md bg-gray-50">
                <p class="text-gray-700 text-sm">"UI-nya bersih dan mudah digunakan!"</p>
                <span class="text-xs text-gray-500">— Andi (10 menit lalu)</span>
            </div>
        </div>
    </div>

</div>

{{-- Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Jam realtime
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Grafik Member
    const ctx1 = document.getElementById('memberChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Jepang', 'Korea', 'Inggris'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#3b82f6', '#10b981', '#facc15']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Grafik Penghasilan
    const ctx2 = document.getElementById('incomeChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Penghasilan (juta)',
                data: [5, 6, 7.5, 6.8, 9, 10],
                borderColor: '#16a34a',
                fill: false,
                tension: 0.4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Ulasan realtime
    setInterval(() => {
        const now = new Date().toLocaleTimeString();
        document.querySelector("#reviewsContainer").innerHTML += `
            <div class='p-3 border rounded-md bg-gray-50'>
                <p class='text-gray-700 text-sm'>"Fitur baru LinguEdu keren banget!"</p>
                <span class='text-xs text-gray-500'>— User baru (${now})</span>
            </div>
        `;
    }, 10000);

    // Tombol "Lihat lebih banyak"
    document.getElementById('loadMoreBtn').addEventListener('click', () => {
        const newReview = `
            <div class="p-3 border rounded-md bg-gray-50">
                <p class="text-gray-700 text-sm">"Saya suka fitur kuis bahasanya!"</p>
                <span class="text-xs text-gray-500">— Mira (${new Date().toLocaleTimeString()})</span>
            </div>`;
        document.querySelector("#reviewsContainer").innerHTML += newReview;
    });
</script>
@endsection

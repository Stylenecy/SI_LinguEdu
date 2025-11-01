@extends('layouts.main')
@section('title', 'Registrasi - LinguEdu')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-50 py-10 px-4">
  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl transition-all duration-500">
    <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">Gabung ke LinguEdu</h1>
    <p class="text-center text-gray-600 mb-6">Isi langkah berikut untuk membuat akunmu</p>

    <!-- Step Indicator -->
    <div class="flex justify-center mb-8">
      <div class="flex items-center space-x-4">
        <div id="step1Circle" class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 text-white font-semibold">1</div>
        <div class="w-10 h-1 bg-gray-300"></div>
        <div id="step2Circle" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-300 text-gray-600 font-semibold">2</div>
        <div class="w-10 h-1 bg-gray-300"></div>
        <div id="step3Circle" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-300 text-gray-600 font-semibold">3</div>
      </div>
    </div>

    <!-- Step 1 -->
    <div id="step1" class="step active">
      <h2 class="text-xl font-semibold mb-4 text-gray-800 text-center">Langkah 1: Pilih Bahasa yang Ingin Dipelajari</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach (['Bahasa Inggris', 'Bahasa Jepang', 'Bahasa Korea'] as $lang)
        <button class="pilih-bahasa bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 font-medium py-4 rounded-lg transition" data-value="{{ $lang }}">
          {{ $lang }}
        </button>
        @endforeach
      </div>
    </div>

    <!-- Step 2 -->
    <div id="step2" class="step hidden">
      <h2 class="text-xl font-semibold mb-4 text-gray-800 text-center">Langkah 2: Pilih Paket Belajarmu</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="paket-card cursor-pointer border rounded-xl p-6 hover:border-blue-500 transition" data-paket="Basic">
          <h3 class="text-lg font-bold mb-2 text-blue-700">Paket Basic</h3>
          <p class="text-gray-600 text-sm">Rp150.000 - Akses 1 level bahasa</p>
        </div>
        <div class="paket-card cursor-pointer border rounded-xl p-6 hover:border-blue-500 transition" data-paket="Premium">
          <h3 class="text-lg font-bold mb-2 text-blue-700">Paket Premium</h3>
          <p class="text-gray-600 text-sm">Rp300.000 - Akses semua level + sertifikasi</p>
        </div>
      </div>
      <button id="backToLang" class="mt-8 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Kembali</button>
    </div>

    <!-- Step 3 -->
    <div id="step3" class="step hidden">
      <h2 class="text-xl font-semibold mb-4 text-gray-800 text-center">Langkah 3: Lengkapi Data & Bukti Pembayaran</h2>
      <form id="registerForm" action="{{ route('login.simulasi') }}" method="GET" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="bahasa" id="inputBahasa">
        <input type="hidden" name="paket" id="inputPaket">

        <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full px-4 py-3 border rounded-lg bg-gray-50">
        <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 border rounded-lg bg-gray-50">
        <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-3 border rounded-lg bg-gray-50">

        <div>
          <label class="block text-sm font-medium mb-1">Upload Bukti Pembayaran</label>
          <input type="file" name="bukti" accept="image/*" required class="block w-full text-sm text-gray-700
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
          <p class="text-xs text-gray-500 mt-1">Transfer ke BCA 1234567890 a/n LinguEdu</p>
        </div>

        <div class="flex justify-between mt-6">
          <button id="backToPaket" type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Kembali</button>
          <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Daftar Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const step3 = document.getElementById('step3');
  const circles = [step1Circle, step2Circle, step3Circle];

  document.querySelectorAll('.pilih-bahasa').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('inputBahasa').value = btn.dataset.value;
      step1.classList.add('hidden');
      step2.classList.remove('hidden');
      circles[1].classList.replace('bg-gray-300','bg-blue-600');
      circles[1].classList.replace('text-gray-600','text-white');
    });
  });

  document.querySelectorAll('.paket-card').forEach(card => {
    card.addEventListener('click', () => {
      document.getElementById('inputPaket').value = card.dataset.paket;
      step2.classList.add('hidden');
      step3.classList.remove('hidden');
      circles[2].classList.replace('bg-gray-300','bg-blue-600');
      circles[2].classList.replace('text-gray-600','text-white');
    });
  });

  document.getElementById('backToLang').addEventListener('click', () => {
    step2.classList.add('hidden');
    step1.classList.remove('hidden');
    circles[1].classList.replace('bg-blue-600','bg-gray-300');
    circles[1].classList.replace('text-white','text-gray-600');
  });

  document.getElementById('backToPaket').addEventListener('click', () => {
    step3.classList.add('hidden');
    step2.classList.remove('hidden');
    circles[2].classList.replace('bg-blue-600','bg-gray-300');
    circles[2].classList.replace('text-white','text-gray-600');
  });
});
</script>
@endpush

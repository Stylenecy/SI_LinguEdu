@extends('layouts.main')
@section('title', 'Login - LinguEdu')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-50 py-16 px-4">
  <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">Selamat Datang Kembali!</h1>
    <p class="text-center text-gray-500 mb-8">Masuk ke akun LinguEdu Anda untuk melanjutkan pembelajaran.</p>

    <!-- Form Login -->
    <form method="POST" action="{{ route('dashboard.index') }}">
      @csrf
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" placeholder="email@anda.com" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50">
      </div>

      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50">
      </div>

      <button type="submit"
              class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
        Masuk Sekarang
      </button>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Belum punya akun?
      <a href="{{ route('register.simulasi') }}" class="text-blue-600 font-medium hover:underline">
        Daftar di sini
      </a>
    </p>
  </div>
</div>
@endsection

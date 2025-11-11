@extends('layouts.main')
@section('title', 'Login - LinguEdu')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-blue-50 py-16 px-4">
        <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">
            <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">Selamat Datang Kembali!</h1>
            <p class="text-center text-gray-500 mb-8">Masuk ke akun LinguEdu Anda untuk melanjutkan pembelajaran.</p>

            <!-- 🔔 Notifikasi -->
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg text-center">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login.simulasi.post') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="email@anda.com" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Ingat Saya</label>
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
            <p class="text-sm text-center text-gray-500 mt-2">
                Lupa password?
                <a href="{{ route('password.request') }}" class="text-blue-600 font-medium hover:underline">
                    Reset di sini
                </a>
            </p>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LinguEdu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb', // blue-600
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center px-4 font-sans">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">

        <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">Selamat Datang Kembali!</h1>
        <p class="text-center text-gray-500 mb-8">Masuk ke akun LinguEdu Anda untuk melanjutkan pembelajaran.</p>

        <!-- Notifikasi Error/Sukses -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 text-center bg-green-100 p-2 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
             <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg text-center text-sm">
                Login gagal. Silakan periksa kembali email dan password Anda.
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email@anda.com" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50 outline-none transition-all">
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50 outline-none transition-all">
                @error('password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary mr-2" name="remember">
                    <label for="remember_me" class="text-sm text-gray-700">Ingat Saya</label>
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Masuk Sekarang
            </button>
        </form>

        <!-- Footer Links -->
        <p class="text-sm text-center text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">
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

</body>
</html>

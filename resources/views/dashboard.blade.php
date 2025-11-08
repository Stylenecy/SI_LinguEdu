<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LinguEdu Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
  <div class="bg-white p-10 rounded-2xl shadow-xl text-center w-96">
    <h1 class="text-3xl font-bold text-gray-800 mb-3">Selamat Datang 👋</h1>
    <p class="text-gray-600 mb-6">Kamu berhasil masuk ke Dashboard LinguEdu!</p>
    <a href="{{ url('/') }}" class="text-blue-500 font-semibold hover:underline">← Kembali ke Login</a>
  </div>
</body>
</html>

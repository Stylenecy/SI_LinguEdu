<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LinguEdu — Belajar Bahasa Inggris')</title>
    <meta name="description" content="LinguEdu — platform belajar bahasa Inggris dari Beginner sampai Advanced, lengkap dengan video, kuis interaktif, dan sertifikat.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
    @stack('head')
</head>
<body class="min-h-screen antialiased">
    @yield('content')
    @stack('scripts')
</body>
</html>

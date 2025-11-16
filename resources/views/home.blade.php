@section('title', 'LinguEdu - Home')

@section('content')

<!-- Hero Section -->
<div class="relative bg-blue-600 text-white text-center py-24 overflow-hidden">
    <div class="max-w-3xl mx-auto px-6 relative z-10">
        <h1 class="text-5xl font-extrabold mb-4 animate-fadeIn">
            Belajar Bahasa Dunia dengan <span class="text-yellow-300">LinguEdu</span>
        </h1>
        <p class="text-lg text-blue-100 mb-10">Tingkatkan kemampuanmu & raih sertifikasi internasional bersama kami.</p>
        <button id="getStartedBtn" type="button" aria-haspopup="dialog" aria-controls="authModal"
            class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-lg hover:bg-blue-100 transition-all transform hover:scale-105">
            Mulai Sekarang
        </button>
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-blue-600 via-blue-700 to-blue-800 opacity-40 pointer-events-none z-0"></div>
</div>

<!-- Modal Login / Register -->
<div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 p-8 relative animate-fadeSlide">
        <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl" aria-label="Tutup">&times;</button>

        <h2 class="text-3xl font-bold text-center mb-8 text-blue-700">Selamat Datang di LinguEdu!</h2>
        <p class="text-center text-gray-600 mb-10">Pilih opsi untuk melanjutkan</p>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Login -->
            <a href="{{ route('auth.login.simulasi') }}"
                class="group border-2 border-blue-500 rounded-xl p-8 text-center hover:bg-blue-50 transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-5xl mb-4 text-blue-600 group-hover:scale-110 transition-transform">🔐</div>
                <h3 class="text-xl font-bold text-blue-600 mb-2">Sudah Punya Akun?</h3>
                <p class="text-gray-500">Masuk ke akunmu dan lanjutkan progres belajarmu.</p>
                <span class="mt-4 inline-block text-sm text-blue-500 font-semibold group-hover:underline">Login Sekarang →</span>
            </a>

            <!-- Register -->
            <a href="{{ route('auth.register.simulasi') }}"
                class="group border-2 border-yellow-400 rounded-xl p-8 text-center hover:bg-yellow-50 transition-all duration-300 transform hover:-translate-y-2">
                <div class="text-5xl mb-4 text-yellow-500 group-hover:scale-110 transition-transform">✨</div>
                <h3 class="text-xl font-bold text-yellow-600 mb-2">Baru di LinguEdu?</h3>
                <p class="text-gray-500">Daftar sekarang dan pilih program bahasa impianmu.</p>
                <span class="mt-4 inline-block text-sm text-yellow-500 font-semibold group-hover:underline">Daftar Sekarang →</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const btn = document.getElementById('getStartedBtn');
    const modal = document.getElementById('authModal');
    const close = document.getElementById('closeModal');

    if (btn) {
        btn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        });
    }

    if (close) {
        close.addEventListener('click', () => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    }

    modal?.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });
</script>
@endpush

<!-- Keunggulan -->
<div class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 hover:text-blue-600 transition">Keunggulan Kami</h2>
        <div class="grid md:grid-cols-4 gap-8">
            @foreach ([
                ['icon' => '🎓', 'title' => 'Sertifikasi Internasional', 'desc' => 'Dapatkan sertifikat resmi diakui dunia.'],
                ['icon' => '👨‍🏫', 'title' => 'Native Speaker', 'desc' => 'Belajar langsung dari pengajar luar negeri.'],
                ['icon' => '📱', 'title' => 'Fleksibel', 'desc' => 'Akses kelas kapan pun, di mana pun.'],
                ['icon' => '💎', 'title' => 'Materi Premium', 'desc' => 'Koleksi materi terkurasi oleh ahli bahasa.']
            ] as $item)
            <div class="text-center p-6 hover:bg-blue-50 rounded-xl transition-all transform hover:-translate-y-2 group">
                <div class="text-4xl mb-4 group-hover:scale-110 transition">{{ $item['icon'] }}</div>
                <h3 class="font-bold mb-2 group-hover:text-blue-600">{{ $item['title'] }}</h3>
                <p class="text-gray-600 text-sm opacity-0 group-hover:opacity-100 transition">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Program Bahasa -->
<div class="bg-blue-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 hover:text-blue-600 transition">Program Bahasa</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ([
                ['flag' => 'gb', 'nama' => 'Bahasa Inggris', 'detail' => ['TOEFL', 'IELTS', 'Business English', 'Conversation']],
                ['flag' => 'jp', 'nama' => 'Bahasa Jepang', 'detail' => ['JLPT N5-N1', 'Kanji Master', 'Daily Conversation']],
                ['flag' => 'kr', 'nama' => 'Bahasa Korea', 'detail' => ['TOPIK I & II', 'K-Drama Korean', 'Hangul Master']]
            ] as $lang)
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 relative group">
                <img src="https://flagcdn.com/w160/{{ $lang['flag'] }}.png" class="w-32 mb-4 mx-auto hover:scale-110 transition">
                <h3 class="text-xl font-bold mb-4 hover:text-blue-600">{{ $lang['nama'] }}</h3>
                <ul class="list-disc pl-5 mb-4 space-y-2">
                    @foreach ($lang['detail'] as $d)
                    <li class="hover:text-blue-600 cursor-pointer transition">{{ $d }}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Paket Belajar -->
<div class="bg-white py-16" id="courses">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-12 hover:text-blue-600 transition">Paket Belajar LinguEdu</h2>

    <div class="grid md:grid-cols-3 gap-8">
      <!-- Basic -->
      <div class="border-2 border-blue-200 rounded-xl p-6 hover:border-blue-400 transition-all transform hover:-translate-y-2 hover:shadow-xl">
        <h3 class="text-2xl font-bold mb-4 hover:text-blue-600">Basic</h3>
        <ul class="space-y-3 mb-6 text-gray-700">
          <li>🔹 8x Modul Video Interaktif</li>
          <li>🔹 Latihan Soal Setiap Bab</li>
          <li>🔹 Akses Quiz Otomatis dan Skor Langsung</li>
          <li>🔹 Sertifikat Level Dasar (CEFR A1–A2)</li>
          <li>🔹 Durasi akses 3 bulan</li>
        </ul>
        <a href="{{ route('auth.register.simulasi') }}" class="block text-center py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
           Pilih Paket Basic
        </a>
      </div>

      <!-- Intermediate -->
      <div class="border-2 border-yellow-400 rounded-xl p-6 bg-yellow-50 hover:border-yellow-500 transition-all transform hover:-translate-y-2 hover:shadow-xl relative">
        <div class="absolute -top-4 right-4 bg-yellow-400 text-gray-900 px-4 py-1 rounded-full font-bold text-sm animate-bounce">Terfavorit!</div>
        <h3 class="text-2xl font-bold mb-4 hover:text-yellow-600">Intermediate</h3>
        <ul class="space-y-3 mb-6 text-gray-700">
          <li>⭐ 12x Modul Terstruktur + Challenge Mingguan</li>
          <li>⭐ Simulasi Listening & Reading Adaptif</li>
          <li>⭐ Sistem Penilaian Otomatis per Level</li>
        </ul>
        <a href="{{ route('auth.register.simulasi') }}" class="block text-center py-3 bg-yellow-400 text-gray-900 rounded-lg hover:bg-yellow-500 transition">
           Pilih Paket Intermediate
        </a>
      </div>

      <!-- Advanced -->
      <div class="border-2 border-blue-200 rounded-xl p-6 hover:border-blue-400 transition-all transform hover:-translate-y-2 hover:shadow-xl">
        <h3 class="text-2xl font-bold mb-4 hover:text-blue-600">Advanced + Sertifikasi</h3>
        <ul class="space-y-3 mb-6 text-gray-700">
          <li>🏅 20x Modul Advanced + Ujian Akhir</li>
          <li>🏅 Akses Semua Level Sebelumnya (Basic + Intermediate)</li>
          <li>🏅 Sertifikat Resmi LinguEdu (CEFR C1–C2)</li>
        </ul>
        <a href="{{ route('auth.register.simulasi') }}" class="block text-center py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
           Pilih Paket Sertifikasi
        </a>
      </div>
    </div>

    <div class="text-center mt-10">
      <p class="text-gray-500 text-sm">Semua paket sudah termasuk akses dashboard, laporan kemajuan otomatis, dan evaluasi AI.</p>
    </div>
  </div>
</div>

@endsection
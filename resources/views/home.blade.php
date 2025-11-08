<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LinguEdu - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in { animation: fadeIn 1s ease-out; }

    .user-count-change { transition: transform 0.3s ease, color 0.3s ease; }
    .user-count-change.bump { transform: scale(1.2); color: #fcd34d; }

    .error-msg { animation: fadeIn 0.4s ease; }
  </style>

  <script>
    // Realtime clock
    function updateClock() {
      const now = new Date();
      document.getElementById('clock').textContent = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
  </script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen fade-in">
  <div class="w-11/12 md:w-3/4 lg:w-2/3 bg-white shadow-2xl rounded-3xl flex overflow-hidden transform transition duration-700 hover:scale-[1.01]">

    <!-- Form Login -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
      <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">LinguEdu</h1>

      <form id="loginForm" class="space-y-5">
        <div>
          <label class="block mb-1 font-semibold text-gray-600">Username</label>
          <input id="username" type="text"
                 class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 transition"
                 placeholder="Masukkan username">
          <p id="usernameAlert" class="text-red-500 text-xs mt-1 hidden">🛑 Hanya huruf A–Z yang diperbolehkan.</p>
        </div>
        <div>
          <label class="block mb-1 font-semibold text-gray-600">Password</label>
          <input id="password" type="password"
                 class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 transition"
                 placeholder="Masukkan password">
        </div>
        <p id="errorMsg" class="text-red-500 text-sm font-semibold hidden error-msg text-center"></p>
        <button type="submit"
                class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 active:scale-95 transition duration-200 shadow-md hover:shadow-lg">
          Login
        </button>
      </form>
    </div>

    <!-- Dashboard mini -->
    <div class="hidden md:flex w-1/2 bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex-col justify-center items-center p-10">
      <div class="text-center mb-8 fade-in">
        <h2 class="text-2xl font-semibold mb-2">Dashboard Overview</h2>
        <p class="text-white text-opacity-80">Sesi pengguna LinguEdu</p>
      </div>

      <div class="bg-white bg-opacity-20 rounded-2xl p-6 text-center shadow-lg w-60 fade-in">
        <p class="text-lg">Active Users</p>
        <p class="text-4xl font-bold mt-2 user-count-change" id="userCount">27</p>
      </div>

      <div class="mt-6 bg-white bg-opacity-20 rounded-2xl p-4 text-center w-60 fade-in">
        <p class="text-lg mb-1">Current Time</p>
        <p class="text-2xl font-semibold" id="clock">--:--:--</p>
      </div>
    </div>
  </div>

  <script>
    // Update jumlah user aktif
    function updateUserCount() {
      const count = Math.floor(20 + Math.random() * 30);
      const userCountEl = document.getElementById('userCount');
      userCountEl.classList.add('bump');
      setTimeout(() => userCountEl.classList.remove('bump'), 300);
      userCountEl.textContent = count;
    }
    setInterval(updateUserCount, 4000);
    updateClock();
    updateUserCount();

    // 🔒 Batasi input username hanya huruf (tanpa angka, spasi, simbol)
    const usernameInput = document.getElementById("username");
    const usernameAlert = document.getElementById("usernameAlert");
    let alertTimeout = null;

    usernameInput.addEventListener("input", function (e) {
      const cleaned = e.target.value.replace(/[^A-Za-z]/g, ""); // hanya huruf A-Z
      if (e.target.value !== cleaned) {
        e.target.value = cleaned;

        // tampilkan notifikasi
        usernameAlert.classList.remove("hidden");

        // sembunyikan otomatis setelah 2 detik
        clearTimeout(alertTimeout);
        alertTimeout = setTimeout(() => {
          usernameAlert.classList.add("hidden");
        }, 2000);
      }
    });

    // Fungsi validasi login
    document.getElementById("loginForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value.trim();
      const errorMsg = document.getElementById("errorMsg");

      if (!username || !password) {
        errorMsg.textContent = "⚠️ Harap isi semua kolom sebelum login.";
        errorMsg.classList.remove("hidden");
        return;
      }

      // Jika lolos validasi
      errorMsg.classList.add("hidden");

      // Simulasi redirect (tanpa backend)
      window.location.href = "{{ route('dashboard') }}";
    });
  </script>
</body>
</html>

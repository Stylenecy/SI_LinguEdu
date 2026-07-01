# PROJECT MASTER — LinguEdu

> Nyawa proyek. Baca ini pertama sebelum ngoding di sini.
> Last updated: **2026-06-21** (Claude Opus 4.8) — modernisasi + backend dibangun, web fungsional.

---

## 🎯 Vision & Mission
**LinguEdu** = platform edu-tech belajar **bahasa Inggris** berbasis web. Siswa belajar per-level
(Beginner → Intermediate → Advanced), tiap materi = **video → teori → kuis**. Lulus kuis (skor ≥70)
membuka materi berikutnya; selesai semua level → **sertifikat** otomatis. Admin kelola user, materi,
kuis, paket, dan sertifikat.

**Why:** proyek kuliah RPL. Goal sesi ini: ubah dari wireframe (UI doang) jadi aplikasi yang
benar-benar jalan & deploy-ready.

---

## 🧱 Stack (modern, TIDAK perlu rebuild)
| Layer | Teknologi |
|---|---|
| Backend | **Laravel 12** (PHP 8.2, XAMPP) |
| Frontend | Blade + **Tailwind 4** (Vite 7) + Bootstrap 5 (CDN per-halaman) |
| DB | **SQLite** (`database/database.sqlite`) — zero-setup, ganti ke MySQL/Postgres saat deploy |
| Auth | Laravel Auth asli (session, bcrypt), role `user`/`admin` |
| Build | Vite (`npm run build`) → `public/build/manifest.json` |

---

## 📦 PAST — apa yang sudah dilakukan (track record)
### Tim asli (GitHub `Stylenecy/SI_LinguEdu`)
- Scaffold Laravel 12 + Tailwind 4. **24 view Blade UI/UX** (home, auth, dashboard member, panel admin).
- **MASALAH:** semua mockup. Auth hardcoded di route closure, data di `@php` array, tanpa DB,
  tanpa controller, tanpa model domain, kuis/progress/sertifikat tidak berfungsi.

### Sesi 2026-06-21 (Claude Opus 4.8) — BACKEND DIBANGUN, web fungsional ✅
- **Repo di-clone** dari GitHub, junk dibersihkan (`er`, `er --allow-unrelated-histories`, folder `SI_LinguEdu/` kosong).
- **6 migrasi domain:** `lessons`, `questions`, `lesson_user` (progress pivot), `certificates`,
  `packages`, + kolom `role` di `users`.
- **5 model** (`User`, `Lesson`, `Question`, `Certificate`, `Package`) + relasi.
- **Auth asli** (register/login/logout, role-based, middleware `admin`).
- **7 controller**: Auth, Dashboard, Materi, Quiz (grading), Certificate, Admin (CRUD penuh).
- **Kurikulum bahasa Inggris di-seed**: 9 materi (3 level) + 36 soal kuis + 3 paket + 2 akun demo.
- **Semua view di-wire ke DB nyata** (member + admin). Quiz auto-grading + progress tersimpan.
- **Diverifikasi end-to-end** (curl): login 200, lesson flow 200, submit kuis → skor 100 tersimpan,
  laporan update, admin 6 halaman 200, role gate 403, register bikin user baru + auto-login.

---

## 🔵 PRESENT — fokus aktif
Aplikasi **JALAN & fungsional di lokal**. Demo loop lengkap: daftar → belajar → kuis → progress → sertifikat.
Belum di-deploy ke server publik.

### Akun demo
- **Admin:** `adminlinguedu@gmail.com` / `admin1234`
- **Siswa:** `siswa@linguedu.com` / `password`

---

## 🔮 FUTURE — roadmap
1. **Deploy** (lihat `docs/SETUP.md` §Deploy). Ganti SQLite → MySQL/Postgres, set `APP_ENV=production`.
2. Upload bukti pembayaran + verifikasi paket (alur paket saat ini belum transaksional).
3. Edit/Update materi & soal di admin (sekarang ada Create + Delete; Update belum).
4. Sertifikat PDF server-side (sekarang `window.print()` browser).
5. Lupa-password fungsional (sekarang halaman stub).
6. Test otomatis (PHPUnit) untuk auth + grading.

---

## ▶️ Cara jalanin (ringkas — detail di `docs/SETUP.md`)
```bash
composer install
npm install
# .env sudah ada + APP_KEY sudah di-set + database/database.sqlite sudah ada
npm run build
php artisan serve     # http://127.0.0.1:8000
```
⚠️ **Windows:** kalau `composer install` nge-hang di "Generating optimized autoload files",
jalankan `composer dump-autoload --no-scripts` (penyebab: Defender scan folder vendor). Detail di `.agent/AGENT.md`.

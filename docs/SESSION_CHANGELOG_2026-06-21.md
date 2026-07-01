# Session Changelog — 2026-06-21
**Proyek:** LinguEdu (edu-tech bahasa Inggris)
**AI yang mengerjakan:** Claude Opus 4.8 (1M context)

## Apa yang Berubah
- **Repo di-clone** dari GitHub `Stylenecy/SI_LinguEdu` ke folder ini (sebelumnya kosong).
- **Junk dibersihkan** — file artefak `er`, `er --allow-unrelated-histories`, dan folder kosong `SI_LinguEdu/` (sisa command git gagal) → dihapus dari working tree.
- **Audit stack** → Laravel 12 / PHP 8.2 / Vite 7 / Tailwind 4. Verdict: **stack modern, TIDAK rebuild**; yang kurang = backend. Aplikasi lama = wireframe (auth hardcoded, data di `@php` array, tanpa DB/model/controller).
- **Backend dibangun dari nol di atas scaffold yang ada:**
  - 6 migrasi: `lessons`, `questions`, `lesson_user`, `certificates`, `packages`, + kolom `role` di `users`.
  - 5 model + relasi: `User`, `Lesson`, `Question`, `Certificate`, `Package`.
  - Auth asli (register/login/logout, role-based) + middleware `admin`.
  - 7 controller: Auth, Dashboard, Materi, Quiz (auto-grading), Certificate, Admin (CRUD).
  - Seeder kurikulum **bahasa Inggris**: 9 materi (3 level), 36 soal, 3 paket, 2 akun demo.
- **Konten diganti** dari topik "programming" (placeholder tim lama) → materi **bahasa Inggris** sesuai identitas "LinguEdu".
- **Semua view di-wire ke DB** (member: dashboard/materi/video/teori/kuis/hasil/laporan/sertifikasi; admin: 6 halaman). 2 view kuis baru dibuat. Register diubah dari wizard JS palsu → form asli yang nyimpan ke DB.
- **Route di-rewrite** dari closure simulasi → controller asli + middleware `auth`/`admin`. Nama route lama (`login.simulasi` dll) di-fix di semua Blade.

## Kenapa Diubah
Goal Dex: modernisasi/sempurnain LinguEdu sampai jalan & deploy-ready. Stack ternyata sudah modern,
jadi solusi tercepat = bangun backend yang diimplikasikan UI, bukan rebuild. Hasil: web fungsional.

## File yang Dibuat/Dimodifikasi (ringkas)
- `database/migrations/2026_06_21_*` — dibuat (6 migrasi)
- `app/Models/{User,Lesson,Question,Certificate,Package}.php` — dibuat/dimodifikasi
- `app/Http/Controllers/**` + `app/Http/Middleware/EnsureUserIsAdmin.php` — dibuat
- `database/seeders/DatabaseSeeder.php` — ditulis ulang (kurikulum bahasa Inggris)
- `routes/web.php`, `bootstrap/app.php` — dimodifikasi
- `resources/views/**` — member + admin + auth di-wire ke data nyata
- `PROJECT_MASTER.md`, `.agent/AGENT.md`, `docs/SETUP.md`, changelog ini — dibuat

## Verifikasi (bukan klaim kosong)
Smoke test via curl pada `php artisan serve`:
- Public 200, gate auth (302), role gate (403) ✅
- Login siswa → dashboard/materi/laporan/sertifikasi 200 ✅
- Lesson flow video/teori/kuis 200 ✅
- **Submit kuis → skor 100, 4/4, progress tersimpan ke DB** (laporan jadi "1/9") ✅
- Admin login → 6 halaman admin 200 ✅
- Register → user baru dibuat + auto-login ✅; Admin create paket → tersimpan ✅
- DB di-reset ke kondisi pristine (users=2, lessons=9, questions=36, packages=3, progress=0)

## Yang Perlu Dex Tahu
1. **Web JALAN di lokal** `http://127.0.0.1:8000`. Cara start ada di `docs/SETUP.md`. Akun demo: admin `adminlinguedu@gmail.com`/`admin1234`, siswa `siswa@linguedu.com`/`password`.
2. **Belum di-deploy** dan **belum di-commit/push** ke GitHub (sengaja — nunggu kamu review). Working tree berisi semua perubahan.
3. **Windows gotcha:** `composer install` bisa nge-hang di autoload (Defender). Fix: `composer dump-autoload --no-scripts`. `optimize-autoloader` sengaja `false`.
4. **Masih stub (jujur):** alur paket/pembayaran belum transaksional; lupa-password halaman stub; admin baru Create+Delete (Update belum); sertifikat pakai print browser, bukan PDF server.
5. SQLite dipakai biar zero-setup. Untuk deploy ganti MySQL/Postgres (panduan di SETUP.md).

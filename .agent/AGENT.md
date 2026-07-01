# AGENT.md — instruksi AI untuk LinguEdu

Baca `PROJECT_MASTER.md` di root dulu. File ini = aturan teknis + larangan keras.

## Stack & konvensi
- **Laravel 12 / PHP 8.2 / Vite 7 / Tailwind 4 / SQLite.** Stack sudah modern — JANGAN rebuild.
- Controller di `app/Http/Controllers` (Auth/, Admin/ subfolder). Model di `app/Models`.
- Route di `routes/web.php` (semua web, belum ada API). Nama route: `dashboard.*`, `member.*`, `admin.*`.
- View Blade: member extend `member.dashboard.main`, admin extend `layouts.admin`, auth/home extend `layouts.main`.
- Tailwind di-load via `cdn.tailwindcss.com` (Play CDN) DAN Vite `@vite`. Bootstrap 5 via CDN per-halaman.
- DB pakai SQLite file `database/database.sqlite`. Migrasi domain prefix `2026_06_21_*`.

## Domain model (relasi)
- `User` hasMany progress (`lesson_user` pivot: completed, score, completed_at), hasMany Certificate. `role` = user|admin.
- `Lesson` (level 1-3, slug, theory, video_url) hasMany `Question`.
- `Question` (option_a..d, correct_option a|b|c|d).
- Grading: `QuizController@submit` → skor = benar/total*100; **lulus ≥70** → mark completed + simpan best score.
- Level unlock: level N terbuka kalau semua materi level <N sudah completed (`User::hasCompletedLevel`).

## ⚠️ Gotcha lingkungan Windows (PENTING)
- **`composer install` / `dump-autoload -o` SERING HANG** di "Generating optimized autoload files"
  karena Windows Defender scan folder `vendor/`. **Fix:** `composer dump-autoload --no-scripts`
  (non-optimized, ~6 detik). `optimize-autoloader` sengaja di-set `false` di `composer.json` biar tidak hang.
  Untuk deploy (Linux), pakai `composer install --optimize-autoloader` — di sana aman.
- Shell di-wrap RTK proxy (muncul `[rtk] No hook installed`) — harmless, abaikan.
- `php artisan` kadang lambat (AV) tapi jalan. Sabar, jangan kira hang.

## 🚫 LARANGAN KERAS
- **JANGAN hapus data/histori.** Arsipkan, jangan delete (Agent-Protocol §8).
- **JANGAN hardcode lagi** data materi/kuis di Blade `@php` array — semua dari DB.
- **JANGAN** commit `.env` atau `database/database.sqlite` berisi data asli ke repo publik.
- **JANGAN** klaim "done" untuk stub. Alur paket/pembayaran & lupa-password masih stub — tandai jelas.

## Status terverifikasi (2026-06-21)
Web fungsional end-to-end (login, lesson, quiz grading, progress, sertifikat, admin CRUD).
Diverifikasi via curl smoke test. Belum deploy.

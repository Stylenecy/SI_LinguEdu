# SETUP — LinguEdu

Panduan jalanin LinguEdu dari nol + deploy.

## Prasyarat
- PHP **8.2+** (XAMPP oke), Composer, Node.js 18+ / npm.

## 1. Install dependency
```bash
composer install
npm install
```
> **Windows — kalau `composer install` macet** di `Generating optimized autoload files`:
> Ctrl+C, lalu:
> ```bash
> composer dump-autoload --no-scripts
> ```
> Penyebab: Windows Defender scan folder `vendor/`. (Opsional permanen: tambah folder proyek
> ke Defender exclusion.) `optimize-autoloader` sudah di-set `false` di `composer.json`.

## 2. Environment
`.env` sudah ada (dari `.env.example`) dengan `APP_KEY` ter-set dan `DB_CONNECTION=sqlite`.
Kalau mulai bersih:
```bash
cp .env.example .env
php artisan key:generate
```

## 3. Database (SQLite — zero setup)
File `database/database.sqlite` sudah ada. Untuk reset/isi ulang data:
```bash
php artisan migrate:fresh --seed
```
Seed mengisi: 2 akun demo, 9 materi (3 level), 36 soal kuis, 3 paket.

## 4. Build asset frontend
```bash
npm run build       # produksi → public/build/
# atau saat dev (hot reload):
npm run dev
```

## 5. Jalankan
```bash
php artisan serve
# buka http://127.0.0.1:8000
```

## Akun demo
| Peran | Email | Password |
|---|---|---|
| Admin | `adminlinguedu@gmail.com` | `admin1234` |
| Siswa | `siswa@linguedu.com` | `password` |

Atau klik **Daftar** untuk bikin akun siswa baru (langsung auto-login).

## Alur demo (biar keliatan fungsional)
1. Login sebagai **siswa** → Dashboard (progress 0%).
2. **Materi** → Level 1 → "Mulai Belajar" → Video → **Lanjut ke Teori** → **Mulai Kuis**.
3. Jawab kuis → skor muncul + pembahasan. Skor ≥70 → materi tertandai selesai.
4. Selesaikan semua materi 1 level → level berikutnya kebuka.
5. **Progress** (laporan) update otomatis. Selesai semua level → **Sertifikasi** terbit (bisa di-print).
6. Login **admin** (`/admin/login`) → kelola User / Materi / Kuis / Paket / Sertifikat.

---

## Deploy (ringkas)
Target gampang: **Railway / Render / VPS** (Laravel native). Vercel butuh setup PHP runtime — kurang ideal.

1. **DB produksi:** ganti ke MySQL/Postgres. Di `.env`:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domainmu
   DB_CONNECTION=mysql
   DB_HOST=... DB_DATABASE=... DB_USERNAME=... DB_PASSWORD=...
   ```
2. Di server:
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   php artisan key:generate
   php artisan migrate --seed --force
   php artisan config:cache && php artisan route:cache
   ```
3. Document root → `public/`. Pastikan `storage/` & `bootstrap/cache/` writable.

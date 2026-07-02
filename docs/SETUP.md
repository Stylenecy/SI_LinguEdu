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

## Deploy (Railway - Sangat Direkomendasikan) 🚀

Railway sangat cocok untuk Laravel karena mendukung server penuh (Nixpacks) dan provisioning MySQL sekali klik.

### Langkah 1: Siapkan Akun & Database di Railway
1. Daftar atau login di [railway.app](https://railway.app/).
2. Buat proyek baru: Klik **New Project** → pilih **Provision MySQL**.
3. Tunggu database MySQL selesai dibuat.

### Langkah 2: Hubungkan Repository GitHub
1. Di proyek Railway Anda, klik **+ Add Service** → pilih **GitHub Repo**.
2. Pilih repository `SI_LinguEdu` (atau repo hasil clone Anda).
3. Railway akan otomatis mendeteksi konfigurasi Laravel via Nixpacks.

### Langkah 3: Konfigurasi Environment Variables (Sangat Penting)
Di dashboard Railway, buka service aplikasi Anda (bukan service MySQL), masuk ke tab **Variables**, lalu tambahkan key berikut:

| Key | Value | Keterangan |
|---|---|---|
| `APP_ENV` | `production` | Mode produksi |
| `APP_DEBUG` | `false` | Matikan debug mode demi keamanan |
| `APP_URL` | `${{ RAILWAY_PUBLIC_DOMAIN }}` | Otomatis menggunakan domain dari Railway |
| `APP_KEY` | *Ambil dari file `.env` lokal Anda* | Contoh: `base64:xxxx...` |
| `DB_CONNECTION` | `mysql` | Menggunakan MySQL di produksi |
| `DB_HOST` | `${{ MYSQLHOST }}` | Variabel referensi dari MySQL service Railway |
| `DB_PORT` | `${{ MYSQLPORT }}` | Variabel referensi dari MySQL service Railway |
| `DB_DATABASE` | `${{ MYSQLDATABASE }}` | Variabel referensi dari MySQL service Railway |
| `DB_USERNAME` | `${{ MYSQLUSER }}` | Variabel referensi dari MySQL service Railway |
| `DB_PASSWORD` | `${{ MYSQLPASSWORD }}` | Variabel referensi dari MySQL service Railway |

*Catatan: Railway mendukung auto-mapping dengan syntax `${{ VARIABLE }}` di atas, sehingga Anda tidak perlu menyalin manual credential dari database MySQL.*

### Langkah 4: Tambahkan Custom Build Command
Karena di produksi kita perlu menjalankan migrasi database dan seed data secara otomatis, tambahkan variable khusus di Railway:

- Tambahkan Variable baru di dashboard Railway service aplikasi Anda:
  - Key: `NIXPACKS_START_CMD`
  - Value: `php artisan migrate --force && php artisan db:seed --force && node /assets/entrypoint.js` atau jika Nixpacks mendeteksi PHP-FPM bawaan, cukup biarkan default start command-nya berjalan dan masukkan command migrasi di **Deploy Settings** dashboard Railway (bagian **Start Command**):
    ```bash
    php artisan migrate --force && php artisan db:seed --force && perl -pie 's/listen 80/listen '\"\$PORT\"'/g' /etc/nginx/sites-available/default && php-fpm -D && nginx -g 'daemon off;'
    ```
    *Tips alternatif yang lebih simpel di Railway:* Anda bisa mengosongkan custom start command dan menjalankan migrasi secara manual sekali saja lewat tab **Railway CLI / Terminal** setelah deploy berhasil:
    ```bash
    php artisan migrate --force && php artisan db:seed --force
    ```

### Langkah 5: Generate Public Domain
1. Buka service aplikasi Anda di Railway.
2. Masuk ke tab **Settings** → bagian **Networking** → Klik **Generate Domain**.
3. Selesai! Aplikasi Anda akan ter-deploy dan bisa diakses secara publik.

---

## Deploy Manual (VPS / Server Lain)
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

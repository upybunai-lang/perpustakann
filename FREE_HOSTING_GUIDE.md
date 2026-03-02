# 🆓 Panduan Hosting GRATIS untuk Aplikasi Perpustakaan

## 🎁 Pilihan Hosting Gratis

### 1. InfinityFree (Recommended) ⭐
- **Website:** https://www.infinityfree.net
- **Fitur:**
  - Unlimited Bandwidth
  - Unlimited Disk Space
  - PHP 8.x Support
  - MySQL Database
  - cPanel
  - Free SSL
  - No Ads
- **Kekurangan:**
  - Ada batasan hits per hari
  - Performa lebih lambat dari berbayar
- **Cocok untuk:** Testing & Portfolio

### 2. 000webhost
- **Website:** https://www.000webhost.com
- **Fitur:**
  - 300 MB Disk Space
  - 3 GB Bandwidth
  - PHP Support
  - MySQL Database
  - No Ads
- **Kekurangan:**
  - Storage terbatas
  - 1 website saja
- **Cocok untuk:** Project kecil

### 3. Vercel (Frontend) + PlanetScale (Database)
- **Website:** https://vercel.com + https://planetscale.com
- **Fitur:**
  - Unlimited Bandwidth
  - Fast Performance
  - Free SSL
  - Git Integration
- **Kekurangan:**
  - Perlu setup lebih kompleks
  - Tidak support PHP langsung (perlu API)
- **Cocok untuk:** Developer berpengalaman

### 4. Railway.app
- **Website:** https://railway.app
- **Fitur:**
  - $5 free credit per bulan
  - Support PHP & MySQL
  - Git Integration
  - Auto Deploy
- **Kekurangan:**
  - Credit terbatas
- **Cocok untuk:** Development & Testing

### 5. Heroku (Free Tier - Terbatas)
- **Website:** https://www.heroku.com
- **Fitur:**
  - 550-1000 dyno hours/bulan
  - Git Integration
  - Add-ons gratis
- **Kekurangan:**
  - Sleep setelah 30 menit tidak aktif
  - Perlu kartu kredit untuk verifikasi
- **Cocok untuk:** Testing

---

## 🚀 METODE 1: Deploy ke InfinityFree (PALING MUDAH)

### Langkah 1: Daftar InfinityFree

1. Buka https://www.infinityfree.net
2. Klik **Sign Up**
3. Isi form:
   - Email
   - Password
4. Verifikasi email
5. Login ke Client Area

### Langkah 2: Buat Akun Hosting

1. Di Client Area, klik **Create Account**
2. Pilih **Use a subdomain**
3. Isi subdomain: `perpustakaanku` (akan jadi perpustakaanku.infinityfreeapp.com)
4. Atau gunakan domain sendiri jika punya
5. Klik **Create Account**
6. Tunggu 2-5 menit sampai aktif

### Langkah 3: Login cPanel

1. Di Client Area, klik **Control Panel**
2. Atau akses: https://cpanel.infinityfree.net
3. Login dengan credentials dari email

### Langkah 4: Upload File

**Via File Manager:**

1. Di cPanel, klik **Online File Manager**
2. Masuk ke folder `htdocs`
3. Upload file `perpus.zip` (max 10MB per file)
   - Jika file terlalu besar, upload per folder
4. Extract file zip
5. Hapus file zip

**Struktur folder:**
```
htdocs/
└── perpus/
    ├── app/
    ├── public/
    └── ...
```

### Langkah 5: Pindahkan File Public

1. Masuk ke `perpus/public`
2. Select All
3. Move ke `/htdocs/`
4. Edit `index.php` di htdocs:

```php
<?php
require __DIR__.'/perpus/vendor/autoload.php';
$app = require_once __DIR__.'/perpus/bootstrap/app.php';
```

### Langkah 6: Buat Database

1. Di cPanel, klik **MySQL Databases**
2. **Create Database:**
   - Database Name: `perpus_app`
   - Klik **Create Database**

3. **Create User:**
   - Username: `perpus_user`
   - Password: (generate strong password)
   - Klik **Create User**

4. **Add User to Database:**
   - Select user & database
   - Grant ALL PRIVILEGES
   - Klik **Add**

5. **Catat info:**
   ```
   Database: ifxxxxxx_perpus_app
   Username: ifxxxxxx_perpus_user
   Password: your_password
   Host: sqlxxx.infinityfree.net
   ```

### Langkah 7: Import Database

1. Di cPanel, klik **phpMyAdmin**
2. Pilih database `ifxxxxxx_perpus_app`
3. Tab **Import**
4. Choose file `database.sql`
5. Klik **Go**

### Langkah 8: Setup .env

1. Di File Manager, masuk ke `perpus`
2. Copy `.env.example` → `.env`
3. Edit `.env`:

```env
APP_NAME="Sistem Perpustakaan"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://perpustakaanku.infinityfreeapp.com

DB_CONNECTION=mysql
DB_HOST=sqlxxx.infinityfree.net
DB_PORT=3306
DB_DATABASE=ifxxxxxx_perpus_app
DB_USERNAME=ifxxxxxx_perpus_user
DB_PASSWORD=your_password
```

### Langkah 9: Generate App Key

**Via Online Generator:**
1. Buka: https://generate-random.org/laravel-key-generator
2. Copy key
3. Paste ke `.env` → `APP_KEY=base64:xxxxx`

### Langkah 10: Set Permissions

Di File Manager:
1. Folder `perpus/storage` → Permissions: 755
2. Folder `perpus/bootstrap/cache` → Permissions: 755

### Langkah 11: Test!

1. Buka: https://perpustakaanku.infinityfreeapp.com
2. Login: admin@perpus.com / password
3. ✅ Selesai!

---

## 🚀 METODE 2: Deploy ke Railway.app (Modern & Cepat)

### Persiapan

1. **Buat akun GitHub** (jika belum punya)
   - https://github.com/signup

2. **Upload code ke GitHub:**
```bash
cd perpus
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/username/perpus.git
git push -u origin main
```

### Deploy ke Railway

1. **Daftar Railway:**
   - Buka https://railway.app
   - Klik **Login with GitHub**
   - Authorize Railway

2. **Create New Project:**
   - Klik **New Project**
   - Pilih **Deploy from GitHub repo**
   - Pilih repository `perpus`

3. **Add Database:**
   - Klik **+ New**
   - Pilih **Database** → **MySQL**
   - Tunggu database dibuat

4. **Configure Environment:**
   - Klik service `perpus`
   - Tab **Variables**
   - Add variables:
   ```
   APP_NAME=Sistem Perpustakaan
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=(generate dari: php artisan key:generate --show)
   ```

5. **Connect Database:**
   - Railway otomatis inject database credentials
   - Atau manual copy dari MySQL service

6. **Deploy:**
   - Railway otomatis deploy
   - Tunggu build selesai
   - Klik **Generate Domain**

7. **Run Migrations:**
   - Di service, klik **...** → **Run Command**
   - Jalankan: `php artisan migrate --force`

8. **Akses aplikasi:**
   - URL: https://perpus-production-xxxx.up.railway.app

---

## 🚀 METODE 3: Deploy ke 000webhost

### Langkah Singkat:

1. **Daftar:** https://www.000webhost.com
2. **Create Website:**
   - Website Name: perpustakaanku
   - Password: (buat password)
3. **Upload via File Manager:**
   - Upload ke folder `public_html`
   - Extract files
4. **Setup Database:**
   - Create MySQL Database
   - Import database.sql
5. **Edit .env:**
   - Update database credentials
6. **Done!**

---

## 🆓 METODE 4: Deploy ke Heroku (Free Tier)

### Persiapan

```bash
# Install Heroku CLI
# Download dari: https://devcenter.heroku.com/articles/heroku-cli

# Login
heroku login
```

### Deploy

```bash
cd perpus

# Create app
heroku create perpustakaan-app

# Add buildpack
heroku buildpacks:set heroku/php

# Add MySQL (JawsDB)
heroku addons:create jawsdb:kitefin

# Set env
heroku config:set APP_KEY=$(php artisan key:generate --show)
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false

# Create Procfile (sudah ada)
# Deploy
git add .
git commit -m "Deploy to Heroku"
git push heroku main

# Migrate
heroku run php artisan migrate --force

# Open app
heroku open
```

---

## 📊 Perbandingan Hosting Gratis

| Hosting | Disk | Bandwidth | Database | SSL | Ads | Rekomendasi |
|---------|------|-----------|----------|-----|-----|-------------|
| InfinityFree | Unlimited | Unlimited | MySQL | ✅ | ❌ | ⭐⭐⭐⭐⭐ |
| 000webhost | 300MB | 3GB | MySQL | ✅ | ❌ | ⭐⭐⭐⭐ |
| Railway | 1GB | 100GB | MySQL | ✅ | ❌ | ⭐⭐⭐⭐⭐ |
| Heroku | 512MB | Unlimited | Add-on | ✅ | ❌ | ⭐⭐⭐⭐ |

---

## ⚠️ Keterbatasan Hosting Gratis

1. **Performa:**
   - Lebih lambat dari hosting berbayar
   - Bisa down saat traffic tinggi

2. **Batasan:**
   - Storage terbatas
   - Bandwidth terbatas
   - Database size terbatas

3. **Support:**
   - Support terbatas atau tidak ada
   - Harus troubleshoot sendiri

4. **Keamanan:**
   - Backup manual
   - Tidak ada jaminan uptime

---

## 💡 Tips Menggunakan Hosting Gratis

1. **Untuk Testing/Portfolio:**
   - Cocok untuk belajar
   - Demo project
   - Portfolio pribadi

2. **Backup Rutin:**
   - Download database secara berkala
   - Simpan backup di komputer

3. **Optimasi:**
   - Compress gambar
   - Minimize CSS/JS
   - Cache configuration

4. **Monitoring:**
   - Cek website secara berkala
   - Monitor error logs

---

## 🎓 Rekomendasi Berdasarkan Kebutuhan

### Untuk Belajar & Testing:
✅ **InfinityFree** atau **Railway**

### Untuk Portfolio:
✅ **Railway** atau **Vercel + PlanetScale**

### Untuk Project Sekolah:
✅ **InfinityFree** (paling mudah)

### Untuk Production (Serius):
❌ Tidak disarankan hosting gratis
✅ Gunakan hosting berbayar (Rp 20rb/bulan)

---

## 🆘 Troubleshooting Hosting Gratis

### InfinityFree Error 508
- Terlalu banyak request
- Tunggu beberapa menit
- Optimasi query database

### Railway Out of Credit
- Upgrade ke plan berbayar
- Atau pindah ke hosting lain

### Heroku App Sleeping
- Upgrade ke Hobby plan ($7/bulan)
- Atau gunakan uptime monitor gratis

---

## 📞 Support

**InfinityFree Forum:**
https://forum.infinityfree.net

**Railway Discord:**
https://discord.gg/railway

**Stack Overflow:**
https://stackoverflow.com

---

## ✅ Checklist Deploy Gratis

- [ ] Pilih hosting gratis
- [ ] Daftar akun
- [ ] Upload file aplikasi
- [ ] Setup database
- [ ] Import database.sql
- [ ] Edit .env
- [ ] Generate APP_KEY
- [ ] Set permissions
- [ ] Test aplikasi
- [ ] Bookmark URL

---

**Selamat! Aplikasi Anda sudah online GRATIS!** 🎉

Untuk performa lebih baik, pertimbangkan upgrade ke hosting berbayar (mulai Rp 20.000/bulan).

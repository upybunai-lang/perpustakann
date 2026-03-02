# 🚀 Panduan Cepat Upload ke Hosting

## Untuk Pemula - Shared Hosting (cPanel)

### 1️⃣ Persiapan File

**Di komputer lokal:**

```bash
# Masuk ke folder perpus
cd perpus

# Zip semua file
# Klik kanan folder perpus → Send to → Compressed (zipped) folder
# Atau gunakan WinRAR/7zip
```

### 2️⃣ Beli Hosting & Domain

**Rekomendasi Hosting Indonesia:**
- Niagahoster: https://www.niagahoster.co.id
- Hostinger: https://www.hostinger.co.id
- Rumahweb: https://www.rumahweb.com

**Pilih paket:**
- Minimal: Paket Pelajar/Personal (Rp 20.000-50.000/bulan)
- PHP 8.0+, MySQL, 1GB storage

**Domain:**
- Contoh: `perpustakaanku.com` atau `namasekolah.sch.id`

### 3️⃣ Login cPanel

1. Buka email dari hosting (ada link cPanel)
2. Atau akses: `https://namadomain.com/cpanel`
3. Login dengan username & password dari email

### 4️⃣ Upload File

**Via File Manager (Mudah):**

1. Di cPanel, klik **File Manager**
2. Masuk ke folder `public_html`
3. Klik **Upload**
4. Pilih file `perpus.zip`
5. Tunggu sampai selesai
6. Klik kanan file zip → **Extract**
7. Hapus file zip

**Struktur folder setelah extract:**
```
public_html/
└── perpus/
    ├── app/
    ├── public/
    ├── resources/
    └── ...
```

### 5️⃣ Pindahkan File Public

**PENTING:** Laravel butuh folder `public` sebagai root

1. Masuk ke folder `perpus/public`
2. Select All (Ctrl+A)
3. Klik **Move**
4. Pindah ke: `/public_html/`
5. Klik **Move File(s)**

6. Edit file `index.php` di `public_html`:
   - Klik kanan `index.php` → **Edit**
   - Ubah baris 34 dan 52:
   
   **Dari:**
   ```php
   require __DIR__.'/../vendor/autoload.php';
   $app = require_once __DIR__.'/../bootstrap/app.php';
   ```
   
   **Menjadi:**
   ```php
   require __DIR__.'/perpus/vendor/autoload.php';
   $app = require_once __DIR__.'/perpus/bootstrap/app.php';
   ```
   
   - Klik **Save Changes**

### 6️⃣ Buat Database

1. Di cPanel, klik **MySQL Databases**
2. **Create New Database:**
   - Database Name: `perpus_app`
   - Klik **Create Database**

3. **Create New User:**
   - Username: `perpus_user`
   - Password: (buat password kuat)
   - Klik **Create User**

4. **Add User To Database:**
   - User: `perpus_user`
   - Database: `perpus_app`
   - Klik **Add**
   - Centang **ALL PRIVILEGES**
   - Klik **Make Changes**

5. **Catat informasi ini:**
   ```
   Database Name: cpaneluser_perpus_app
   Username: cpaneluser_perpus_user
   Password: password_yang_dibuat
   Host: localhost
   ```

### 7️⃣ Import Database

1. Di cPanel, klik **phpMyAdmin**
2. Pilih database `cpaneluser_perpus_app`
3. Klik tab **Import**
4. Klik **Choose File**
5. Pilih file `database.sql` dari komputer
6. Klik **Go**
7. Tunggu sampai selesai

### 8️⃣ Setup .env

1. Di File Manager, masuk ke folder `perpus`
2. Cari file `.env.example`
3. Klik kanan → **Copy**
4. Rename copy menjadi `.env`
5. Klik kanan `.env` → **Edit**

6. **Update bagian ini:**
   ```env
   APP_NAME="Sistem Perpustakaan"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://namadomain.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=cpaneluser_perpus_app
   DB_USERNAME=cpaneluser_perpus_user
   DB_PASSWORD=password_database_anda
   ```

7. Klik **Save Changes**

### 9️⃣ Generate App Key

**Via Terminal (jika ada SSH):**
```bash
cd public_html/perpus
php artisan key:generate
```

**Via Online Tool (jika tidak ada SSH):**
1. Buka: https://generate-random.org/laravel-key-generator
2. Copy key yang dihasilkan
3. Edit `.env`, update `APP_KEY=` dengan key tersebut

### 🔟 Set Permissions

Di File Manager:

1. Masuk ke folder `perpus/storage`
2. Klik kanan → **Change Permissions**
3. Set ke `755` (rwxr-xr-x)
4. Centang **Recurse into subdirectories**
5. Klik **Change Permissions**

6. Ulangi untuk folder `perpus/bootstrap/cache`

### 1️⃣1️⃣ Test Aplikasi

1. Buka browser
2. Akses: `https://namadomain.com`
3. Seharusnya muncul halaman welcome
4. Klik **Login**
5. Login dengan:
   - Email: `admin@perpus.com`
   - Password: `password`

### ✅ Selesai!

Aplikasi perpustakaan Anda sudah online! 🎉

---

## 🆘 Troubleshooting

### Error 500
- Cek file `.env` sudah benar
- Cek permissions folder `storage` dan `bootstrap/cache`
- Cek error di `perpus/storage/logs/laravel.log`

### Halaman Blank
- Cek `APP_KEY` di `.env` sudah diisi
- Cek path di `index.php` sudah benar

### CSS/JS Tidak Muncul
- Cek `APP_URL` di `.env` sesuai domain
- Clear browser cache (Ctrl+F5)

### Database Connection Error
- Cek credentials database di `.env`
- Pastikan database sudah diimport
- Cek nama database ada prefix `cpaneluser_`

---

## 📞 Butuh Bantuan?

Hubungi support hosting Anda atau cek dokumentasi lengkap di `DEPLOYMENT_GUIDE.md`

**Video Tutorial:**
- YouTube: "Cara Upload Laravel ke cPanel"
- YouTube: "Deploy Laravel Shared Hosting"

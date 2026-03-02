# 🚀 Panduan LENGKAP Upload ke InfinityFree (Step by Step)

## 📋 Yang Anda Butuhkan:
- [ ] Folder perpus di komputer
- [ ] Email aktif
- [ ] Browser (Chrome/Firefox/Edge)
- [ ] Koneksi internet stabil
- [ ] Waktu: 15-20 menit

---

## 🎯 BAGIAN 1: PERSIAPAN FILE (5 Menit)

### Langkah 1.1: Compress File Perpus

**Windows:**
1. Buka folder tempat folder `perpus` berada
2. Klik kanan pada folder `perpus`
3. Pilih **Send to** → **Compressed (zipped) folder**
4. Tunggu sampai selesai
5. Akan muncul file `perpus.zip`

**Atau gunakan WinRAR/7-Zip:**
1. Klik kanan folder `perpus`
2. Pilih **Add to "perpus.zip"**
3. Tunggu sampai selesai

**PENTING:** Ukuran file zip sebaiknya < 50MB untuk upload mudah

### Langkah 1.2: Siapkan File database.sql

1. Buka folder `perpus`
2. Cari file `database.sql`
3. Pastikan file ini ada (untuk import database nanti)

---

## 🎯 BAGIAN 2: DAFTAR INFINITYFREE (5 Menit)

### Langkah 2.1: Buka Website InfinityFree

1. Buka browser
2. Ketik: **https://www.infinityfree.net**
3. Tekan Enter

### Langkah 2.2: Klik Sign Up

1. Di halaman utama, cari tombol **"Sign Up"** (pojok kanan atas)
2. Klik tombol tersebut

### Langkah 2.3: Isi Form Pendaftaran

Anda akan melihat form dengan field:

**Email Address:**
- Isi dengan email aktif Anda
- Contoh: `namanda@gmail.com`

**Password:**
- Buat password yang kuat
- Minimal 8 karakter
- Contoh: `Perpus2024!`

**Confirm Password:**
- Ketik ulang password yang sama

**Centang:** "I agree to the Terms of Service"

**Klik:** Tombol **"Sign Up"**

### Langkah 2.4: Verifikasi Email

1. Buka email Anda
2. Cari email dari InfinityFree (cek folder Spam jika tidak ada)
3. Klik link verifikasi di email
4. Browser akan membuka halaman konfirmasi
5. Klik **"Proceed to Client Area"**

### Langkah 2.5: Login

1. Masukkan email dan password yang tadi dibuat
2. Klik **"Login"**
3. Anda akan masuk ke **Client Area**

---

## 🎯 BAGIAN 3: BUAT AKUN HOSTING (3 Menit)

### Langkah 3.1: Create Account

1. Di Client Area, cari tombol **"Create Account"**
2. Klik tombol tersebut

### Langkah 3.2: Pilih Domain/Subdomain

Anda akan melihat 3 pilihan:

**Pilihan 1: Use a subdomain (GRATIS - Pilih ini)**
- Klik tab **"Use a subdomain"**
- Isi subdomain yang Anda inginkan
- Contoh: `perpustakaanku`
- Pilih domain: `infinityfreeapp.com`
- Hasil: `perpustakaanku.infinityfreeapp.com`

**Pilihan 2: Use your own domain**
- Jika punya domain sendiri (skip jika tidak punya)

**Pilihan 3: Use a free domain**
- Domain gratis dengan ekstensi .rf.gd, .epizy.com, dll

### Langkah 3.3: Isi Form

**Account Label:**
- Isi nama untuk identifikasi
- Contoh: `Perpustakaan Sekolah`

**Centang:** "I have read and agree to the Terms of Service"

**Klik:** Tombol **"Create Account"**

### Langkah 3.4: Tunggu Aktivasi

1. Akan muncul pesan "Account is being created"
2. Tunggu 2-5 menit
3. Refresh halaman
4. Status akan berubah menjadi **"Active"**

---

## 🎯 BAGIAN 4: UPLOAD FILE (10 Menit)

### Langkah 4.1: Buka cPanel

1. Di Client Area, cari akun hosting yang baru dibuat
2. Klik tombol **"Control Panel"** atau **"cPanel"**
3. Akan membuka halaman cPanel

**Atau akses langsung:**
- URL: `https://cpanel.infinityfree.net`
- Login dengan username & password dari email

### Langkah 4.2: Buka File Manager

1. Di cPanel, scroll ke bawah
2. Cari icon **"Online File Manager"**
3. Klik icon tersebut
4. Akan membuka File Manager di tab baru

### Langkah 4.3: Masuk ke Folder htdocs

1. Di File Manager, Anda akan melihat beberapa folder
2. **Double-click** folder **"htdocs"**
3. Ini adalah folder root website Anda

**PENTING:** Semua file website harus di folder `htdocs`

### Langkah 4.4: Upload File perpus.zip

**Cara 1: Drag & Drop (Mudah)**
1. Buka folder di komputer tempat `perpus.zip` berada
2. Drag (seret) file `perpus.zip` ke File Manager
3. Drop (lepas) di area File Manager
4. Tunggu upload selesai (progress bar akan muncul)

**Cara 2: Upload Button**
1. Klik tombol **"Upload"** di toolbar File Manager
2. Klik **"Select File"**
3. Pilih file `perpus.zip`
4. Klik **"Open"**
5. Upload akan dimulai otomatis
6. Tunggu sampai selesai (100%)

**Jika file terlalu besar (>10MB):**
- Upload per folder (app, public, resources, dll)
- Atau gunakan FTP (FileZilla)

### Langkah 4.5: Extract File Zip

1. Setelah upload selesai, klik **"Back to /htdocs"**
2. Anda akan melihat file `perpus.zip`
3. **Klik kanan** pada file `perpus.zip`
4. Pilih **"Extract"**
5. Pastikan extract ke: `/htdocs/`
6. Klik **"Extract File(s)"**
7. Tunggu proses extract selesai
8. Akan muncul folder `perpus`

### Langkah 4.6: Hapus File Zip (Opsional)

1. Klik kanan pada `perpus.zip`
2. Pilih **"Delete"**
3. Konfirmasi **"Yes"**

---

## 🎯 BAGIAN 5: PINDAHKAN FILE PUBLIC (5 Menit)

**PENTING:** Laravel butuh folder `public` sebagai root website

### Langkah 5.1: Masuk ke Folder perpus/public

1. Double-click folder `perpus`
2. Double-click folder `public`
3. Anda akan melihat banyak file (index.php, .htaccess, dll)

### Langkah 5.2: Select All Files

1. Klik checkbox di header tabel (untuk select semua)
2. Atau tekan **Ctrl+A**
3. Semua file akan tercentang

### Langkah 5.3: Move Files

1. Klik tombol **"Move"** di toolbar
2. Di popup, ubah path menjadi: `/htdocs/`
3. Klik **"Move File(s)"**
4. Tunggu proses selesai
5. Klik **"Close"**

### Langkah 5.4: Kembali ke htdocs

1. Klik **"htdocs"** di breadcrumb (atas)
2. Sekarang di folder `htdocs` ada:
   - Folder `perpus`
   - File `index.php`
   - File `.htaccess`
   - Folder `css`, `js`, dll

### Langkah 5.5: Edit index.php

**SANGAT PENTING - Jangan skip!**

1. Cari file `index.php` di folder `htdocs`
2. **Klik kanan** → **"Edit"**
3. Klik **"Edit"** lagi di popup
4. Akan muncul code editor

**Cari baris ini (sekitar baris 34):**
```php
require __DIR__.'/../vendor/autoload.php';
```

**Ubah menjadi:**
```php
require __DIR__.'/perpus/vendor/autoload.php';
```

**Cari baris ini (sekitar baris 52):**
```php
$app = require_once __DIR__.'/../bootstrap/app.php';
```

**Ubah menjadi:**
```php
$app = require_once __DIR__.'/perpus/bootstrap/app.php';
```

5. Klik **"Save Changes"** (pojok kanan atas)
6. Klik **"Close"**

---

## 🎯 BAGIAN 6: SETUP DATABASE (5 Menit)

### Langkah 6.1: Kembali ke cPanel

1. Klik tab browser cPanel
2. Atau buka: `https://cpanel.infinityfree.net`

### Langkah 6.2: Buka MySQL Databases

1. Di cPanel, scroll ke bagian **"Databases"**
2. Klik **"MySQL Databases"**

### Langkah 6.3: Create Database

1. Di bagian **"Create Database"**
2. **Database Name:** ketik `perpus_app`
3. Klik **"Create Database"**
4. Akan muncul konfirmasi sukses
5. **CATAT** nama database lengkap: `ifxxxxxx_perpus_app`

### Langkah 6.4: Create User

1. Scroll ke bagian **"Create User"**
2. **Username:** ketik `perpus_user`
3. **Password:** klik **"Generate Password"**
4. **CATAT** password yang di-generate (copy ke notepad)
5. Klik **"Create User"**
6. **CATAT** username lengkap: `ifxxxxxx_perpus_user`

### Langkah 6.5: Add User to Database

1. Scroll ke bagian **"Add User to Database"**
2. **User:** pilih `ifxxxxxx_perpus_user`
3. **Database:** pilih `ifxxxxxx_perpus_app`
4. Klik **"Add"**
5. Di halaman privileges, centang **"ALL PRIVILEGES"**
6. Klik **"Make Changes"**

### Langkah 6.6: Catat Database Info

**PENTING - Simpan info ini:**
```
Database Host: sqlxxx.infinityfree.net
Database Name: ifxxxxxx_perpus_app
Database User: ifxxxxxx_perpus_user
Database Password: (password yang di-generate tadi)
```

---

## 🎯 BAGIAN 7: IMPORT DATABASE (3 Menit)

### Langkah 7.1: Buka phpMyAdmin

1. Di cPanel, cari **"phpMyAdmin"**
2. Klik icon phpMyAdmin
3. Akan membuka di tab baru

### Langkah 7.2: Pilih Database

1. Di sidebar kiri, klik database `ifxxxxxx_perpus_app`
2. Database akan terbuka

### Langkah 7.3: Import SQL

1. Klik tab **"Import"** di atas
2. Klik tombol **"Choose File"**
3. Pilih file `database.sql` dari komputer
4. Klik **"Open"**
5. Scroll ke bawah
6. Klik tombol **"Go"** atau **"Import"**
7. Tunggu proses import (beberapa detik)
8. Akan muncul pesan sukses: "Import has been successfully finished"

### Langkah 7.4: Verifikasi

1. Klik database di sidebar
2. Anda akan melihat tabel: `users`, `books`, `members`, `categories`, `borrowings`
3. Klik tabel `users`
4. Klik tab **"Browse"**
5. Anda akan melihat data user (admin@perpus.com)

---

## 🎯 BAGIAN 8: SETUP .ENV (5 Menit)

### Langkah 8.1: Kembali ke File Manager

1. Buka tab File Manager
2. Atau buka dari cPanel → Online File Manager

### Langkah 8.2: Masuk ke Folder perpus

1. Klik folder `htdocs`
2. Klik folder `perpus`

### Langkah 8.3: Copy .env.example

1. Cari file `.env.example`
2. **Klik kanan** → **"Copy"**
3. Nama file baru: `.env`
4. Klik **"Copy File(s)"**

### Langkah 8.4: Edit .env

1. Cari file `.env` (yang baru di-copy)
2. **Klik kanan** → **"Edit"**
3. Klik **"Edit"** di popup
4. Code editor akan terbuka

### Langkah 8.5: Update Database Config

**Cari bagian ini:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_app
DB_USERNAME=root
DB_PASSWORD=
```

**Ubah menjadi (sesuaikan dengan info database Anda):**
```env
DB_CONNECTION=mysql
DB_HOST=sqlxxx.infinityfree.net
DB_PORT=3306
DB_DATABASE=ifxxxxxx_perpus_app
DB_USERNAME=ifxxxxxx_perpus_user
DB_PASSWORD=password_yang_dicatat_tadi
```

**Update juga bagian ini:**
```env
APP_NAME="Sistem Perpustakaan"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://perpustakaanku.infinityfreeapp.com
```

Ganti `perpustakaanku.infinityfreeapp.com` dengan subdomain Anda

### Langkah 8.6: Generate APP_KEY

**Cara 1: Online Generator (Mudah)**
1. Buka tab baru
2. Ketik: `https://generate-random.org/laravel-key-generator`
3. Klik **"Generate Key"**
4. Copy key yang muncul (contoh: `base64:xxxxx`)
5. Paste ke `.env` di bagian `APP_KEY=`

**Cara 2: Manual**
- Gunakan key random 32 karakter

**Hasil:**
```env
APP_KEY=base64:abcdefghijklmnopqrstuvwxyz123456
```

### Langkah 8.7: Save File

1. Klik **"Save Changes"** (pojok kanan atas)
2. Klik **"Close"**

---

## 🎯 BAGIAN 9: SET PERMISSIONS (2 Menit)

### Langkah 9.1: Set Permission storage

1. Di File Manager, masuk ke folder `perpus`
2. Cari folder `storage`
3. **Klik kanan** → **"Change Permissions"**
4. Set permission: **755**
   - Owner: Read, Write, Execute (7)
   - Group: Read, Execute (5)
   - World: Read, Execute (5)
5. **Centang:** "Recurse into subdirectories"
6. Klik **"Change Permissions"**

### Langkah 9.2: Set Permission bootstrap/cache

1. Masuk ke folder `bootstrap`
2. Cari folder `cache`
3. **Klik kanan** → **"Change Permissions"**
4. Set permission: **755**
5. **Centang:** "Recurse into subdirectories"
6. Klik **"Change Permissions"**

---

## 🎯 BAGIAN 10: TEST WEBSITE (2 Menit)

### Langkah 10.1: Buka Website

1. Buka tab browser baru
2. Ketik URL Anda: `https://perpustakaanku.infinityfreeapp.com`
3. Tekan Enter

### Langkah 10.2: Cek Halaman Welcome

Jika berhasil, Anda akan melihat:
- Halaman welcome dengan background gambar perpustakaan
- Tombol "Login" dan "Daftar Akun"
- Tiga card: Manajemen Buku, Data Anggota, Peminjaman

### Langkah 10.3: Test Login

1. Klik tombol **"Login"**
2. Masukkan:
   - Email: `admin@perpus.com`
   - Password: `password`
3. Klik **"Login"**
4. Anda akan masuk ke Dashboard

### Langkah 10.4: Verifikasi Dashboard

Di Dashboard, Anda akan melihat:
- Total Buku
- Buku Tersedia
- Anggota Aktif
- Sedang Dipinjam
- Tabel peminjaman terbaru

---

## ✅ SELESAI! APLIKASI SUDAH ONLINE!

**URL Website Anda:**
`https://perpustakaanku.infinityfreeapp.com`

**Login:**
- Email: `admin@perpus.com`
- Password: `password`

**⚠️ PENTING:**
1. Ganti password default setelah login
2. Bookmark URL website Anda
3. Catat info database untuk backup

---

## 🆘 TROUBLESHOOTING

### Error 500 - Internal Server Error

**Penyebab:**
- File `.env` salah
- Permission folder salah
- APP_KEY belum di-set

**Solusi:**
1. Cek file `.env` → pastikan database credentials benar
2. Cek permission `storage` dan `bootstrap/cache` → harus 755
3. Cek `APP_KEY` di `.env` → harus diisi

### Halaman Blank/Putih

**Solusi:**
1. Cek file `index.php` → pastikan path sudah diubah
2. Clear browser cache (Ctrl+Shift+Delete)
3. Coba akses dengan browser lain

### CSS/JS Tidak Muncul

**Solusi:**
1. Cek `APP_URL` di `.env` → harus sesuai domain
2. Clear browser cache (Ctrl+F5)
3. Cek folder `css` dan `js` ada di `htdocs`

### Database Connection Error

**Solusi:**
1. Cek credentials di `.env`:
   - DB_HOST harus `sqlxxx.infinityfree.net`
   - DB_DATABASE harus `ifxxxxxx_perpus_app`
   - DB_USERNAME harus `ifxxxxxx_perpus_user`
   - DB_PASSWORD harus sesuai yang di-generate
2. Pastikan database sudah diimport
3. Test koneksi di phpMyAdmin

### Error 404 - Not Found

**Solusi:**
1. Pastikan file `index.php` dan `.htaccess` ada di `htdocs`
2. Cek path di `index.php` sudah benar
3. Cek file `.htaccess` tidak corrupt

---

## 📞 BUTUH BANTUAN?

**InfinityFree Forum:**
https://forum.infinityfree.net

**InfinityFree Knowledge Base:**
https://infinityfree.net/support

**YouTube Tutorial:**
Cari: "infinityfree laravel tutorial"

---

## 🎉 SELAMAT!

Aplikasi perpustakaan Anda sudah online dan bisa diakses dari mana saja!

Bagikan URL website Anda ke teman-teman! 🚀

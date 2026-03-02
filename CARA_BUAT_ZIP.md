# 📦 Cara Membuat File perpus.zip

## ❗ PENTING
File `perpus.zip` TIDAK OTOMATIS ADA. Anda harus membuatnya sendiri dari folder perpus.

---

## 🪟 CARA 1: Windows (Paling Mudah)

### Metode A: Menggunakan Windows Explorer

1. **Buka File Explorer**
   - Tekan `Windows + E`
   - Atau klik icon folder di taskbar

2. **Navigasi ke Folder**
   - Pergi ke lokasi folder `perpus`
   - Contoh: `C:\autodidak\perpus`
   - Anda harus berada di folder PARENT (autodidak), bukan di dalam folder perpus

3. **Klik Kanan pada Folder perpus**
   - Klik kanan pada folder `perpus`
   - Pilih **"Send to"** → **"Compressed (zipped) folder"**

4. **Tunggu Proses**
   - Windows akan membuat file `perpus.zip`
   - Tunggu sampai selesai (tergantung ukuran folder)
   - File `perpus.zip` akan muncul di lokasi yang sama

5. **Selesai!**
   - File `perpus.zip` sudah siap untuk diupload

### Metode B: Menggunakan WinRAR (Jika Terinstall)

1. **Klik Kanan pada Folder perpus**
2. Pilih **"Add to perpus.zip"** atau **"Add to archive..."**
3. Jika pilih "Add to archive":
   - Archive name: `perpus.zip`
   - Archive format: `ZIP`
   - Klik **OK**
4. Tunggu sampai selesai

### Metode C: Menggunakan 7-Zip (Jika Terinstall)

1. **Klik Kanan pada Folder perpus**
2. Pilih **7-Zip** → **"Add to perpus.zip"**
3. Tunggu sampai selesai

---

## 💻 CARA 2: Menggunakan Command Line (PowerShell)

### Windows PowerShell:

```powershell
# Masuk ke folder parent
cd C:\autodidak

# Buat zip file
Compress-Archive -Path perpus -DestinationPath perpus.zip

# Atau jika sudah ada, replace:
Compress-Archive -Path perpus -DestinationPath perpus.zip -Force
```

### Command Prompt (CMD):

```cmd
# Masuk ke folder parent
cd C:\autodidak

# Buat zip menggunakan PowerShell dari CMD
powershell Compress-Archive -Path perpus -DestinationPath perpus.zip
```

---

## 🍎 CARA 3: Mac OS

### Menggunakan Finder:

1. Buka **Finder**
2. Navigasi ke folder yang berisi folder `perpus`
3. **Klik kanan** pada folder `perpus`
4. Pilih **"Compress perpus"**
5. File `perpus.zip` akan dibuat

### Menggunakan Terminal:

```bash
# Masuk ke folder parent
cd /path/to/parent/folder

# Buat zip
zip -r perpus.zip perpus
```

---

## 🐧 CARA 4: Linux

### Menggunakan File Manager:

1. Buka File Manager
2. Klik kanan pada folder `perpus`
3. Pilih **"Compress"** atau **"Create Archive"**
4. Pilih format **ZIP**
5. Nama: `perpus.zip`
6. Klik **Create**

### Menggunakan Terminal:

```bash
# Masuk ke folder parent
cd /path/to/parent/folder

# Buat zip
zip -r perpus.zip perpus

# Atau menggunakan tar (alternatif)
tar -czf perpus.tar.gz perpus
```

---

## ⚠️ PENTING - Exclude Folder Besar

Untuk mengurangi ukuran file zip, exclude folder yang tidak perlu:

### Folder yang TIDAK PERLU di-zip:
- `node_modules/` (sangat besar!)
- `.git/` (tidak perlu)
- `storage/logs/*.log` (file log)
- `vendor/` (bisa di-install ulang dengan composer)

### Cara Exclude (Manual):

**Jika menggunakan WinRAR/7-Zip:**
1. Saat membuat archive, klik **"Files to exclude"**
2. Tambahkan: `node_modules`, `.git`, `storage/logs`

**Jika menggunakan Command Line:**

```powershell
# PowerShell - Exclude folders
$exclude = @('node_modules', '.git', 'storage/logs')
Get-ChildItem -Path perpus -Exclude $exclude | Compress-Archive -DestinationPath perpus.zip
```

```bash
# Linux/Mac - Exclude folders
zip -r perpus.zip perpus -x "perpus/node_modules/*" "perpus/.git/*" "perpus/storage/logs/*"
```

---

## 📊 Cek Ukuran File

### Ukuran Normal:
- **Dengan vendor:** 50-100 MB
- **Tanpa vendor:** 5-10 MB
- **Tanpa vendor & node_modules:** 2-5 MB

### Jika File Terlalu Besar (>100MB):

**Opsi 1: Upload Tanpa vendor**
1. Hapus folder `vendor` dari zip
2. Setelah upload, install via SSH:
   ```bash
   cd perpus
   composer install --no-dev
   ```

**Opsi 2: Upload Per Folder**
- Upload folder `app`, `public`, `resources`, dll secara terpisah
- Jangan zip, upload langsung

**Opsi 3: Gunakan FTP**
- Download FileZilla
- Upload semua file via FTP (tidak perlu zip)

---

## ✅ Verifikasi File Zip

Setelah membuat perpus.zip, cek:

1. **Ukuran File:**
   - Klik kanan `perpus.zip` → Properties
   - Lihat ukuran file

2. **Isi File:**
   - Double-click `perpus.zip`
   - Pastikan ada folder `perpus` di dalamnya
   - Di dalam folder `perpus` ada: `app`, `public`, `resources`, dll

3. **Test Extract:**
   - Extract ke folder lain
   - Pastikan semua file lengkap

---

## 🚀 Setelah Membuat perpus.zip

File `perpus.zip` siap untuk:
1. ✅ Upload ke InfinityFree
2. ✅ Upload ke hosting lain
3. ✅ Backup
4. ✅ Share ke orang lain

**Lokasi file:** Di folder yang sama dengan folder `perpus`

Contoh:
```
C:\autodidak\
├── perpus\          (folder asli)
└── perpus.zip       (file zip yang baru dibuat)
```

---

## 🆘 Troubleshooting

### "File too large" saat upload

**Solusi:**
1. Exclude `vendor` dan `node_modules`
2. Upload per folder
3. Gunakan FTP

### Zip corrupt/error

**Solusi:**
1. Buat ulang file zip
2. Gunakan software berbeda (WinRAR/7-Zip)
3. Cek disk space cukup

### Tidak bisa buat zip

**Solusi:**
1. Install WinRAR: https://www.win-rar.com
2. Install 7-Zip: https://www.7-zip.org
3. Gunakan command line

---

## 💡 Tips

1. **Buat zip di folder parent**, bukan di dalam folder perpus
2. **Cek ukuran** sebelum upload
3. **Test extract** untuk memastikan tidak corrupt
4. **Backup** file zip untuk jaga-jaga

---

**Setelah membuat perpus.zip, lanjutkan ke panduan upload di:**
- `INFINITYFREE_STEP_BY_STEP.md`
- `CHECKLIST_UPLOAD.txt`

🎉 Selamat membuat file zip!

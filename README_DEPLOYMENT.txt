================================================================================
                    PANDUAN UPLOAD APLIKASI PERPUSTAKAAN
================================================================================

📋 RINGKASAN CEPAT:

1. Beli hosting & domain
2. Upload file via cPanel File Manager
3. Pindahkan isi folder public ke public_html
4. Buat database di cPanel
5. Import database.sql
6. Edit file .env
7. Set permissions folder storage & bootstrap/cache
8. Akses website Anda!

================================================================================

📁 FILE PENTING:

- QUICK_DEPLOY.md       → Panduan lengkap untuk pemula (BACA INI DULU!)
- DEPLOYMENT_GUIDE.md   → Panduan detail semua metode deployment
- database.sql          → File database untuk diimport
- .env.example          → Template konfigurasi
- deploy.sh             → Script otomatis untuk VPS

================================================================================

🌐 REKOMENDASI HOSTING:

Shared Hosting (Pemula):
- Niagahoster: www.niagahoster.co.id (Mulai Rp 20rb/bulan)
- Hostinger: www.hostinger.co.id (Mulai Rp 25rb/bulan)
- Rumahweb: www.rumahweb.com (Mulai Rp 30rb/bulan)

VPS (Advanced):
- DigitalOcean: www.digitalocean.com ($5/bulan)
- Vultr: www.vultr.com ($5/bulan)

================================================================================

🔑 LOGIN DEFAULT:

Email: admin@perpus.com
Password: password

⚠️ PENTING: Ganti password setelah login pertama!

================================================================================

✅ CHECKLIST SEBELUM UPLOAD:

[ ] Sudah punya hosting & domain
[ ] Hosting support PHP 8.0+
[ ] Hosting ada MySQL/MariaDB
[ ] File sudah di-zip
[ ] Sudah baca QUICK_DEPLOY.md

================================================================================

📞 BANTUAN:

Jika ada masalah:
1. Baca file QUICK_DEPLOY.md bagian Troubleshooting
2. Cek error di perpus/storage/logs/laravel.log
3. Hubungi support hosting Anda
4. Cari tutorial di YouTube: "Upload Laravel ke cPanel"

================================================================================

🎉 SELAMAT MENCOBA!

Aplikasi perpustakaan Anda akan segera online!

================================================================================

# Sistem Perpustakaan

Aplikasi manajemen perpustakaan berbasis Laravel untuk mengelola buku, anggota, dan transaksi peminjaman.

## Fitur

- **Manajemen Buku**: CRUD buku dengan kategori, stok, dan ketersediaan
- **Manajemen Anggota**: Kelola data anggota perpustakaan
- **Manajemen Kategori**: Organisasi buku berdasarkan kategori
- **Transaksi Peminjaman**: Catat peminjaman dan pengembalian buku
- **Sistem Denda**: Hitung denda keterlambatan
- **Dashboard**: Statistik dan laporan
- **REST API**: API lengkap dengan autentikasi Sanctum

## Instalasi

1. **Install Dependencies**
```bash
composer install
npm install
```

2. **Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Setup Database**
- Buat database `perpus_app` di MySQL/phpMyAdmin
- Import file `database.sql` atau jalankan:
```bash
php artisan migrate
```

4. **Jalankan Aplikasi**
```bash
php artisan serve
```

Akses aplikasi di: http://localhost:8000

## Login Default

- Email: `admin@perpus.com`
- Password: `password`

## Struktur Database

### Tabel Users
- Admin dan staff perpustakaan
- Role: admin, staff

### Tabel Members
- Data anggota perpustakaan
- Status: active, inactive

### Tabel Categories
- Kategori buku

### Tabel Books
- Data buku dengan stok dan ketersediaan
- Relasi ke categories

### Tabel Borrowings
- Transaksi peminjaman
- Status: borrowed, returned, overdue
- Sistem denda otomatis

## API Endpoints

### Authentication
- `POST /api/register` - Register user baru
- `POST /api/login` - Login dan dapatkan token
- `POST /api/logout` - Logout

### Books
- `GET /api/books` - List semua buku
- `POST /api/books` - Tambah buku baru
- `GET /api/books/{id}` - Detail buku
- `PUT /api/books/{id}` - Update buku
- `DELETE /api/books/{id}` - Hapus buku
- `GET /api/books/search/{keyword}` - Cari buku

### Members
- `GET /api/members` - List semua anggota
- `POST /api/members` - Tambah anggota
- `GET /api/members/{id}` - Detail anggota
- `PUT /api/members/{id}` - Update anggota
- `DELETE /api/members/{id}` - Hapus anggota
- `GET /api/members/search/{keyword}` - Cari anggota
- `PATCH /api/members/{id}/status` - Update status

### Categories
- `GET /api/categories` - List kategori
- `POST /api/categories` - Tambah kategori
- `GET /api/categories/{id}` - Detail kategori
- `PUT /api/categories/{id}` - Update kategori
- `DELETE /api/categories/{id}` - Hapus kategori

### Borrowings
- `GET /api/borrowings` - List peminjaman
- `POST /api/borrowings` - Tambah peminjaman
- `GET /api/borrowings/{id}` - Detail peminjaman
- `PUT /api/borrowings/{id}` - Update peminjaman
- `DELETE /api/borrowings/{id}` - Hapus peminjaman
- `POST /api/borrowings/{id}/return` - Kembalikan buku
- `GET /api/borrowings/member/{id}` - Peminjaman per anggota
- `GET /api/borrowings/overdue/list` - List keterlambatan
- `GET /api/statistics/dashboard` - Statistik dashboard

## Penggunaan API

Semua endpoint API (kecuali login/register) memerlukan autentikasi Bearer Token.

**Contoh Request:**
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Content-Type: application/json" \
     http://localhost:8000/api/books
```

## Web Routes

- `/` - Halaman utama
- `/login` - Login
- `/dashboard` - Dashboard (auth required)
- `/books` - Manajemen buku
- `/members` - Manajemen anggota
- `/categories` - Manajemen kategori
- `/borrowings` - Manajemen peminjaman
- `/reports/borrowings` - Laporan peminjaman
- `/reports/overdue` - Laporan keterlambatan

## Teknologi

- Laravel 9.x
- MySQL
- Bootstrap 5
- Bootstrap Icons
- Laravel Sanctum (API Authentication)

## Lisensi

Open source untuk keperluan edukasi.

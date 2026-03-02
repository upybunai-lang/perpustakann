<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }
        .container {
            position: relative;
            z-index: 2;
        }
        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: none;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        h1, .lead {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .text-primary {
            color: #667eea !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-8 text-center">
                <i class="bi bi-book-fill text-white" style="font-size: 5rem; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.5));"></i>
                <h1 class="mt-4 mb-3">Sistem Perpustakaan</h1>
                <p class="lead text-muted mb-4">
                    Aplikasi manajemen perpustakaan untuk mengelola buku, anggota, dan peminjaman
                </p>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5">
                        <i class="bi bi-person-plus"></i> Daftar Akun
                    </a>
                </div>

                <div class="row mt-5 g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-book text-primary" style="font-size: 2.5rem;"></i>
                                <h5 class="card-title mt-3">Manajemen Buku</h5>
                                <p class="card-text text-muted">Kelola koleksi buku perpustakaan dengan mudah</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-people text-success" style="font-size: 2.5rem;"></i>
                                <h5 class="card-title mt-3">Data Anggota</h5>
                                <p class="card-text text-muted">Kelola data anggota perpustakaan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-arrow-repeat text-warning" style="font-size: 2.5rem;"></i>
                                <h5 class="card-title mt-3">Peminjaman</h5>
                                <p class="card-text text-muted">Catat dan kelola transaksi peminjaman</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-muted small">
                    <p>Default login: admin@perpus.com / password</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

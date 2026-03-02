@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBooks }}</h2>
                    </div>
                    <i class="bi bi-book-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $availableBooks }}</h2>
                    </div>
                    <i class="bi bi-check-circle-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Anggota Aktif</h6>
                        <h2 class="mb-0">{{ $totalMembers }}</h2>
                    </div>
                    <i class="bi bi-people-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Sedang Dipinjam</h6>
                        <h2 class="mb-0">{{ $activeBorrowings }}</h2>
                    </div>
                    <i class="bi bi-arrow-repeat" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@if($overdueBorrowings > 0)
<div class="alert alert-danger">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>Perhatian!</strong> Ada {{ $overdueBorrowings }} peminjaman yang terlambat.
    <a href="{{ route('reports.overdue') }}" class="alert-link">Lihat detail</a>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Peminjaman Terbaru</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBorrowings as $borrowing)
                    <tr>
                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                        <td>{{ $borrowing->member->name }}</td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                        <td>
                            @if($borrowing->status === 'borrowed')
                                <span class="badge bg-warning">Dipinjam</span>
                            @elseif($borrowing->status === 'returned')
                                <span class="badge bg-success">Dikembalikan</span>
                            @else
                                <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                        <td>{{ $borrowing->user->name ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

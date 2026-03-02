@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Laporan Peminjaman</h2>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('reports.borrowings') }}" class="row g-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date" 
                       value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" id="end_date" name="end_date" 
                       value="{{ request('end_date', now()->endOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pinjam</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Jatuh Tempo</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $index => $borrowing)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                        <td>{{ $borrowing->member->name }}</td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                        <td>{{ $borrowing->return_date?->format('d/m/Y') ?? '-' }}</td>
                        <td>
                            @if($borrowing->status === 'borrowed')
                                <span class="badge bg-warning">Dipinjam</span>
                            @elseif($borrowing->status === 'returned')
                                <span class="badge bg-success">Dikembalikan</span>
                            @else
                                <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-end">Total Denda:</th>
                        <th>Rp {{ number_format($borrowings->sum('fine'), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-3">
            <button onclick="window.print()" class="btn btn-secondary">
                <i class="bi bi-printer"></i> Cetak Laporan
            </button>
        </div>
    </div>
</div>
@endsection

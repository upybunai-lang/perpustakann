@extends('layouts.app')

@section('title', 'Laporan Keterlambatan')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Laporan Keterlambatan</h2>
        <p class="text-muted">Daftar peminjaman yang melewati jatuh tempo</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Terlambat</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $index => $borrowing)
                    @php
                        $daysLate = now()->diffInDays($borrowing->due_date);
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            {{ $borrowing->member->name }}<br>
                            <small class="text-muted">{{ $borrowing->member->member_code }}</small>
                        </td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                        <td>
                            <span class="text-danger">
                                {{ $borrowing->due_date->format('d/m/Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-danger">
                                {{ $daysLate }} hari
                            </span>
                        </td>
                        <td>
                            @if($borrowing->member->phone)
                                <i class="bi bi-telephone"></i> {{ $borrowing->member->phone }}<br>
                            @endif
                            @if($borrowing->member->email)
                                <i class="bi bi-envelope"></i> {{ $borrowing->member->email }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-success">
                            <i class="bi bi-check-circle"></i> Tidak ada keterlambatan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($borrowings->count() > 0)
        <div class="mt-3">
            <button onclick="window.print()" class="btn btn-secondary">
                <i class="bi bi-printer"></i> Cetak Laporan
            </button>
        </div>
        @endif
    </div>
</div>
@endsection

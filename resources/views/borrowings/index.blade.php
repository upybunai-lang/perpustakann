@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Daftar Peminjaman</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Peminjaman
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Jatuh Tempo</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $borrowing)
                    <tr>
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
                        <td>
                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($borrowing->status === 'borrowed')
                                <button type="button" class="btn btn-sm btn-success" 
                                        data-bs-toggle="modal" data-bs-target="#returnModal{{ $borrowing->id }}">
                                    <i class="bi bi-arrow-return-left"></i>
                                </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Return Modal -->
                    <div class="modal fade" id="returnModal{{ $borrowing->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Kembalikan Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Kembali</label>
                                            <input type="date" class="form-control" name="return_date" 
                                                   value="{{ date('Y-m-d') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Denda (Rp)</label>
                                            <input type="number" class="form-control" name="fine" 
                                                   value="0" min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan</label>
                                            <textarea class="form-control" name="notes" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Kembalikan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data peminjaman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $borrowings->links() }}
        </div>
    </div>
</div>
@endsection

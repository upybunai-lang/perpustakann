@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Peminjaman</h5>
                <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Anggota</th>
                        <td>{{ $borrowing->member->name }} ({{ $borrowing->member->member_code }})</td>
                    </tr>
                    <tr>
                        <th>Buku</th>
                        <td>{{ $borrowing->book->title }}</td>
                    </tr>
                    <tr>
                        <th>Penulis</th>
                        <td>{{ $borrowing->book->author }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jatuh Tempo</th>
                        <td>{{ $borrowing->due_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td>{{ $borrowing->return_date?->format('d/m/Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($borrowing->status === 'borrowed')
                                <span class="badge bg-warning">Dipinjam</span>
                            @elseif($borrowing->status === 'returned')
                                <span class="badge bg-success">Dikembalikan</span>
                            @else
                                <span class="badge bg-danger">Terlambat</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Denda</th>
                        <td>Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Petugas</th>
                        <td>{{ $borrowing->user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td>{{ $borrowing->notes ?? '-' }}</td>
                    </tr>
                </table>

                @if($borrowing->status === 'borrowed')
                <div class="mt-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#returnModal">
                        <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                    </button>
                </div>

                <!-- Return Modal -->
                <div class="modal fade" id="returnModal" tabindex="-1">
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
                                        <textarea class="form-control" name="notes" rows="2">{{ $borrowing->notes }}</textarea>
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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Anggota</h5>
                <div>
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('members.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Anggota</th>
                        <td>{{ $member->member_code }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $member->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $member->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $member->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $member->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Daftar</th>
                        <td>{{ $member->join_date->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge {{ $member->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $member->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                </table>

                <h6 class="mt-4">Riwayat Peminjaman</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jatuh Tempo</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($member->borrowings as $borrowing)
                            <tr>
                                <td>{{ $borrowing->book->title }}</td>
                                <td>{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
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
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada riwayat peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

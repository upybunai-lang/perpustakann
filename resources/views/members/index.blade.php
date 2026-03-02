@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Daftar Anggota</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('members.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Anggota
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr>
                        <td>{{ $member->member_code }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email ?? '-' }}</td>
                        <td>{{ $member->phone ?? '-' }}</td>
                        <td>{{ $member->join_date->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $member->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $member->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data anggota</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $members->links() }}
        </div>
    </div>
</div>
@endsection

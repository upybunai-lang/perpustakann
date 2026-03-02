@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Buku</h5>
                <div>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">ISBN</th>
                        <td>{{ $book->isbn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <th>Penulis</th>
                        <td>{{ $book->author }}</td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>{{ $book->publisher ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>{{ $book->publish_year ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $book->category->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $book->stock }}</td>
                    </tr>
                    <tr>
                        <th>Tersedia</th>
                        <td>
                            <span class="badge {{ $book->available > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $book->available }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $book->description ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

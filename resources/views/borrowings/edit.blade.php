@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Peminjaman</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Anggota <span class="text-danger">*</span></label>
                        <select class="form-select @error('member_id') is-invalid @enderror" 
                                id="member_id" name="member_id" required>
                            <option value="">Pilih Anggota</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" 
                                        {{ old('member_id', $borrowing->member_id) == $member->id ? 'selected' : '' }}>
                                    {{ $member->member_code }} - {{ $member->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="book_id" class="form-label">Buku <span class="text-danger">*</span></label>
                        <select class="form-select @error('book_id') is-invalid @enderror" 
                                id="book_id" name="book_id" required>
                            <option value="">Pilih Buku</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" 
                                        {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} - {{ $book->author }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="borrow_date" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('borrow_date') is-invalid @enderror" 
                                       id="borrow_date" name="borrow_date" 
                                       value="{{ old('borrow_date', $borrowing->borrow_date->format('Y-m-d')) }}" required>
                                @error('borrow_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Jatuh Tempo <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                       id="due_date" name="due_date" 
                                       value="{{ old('due_date', $borrowing->due_date->format('Y-m-d')) }}" required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="3">{{ old('notes', $borrowing->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Tambah Peminjaman')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Tambah Peminjaman</h5>
                <p class="text-muted small mb-0">Catat peminjaman buku baru</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('borrowings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-muted">Peminjam <span class="text-danger">*</span></label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">Pilih peminjam</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Buku <span class="text-danger">*</span></label>
                        <select name="book_id" class="form-select @error('book_id') is-invalid @enderror">
                            <option value="">Pilih buku</option>
                            @foreach($books as $book)
                                @if($book->stock > 0)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}
                                    {{ $book->stock == 0 ? 'disabled' : '' }}>
                                    {{ $book->title }} (Stok: {{ $book->stock }})
                                </option>
                                @endif
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-muted">Durasi Pinjam (hari)</label>
                        <input type="number" name="days" min="1"
                            class="form-control @error('days') is-invalid @enderror"
                            placeholder="Default: 7 hari"
                            value="{{ old('days', 7) }}">
                        @error('days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background:#3d2b1f;">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
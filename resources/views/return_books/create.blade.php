@extends('layouts.app')
@section('title', 'Tambah Pengembalian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('return_books.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Tambah Pengembalian</h5>
                <p class="text-muted small mb-0">Catat pengembalian buku</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('return_books.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-muted">Data Peminjaman <span class="text-danger">*</span></label>
                        <select name="borrowing_id" class="form-select @error('borrowing_id') is-invalid @enderror">
                            <option value="">Pilih peminjaman</option>
                            @foreach($borrowings as $borrowing)
                                <option value="{{ $borrowing->id }}"
                                    {{ old('borrowing_id', request('borrowing_id')) == $borrowing->id ? 'selected' : '' }}>
                                    {{ $borrowing->user->name }} - {{ $borrowing->book->title }}
                                    ({{ $borrowing->borrow_date->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('borrowing_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-muted">Kondisi Buku <span class="text-danger">*</span></label>
                        <select name="condition" class="form-select @error('condition') is-invalid @enderror">
                            <option value="">Pilih kondisi</option>
                            <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Baik</option>
                            <option value="damaged" {{ old('condition') == 'damaged' ? 'selected' : '' }}>Rusak</option>
                        </select>
                        @error('condition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background:#3d2b1f;">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                        <a href="{{ route('return_books.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
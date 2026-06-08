@extends('layouts.app')
@section('title', 'Tambah Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Tambah Buku</h5>
                <p class="text-muted small mb-0">Tambahkan koleksi buku baru</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small text-muted">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Contoh: Belajar Laravel 10"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Pilih kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Penulis <span class="text-danger">*</span></label>
                            <select name="author_id" class="form-select @error('author_id') is-invalid @enderror">
                                <option value="">Pilih penulis</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">ISBN <span class="text-danger">*</span></label>
                            <input type="text" name="isbn"
                                class="form-control @error('isbn') is-invalid @enderror"
                                placeholder="Contoh: 978-602-123-456"
                                value="{{ old('isbn') }}">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" name="publisher"
                                class="form-control @error('publisher') is-invalid @enderror"
                                placeholder="Contoh: Gramedia"
                                value="{{ old('publisher') }}">
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" name="publication_year"
                                class="form-control @error('publication_year') is-invalid @enderror"
                                placeholder="Contoh: 2024"
                                value="{{ old('publication_year') }}">
                            @error('publication_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stock" min="0"
                                class="form-control @error('stock') is-invalid @enderror"
                                placeholder="Contoh: 10"
                                value="{{ old('stock', 0) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="mb-4">
                            <label class="form-label small text-muted">Cover Buku</label>
                            <input type="file" name="cover" 
                                class="form-control @error('cover') is-invalid @enderror"
                                accept="image/jpg, image/jpeg, image/png">
                            @error('cover')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: jpg, jpeg, png. Maksimal 2MB. (Opsional)</div>
                        </div>
                        <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background:#3d2b1f;">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
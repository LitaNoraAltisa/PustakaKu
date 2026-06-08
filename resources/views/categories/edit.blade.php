@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Edit Kategori</h5>
                <p class="text-muted small mb-0">Ubah data kategori buku</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Contoh: Fiksi Ilmiah"
                            value="{{ old('name', $category->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-muted">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Deskripsi kategori (opsional)">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background:#3d2b1f;">
                            <i class="bi bi-check-lg me-1"></i> Update
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Edit Penulis')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('authors.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Edit Penulis</h5>
                <p class="text-muted small mb-0">Ubah data penulis buku</p>
            </div>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('authors.update', $author->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label small text-muted">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Contoh: J.K. Rowling"
                            value="{{ old('name', $author->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label small text-muted">Biografi</label>
                        <textarea name="biography" rows="4"
                            class="form-control @error('biography') is-invalid @enderror"
                            placeholder="Biografi singkat penulis (opsional)">{{ old('biography', $author->biography) }}</textarea>
                        @error('biography')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn text-white" style="background:#3d2b1f;">
                            <i class="bi bi-check-lg me-1"></i> Update
                        </button>
                        <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
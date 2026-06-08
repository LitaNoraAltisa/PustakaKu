@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', $book->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Detail Buku</h5>
                <p class="text-muted small mb-0">Informasi lengkap buku</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="d-flex gap-3">
                        @if($book->cover)
                            <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}"
                                class="img-thumbnail" style="max-height:120px; max-width:90px;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                style="width:90px; height:120px;">
                                <i class="bi bi-book fs-2 text-muted"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="fw-semibold mb-1">{{ $book->title }}</h5>
                            <p class="text-muted small mb-0">{{ $book->author->name }}</p>
                        </div>
                    </div>
                    @if($book->stock > 0)
                        <span class="badge rounded-pill" style="background:#EAF3DE; color:#27500A;">Tersedia</span>
                    @else
                        <span class="badge rounded-pill" style="background:#FCEBEB; color:#791F1F;">Habis</span>
                    @endif
                </div>

                <hr class="my-3">

                {{-- Detail --}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">Kategori</div>
                        <div class="fw-semibold">{{ $book->category->name }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">ISBN</div>
                        <div class="fw-semibold">{{ $book->isbn }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">Penerbit</div>
                        <div class="fw-semibold">{{ $book->publisher }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">Tahun Terbit</div>
                        <div class="fw-semibold">{{ $book->publication_year }}</div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small mb-1">Stok</div>
                        <div class="fw-semibold">{{ $book->stock }} buku</div>
                    </div>
                </div>

                <hr class="my-3">

                {{-- Aksi --}}
                <div class="d-flex gap-2">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FCEBEB; color:#791F1F; border:none;">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', 'Dashboard Member')

@section('content')

{{-- Header --}}
<div class="mb-5 overflow-hidden" style="background: #3d2b1f; border-radius:16px; border: 3px solid #854F0B;">
    <div class="p-4 p-md-5" style="position:relative;">

        {{-- Dekorasi lingkaran --}}
        <div style="position:absolute; top:-40px; right:-40px; width:200px; height:200px;
            background:rgba(133,79,11,0.2); border-radius:50%;"></div>
        <div style="position:absolute; bottom:-60px; right:80px; width:150px; height:150px;
            background:rgba(133,79,11,0.15); border-radius:50%;"></div>

        <div class="row align-items-center" style="position:relative; z-index:2;">
            <div class="col-lg-7">
                <span class="badge mb-3 px-3 py-2" style="background: #854F0B; color: #f5e6d3; font-size:12px;">
                    <i class="bi bi-book me-1"></i> Dashboard Member
                </span>
                <h2 class="fw-semibold mb-2" style="color: #f5e6d3;">
                    Halo, {{ auth()->user()->name }}
                </h2>
                <p class="mb-4" style="color: #c4a882; max-width:480px; font-size:14px; line-height:1.6;">
                    Temukan buku favoritmu, jelajahi berbagai kategori, dan nikmati pengalaman membaca yang menyenangkan di PustakaKu.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <div class="rounded-3 px-3 py-2" style="background:rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
                        <small style="color: #c4a882; display:block; font-size:11px;">Total Buku</small>
                        <strong style="color: #f5e6d3; font-size:18px;">{{ $books->count() }}</strong>
                    </div>
                    <div class="rounded-3 px-3 py-2" style="background:#854F0B;">
                        <small style="color: #f5e6d3; display:block; font-size:11px; opacity:0.8;">Platform</small>
                        <strong style="color:#f5e6d3; font-size:14px;">Perpustakaan Digital</strong>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                <div style="position:relative; text-align:center;">
                    <div style="width:140px; height:140px; background:rgba(133,79,11,0.3);
                        border-radius:50%; display:flex; align-items:center; justify-content:center;
                        border: 2px solid rgba(133,79,11,0.5);">
                        <i class="bi bi-book-half" style="font-size:5rem; color:rgba(245,230,211,0.6);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Header Koleksi Buku --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-semibold mb-1">
            <i class="bi bi-collection me-2" style="color: #854F0B;"></i>Koleksi Buku
        </h5>
        <p class="text-muted small mb-0">Temukan buku yang ingin kamu baca</p>
    </div>
    <span class="badge rounded-pill px-3 py-2" style="background: #FAEEDA; color: #633806;">
        {{ $books->count() }} Buku tersedia
    </span>
</div>

{{-- Koleksi Buku Per Kategori --}}
@foreach($booksByCategory as $categoryName => $categoryBooks)
<div class="mb-5">

    {{-- Header Kategori --}}
    <div class="d-flex align-items-center gap-2 mb-3">
        <span class="badge rounded-pill px-3 py-2" style="background: #FAEEDA; color: #633806; font-size:13px;">
            <i class="bi bi-tag me-1"></i>{{ $categoryName }}
        </span>
        <small class="text-muted">{{ $categoryBooks->count() }} buku</small>
    </div>

    {{-- Grid Buku --}}
    <div class="row g-3">
        @foreach($categoryBooks as $book)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 book-card">
                @if($book->cover)
                    <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}"
                        class="card-img-top" style="height:220px; object-fit:contain; padding:12px; border-bottom:1px solid #e9ecef;">
                @else
                    <div class="d-flex align-items-center justify-content-center"
                        style="height:220px; background: #f8f4ee;">
                        <i class="bi bi-book" style="font-size:3rem; color: #c4a882;"></i>
                    </div>
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        @if($book->isAvailable())
                            <span class="badge rounded-pill" style="background: #EAF3DE; color:#27500A; font-size:11px;">Tersedia</span>
                        @else
                            <span class="badge rounded-pill" style="background: #FCEBEB; color:#791F1F; font-size:11px;">Habis</span>
                        @endif
                    </div>
                    <h6 class="fw-semibold mb-1">{{ $book->title }}</h6>
                    <p class="text-muted small mb-2">{{ $book->author->name }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Stok: {{ $book->stock }}</small>
                        <a href="{{ route('books.show', $book->slug) }}" class="btn btn-sm"
                            style="background:#3d2b1f; color:#f5e6d3;">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach

{{-- Kalau tidak ada buku --}}
@if($books->isEmpty())
<div class="text-center text-muted py-5">
    <i class="bi bi-book fs-1 d-block mb-2"></i>
    Belum ada buku tersedia.
</div>
@endif

<style>
    .book-card{
        transition: all .3s ease;
    }

    .book-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 .75rem 1.5rem rgba(0,0,0,.15) !important;
    }
</style>
@endsection

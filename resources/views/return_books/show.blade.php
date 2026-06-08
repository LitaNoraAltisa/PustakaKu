@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', 'Detail Pengembalian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('return_books.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Detail Pengembalian</h5>
                <p class="text-muted small mb-0">Informasi lengkap data pengembalian</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-semibold mb-0">Pengembalian #{{ $return->id }}</h6>
                    @if($return->condition === 'good')
                        <span class="badge rounded-pill" style="background:#EAF3DE; color:#27500A;">Kondisi Baik</span>
                    @else
                        <span class="badge rounded-pill" style="background:#FAEEDA; color:#633806;">Kondisi Rusak</span>
                    @endif
                </div>

                <hr class="my-3">

                {{-- Data Peminjam --}}
                <div class="mb-3">
                    <div class="text-muted small fw-semibold mb-2">DATA PEMINJAM</div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Nama</div>
                            <div class="fw-semibold">{{ $return->borrowing->user->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Email</div>
                            <div class="fw-semibold">{{ $return->borrowing->user->email }}</div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                {{-- Data Buku --}}
                <div class="mb-3">
                    <div class="text-muted small fw-semibold mb-2">DATA BUKU</div>
                    <div class="row g-2">
                        {{-- Cover Buku --}}
                        @if($return->borrowing->book->cover)
                        <div class="col-md-12 mb-2">
                            <img src="{{ Storage::url($return->borrowing->book->cover) }}"
                                alt="{{ $return->borrowing->book->title }}"
                                class="img-thumbnail" style="max-height:120px; object-fit:contain;">
                        </div>
                        @endif
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Judul</div>
                            <div class="fw-semibold">{{ $return->borrowing->book->title }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Penulis</div>
                            <div class="fw-semibold">{{ $return->borrowing->book->author->name }}</div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                {{-- Data Pengembalian --}}
                <div class="mb-4">
                    <div class="text-muted small fw-semibold mb-2">DATA PENGEMBALIAN</div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Tanggal Pinjam</div>
                            <div class="fw-semibold">{{ $return->borrowing->borrow_date->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Batas Kembali</div>
                            <div class="fw-semibold">{{ $return->borrowing->return_deadline->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Tanggal Kembali</div>
                            <div class="fw-semibold">{{ $return->return_date->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Kondisi</div>
                            <div class="fw-semibold">{{ $return->condition === 'good' ? 'Baik' : 'Rusak' }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Denda</div>
                        <div class="fw-semibold" @if($return->fine > 0) style="color:#A32D2D;" @endif>
                            {{ $return->fine > 0 ? 'Rp ' . number_format($return->fine, 0, ',', '.') : '-' }}
                        </div>
                        </div>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="d-flex gap-2">
                    <a href="{{ route('return_books.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
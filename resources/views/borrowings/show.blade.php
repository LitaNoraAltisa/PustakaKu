@extends('layouts.app')
@section('title', 'Detail Peminjaman')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('borrowings.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h5 class="fw-semibold mb-0">Detail Peminjaman</h5>
                <p class="text-muted small mb-0">Informasi lengkap data peminjaman</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                {{-- Status --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-semibold mb-0">Peminjaman #{{ $borrowing->id }}</h6>
                    @if($borrowing->status === 'borrowed')
                        <span class="badge rounded-pill" style="background: #1d61a0; color: #7c0c67;">Dipinjam</span>
                    @elseif($borrowing->status === 'returned')
                        <span class="badge rounded-pill" style="background: #8ad625; color: #e6ece3;">Dikembalikan</span>
                    @else
                        <span class="badge rounded-pill" style="background: #8a0c0c; color: #eb0c0c;">Terlambat</span>
                    @endif
                </div>

                <hr class="my-3">

                {{-- Data Peminjam --}}
                <div class="mb-3">
                    <div class="text-muted small fw-semibold mb-2">DATA PEMINJAM</div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Nama</div>
                            <div class="fw-semibold">{{ $borrowing->user->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small mb-1">Email</div>
                            <div class="fw-semibold">{{ $borrowing->user->email }}</div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                {{-- Data Buku --}}
                <div class="mb-3">
                    <div class="text-muted small fw-semibold mb-2">DATA BUKU</div>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $borrowing->book->cover) }}"
                                alt="{{ $borrowing->book->title }}"
                                class="img-fluid rounded shadow-sm">
                        </div>
                        <div class="col-md-9">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="text-muted small mb-1">Judul</div>
                                    <div class="fw-semibold">{{ $borrowing->book->title }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted small mb-1">Penulis</div>
                                    <div class="fw-semibold">{{ $borrowing->book->author->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Peminjaman --}}
                <div class="mb-4">
                    <div class="text-muted small fw-semibold mb-2">DATA PEMINJAMAN</div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Tanggal Pinjam</div>
                            <div class="fw-semibold">{{ $borrowing->borrow_date->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Batas Kembali</div>
                            <div class="fw-semibold">{{ $borrowing->return_deadline->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small mb-1">Tanggal Kembali</div>
                            <div class="fw-semibold">
                                @if($borrowing->returnBook)
                                    {{ $borrowing->returnBook->return_date->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Aksi --}}
                <div class="d-flex gap-2">
                    @if($borrowing->status === 'borrowed')
                        <a href="{{ route('return_books.create') }}?borrowing_id={{ $borrowing->id }}"
                            class="btn btn-sm text-white" style="background:#3d2b1f;">
                            <i class="bi bi-arrow-return-left me-1"></i> Kembalikan Buku
                        </a>
                    @endif
                    <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background:#FCEBEB; color:#791F1F; border:none;">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
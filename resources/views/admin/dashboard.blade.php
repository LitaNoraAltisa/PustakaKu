@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')

{{-- Header Banner --}}
<div class="mb-4 overflow-hidden" style="background:#3d2b1f; border-radius:16px; border: 3px solid #854F0B; position:relative;">
    <div class="p-4" style="position:relative; z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge mb-2 px-3 py-2" style="background:#854F0B; color:#f5e6d3; font-size:12px;">
                    <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                </span>
                <h4 class="fw-semibold mb-1" style="color:#f5e6d3;">Dashboard Admin</h4>
                <p class="mb-0" style="color:#c4a882; font-size:13px;">
                    Selamat datang kembali, <strong style="color:#f5e6d3;">{{ auth()->user()->name }}</strong>
                    — {{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                <div style="width:80px; height:80px; background:rgba(133,79,11,0.3);
                    border-radius:50%; display:flex; align-items:center; justify-content:center;
                    border: 2px solid rgba(133,79,11,0.5);">
                    <i class="bi bi-shield-check" style="font-size:2.5rem; color:rgba(245,230,211,0.6);"></i>
                </div>
            </div>
        </div>
    </div>
    {{-- Dekorasi --}}
    <div style="position:absolute; top:-30px; right:-30px; width:150px; height:150px;
        background:rgba(133,79,11,0.15); border-radius:50%; z-index:1;"></div>
</div>

{{-- Statistik Utama --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #FAEEDA !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-2" style="background:#FAEEDA;">
                    <i class="bi bi-book fs-4" style="color:#633806;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Buku</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_books'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #E1F5EE !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-2" style="background:#E1F5EE;">
                    <i class="bi bi-tags fs-4" style="color:#085041;"></i>
                </div>
                <div>
                    <div class="text-muted small">Kategori</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_categories'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #EEEDFE !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-2" style="background:#EEEDFE;">
                    <i class="bi bi-person-lines-fill fs-4" style="color:#3C3489;"></i>
                </div>
                <div>
                    <div class="text-muted small">Penulis</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_authors'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #FAECE7 !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-2" style="background:#FAECE7;">
                    <i class="bi bi-arrow-left-right fs-4" style="color:#712B13;"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Peminjaman</div>
                    <div class="fs-3 fw-semibold">{{ $stats['total_borrowings'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Peminjaman --}}
<div class="small fw-semibold text-muted mb-2">
    <i class="bi bi-bar-chart me-1"></i> Status Peminjaman
</div>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Sedang Dipinjam</div>
                        <div class="fs-3 fw-semibold" style="color:#185FA5;">{{ $stats['borrowed'] }}</div>
                    </div>
                    <div class="rounded-3 p-2" style="background:#E6F1FB;">
                        <i class="bi bi-book fs-4" style="color:#185FA5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Sudah Dikembalikan</div>
                        <div class="fs-3 fw-semibold" style="color:#3B6D11;">{{ $stats['returned'] }}</div>
                    </div>
                    <div class="rounded-3 p-2" style="background:#EAF3DE;">
                        <i class="bi bi-check-circle fs-4" style="color:#3B6D11;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small mb-1">Terlambat</div>
                        <div class="fs-3 fw-semibold" style="color:#A32D2D;">{{ $stats['overdue'] }}</div>
                    </div>
                    <div class="rounded-3 p-2" style="background:#FCEBEB;">
                        <i class="bi bi-exclamation-circle fs-4" style="color:#A32D2D;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Peminjaman Terbaru --}}
<div class="d-flex justify-content-between align-items-center mb-2">
    <div class="small fw-semibold text-muted">
        <i class="bi bi-clock me-1"></i> Peminjaman Terbaru
    </div>
    <a href="{{ route('borrowings.index') }}" class="small" style="color:#854F0B;">
        Lihat semua <i class="bi bi-arrow-right"></i>
    </a>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:14px; table-layout:fixed;">
            <thead class="table-light">
                <tr>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:20%;">PEMINJAM</th>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:25%;">BUKU</th>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:15%;">TGL PINJAM</th>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:15%;">BATAS KEMBALI</th>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:15%;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestBorrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->book->title }}</td>
                    <td>{{ $borrowing->borrow_date->format('d M Y') }}</td>
                    <td>{{ $borrowing->return_deadline->format('d M Y') }}</td>
                    <td>
                        @if($borrowing->status === 'borrowed')
                            <span class="badge rounded-pill" style="background:#E6F1FB; color: #8babcb;">Dipinjam</span>
                        @elseif($borrowing->status === 'returned')
                            <span class="badge rounded-pill" style="background:#EAF3DE; color: #132705;">Dikembalikan</span>
                        @else
                            <span class="badge rounded-pill" style="background:#FCEBEB; color: #791F1F;">Terlambat</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada data peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
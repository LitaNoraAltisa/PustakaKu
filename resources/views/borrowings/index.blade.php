@extends('layouts.app')
@section('title', 'Peminjaman')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4">
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h5 class="fw-semibold mb-1">
                <i class="bi bi-arrow-left-right me-2" style="color:#854F0B;"></i>Data Peminjaman
            </h5>
            <p class="text-muted small mb-0">Kelola data peminjaman buku perpustakaan</p>
        </div>
    </div>
    <a href="{{ route('borrowings.create') }}" class="btn text-white d-flex align-items-center gap-1" style="background:#3d2b1f;">
        <i class="bi bi-plus-lg"></i> Tambah Peminjaman
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Peminjaman</div>
                <div class="fs-4 fw-semibold">{{ $borrowings->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Sedang Dipinjam</div>
                <div class="fs-4 fw-semibold" style="color:#185FA5;">{{ $borrowings->where('status', 'borrowed')->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Dikembalikan</div>
                <div class="fs-4 fw-semibold" style="color:#3B6D11;">{{ $borrowings->where('status', 'returned')->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Terlambat</div>
                <div class="fs-4 fw-semibold" style="color:#A32D2D;">{{ $borrowings->where('status', 'overdue')->count() }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <input type="text" id="searchInput" class="form-control form-control-sm w-auto"
            placeholder="Cari peminjaman..." style="min-width:200px;">
        <span class="text-muted small">{{ $borrowings->count() }} peminjaman</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:14px;" id="borrowingTable">
            <thead class="table-light">
                <tr>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:50px;">NO</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">PEMINJAM</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">BUKU</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">TGL PINJAM</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">BATAS KEMBALI</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">STATUS</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $index => $borrowing)
                <tr>
                    <td class="text-muted">{{ $index + 1 }}</td>
                    <td>
                        <div class="fw-semibold">{{ $borrowing->user->name }}</div>
                        <div class="text-muted small">{{ $borrowing->user->email }}</div>
                    </td>
                    <td>{{ $borrowing->book->title }}</td>
                    <td>{{ $borrowing->borrow_date->format('d M Y') }}</td>
                    <td>{{ $borrowing->return_deadline->format('d M Y') }}</td>
                    <td>
                        @if($borrowing->status === 'borrowed')
                            <span class="badge rounded-pill" style="background:#E6F1FB; color:#0C447C;">Dipinjam</span>
                        @elseif($borrowing->status === 'returned')
                            <span class="badge rounded-pill" style="background:#EAF3DE; color:#27500A;">Dikembalikan</span>
                        @else
                            <span class="badge rounded-pill" style="background:#FCEBEB; color:#791F1F;">Terlambat</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('borrowings.show', $borrowing->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FCEBEB; color:#791F1F; border:none;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada data peminjaman.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#borrowingTable tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
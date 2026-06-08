@extends('layouts.app')
@section('title', 'Pengembalian Buku')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h5 class="fw-semibold mb-1">
            <i class="bi bi-arrow-return-left me-2" style="color:#854F0B;"></i>Data Pengembalian Buku
        </h5>
        <p class="text-muted small mb-0">Kelola data pengembalian buku perpustakaan</p>
    </div>
    <a href="{{ route('return_books.create') }}" class="btn text-white d-flex align-items-center gap-1" style="background:#3d2b1f;">
        <i class="bi bi-plus-lg"></i> Tambah Pengembalian
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Pengembalian</div>
                <div class="fs-4 fw-semibold">{{ $returns->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Ada Denda</div>
                <div class="fs-4 fw-semibold" style="color:#A32D2D;">{{ $returns->where('fine', '>', 0)->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Buku Rusak</div>
                <div class="fs-4 fw-semibold" style="color:#854F0B;">{{ $returns->where('condition', 'damaged')->count() }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <input type="text" id="searchInput" class="form-control form-control-sm w-auto"
            placeholder="Cari pengembalian..." style="min-width:200px;">
        <span class="text-muted small">{{ $returns->count() }} pengembalian</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:14px;" id="returnTable">
            <thead class="table-light">
                <tr>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:50px;">NO</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">PEMINJAM</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">BUKU</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">TGL KEMBALI</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">KONDISI</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">DENDA</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returns as $index => $return)
                <tr>
                    <td class="text-muted">{{ $index + 1 }}</td>
                    <td>
                        <div class="fw-semibold">{{ $return->borrowing->user->name }}</div>
                        <div class="text-muted small">{{ $return->borrowing->user->email }}</div>
                    </td>
                    <td>{{ $return->borrowing->book->title }}</td>
                    <td>{{ $return->return_date->format('d M Y') }}</td>
                    <td>
                        @if($return->condition === 'good')
                            <span class="badge rounded-pill" style="background:#EAF3DE; color:#27500A;">Baik</span>
                        @else
                            <span class="badge rounded-pill" style="background:#FAEEDA; color:#633806;">Rusak</span>
                        @endif
                    </td>
                    <td>
                        @if($return->fine > 0)
                            <span class="fw-semibold" style="color:#A32D2D;">
                                Rp {{ number_format($return->fine, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('return_books.show', $return->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada data pengembalian.
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
        document.querySelectorAll('#returnTable tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
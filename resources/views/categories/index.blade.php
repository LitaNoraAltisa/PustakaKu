@extends('layouts.app')
@section('title', 'Kategori')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h5 class="fw-semibold mb-1">
            <i class="bi bi-tags me-2" style="color:#854F0B;"></i>Kategori Buku
        </h5>
        <p class="text-muted small mb-0">Kelola kategori buku perpustakaan</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn text-white d-flex align-items-center gap-1" style="background:#3d2b1f;">
        <i class="bi bi-plus-lg"></i> Tambah Kategori
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Kategori</div>
                <div class="fs-4 fw-semibold">{{ $categories->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Buku</div>
                <div class="fs-4 fw-semibold">{{ $totalBooks }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="text-muted small mb-1">Kategori Terbanyak</div>
                <div class="fs-5 fw-semibold">{{ $topCategory ?: '-' }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <input type="text" id="searchInput" class="form-control form-control-sm w-auto" placeholder="Cari kategori..." style="min-width:200px;">
        <span class="text-muted small">{{ $categories->count() }} kategori</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:14px;" id="categoryTable">
            <thead class="table-light">
                <tr>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:50px;">NO</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">NAMA KATEGORI</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">JUMLAH BUKU</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td class="text-muted">{{ $index + 1 }}</td>
                    <td>
                        <div class="fw-semibold">{{ $category->name }}</div>
                        @if($category->description)
                            <div class="text-muted small">{{ $category->description }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge rounded-pill" style="background:#FAEEDA; color:#633806;">
                            {{ $category->books_count }} buku
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FCEBEB; color:#791F1F; border:none;">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                        Belum ada kategori.
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
        document.querySelectorAll('#categoryTable tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
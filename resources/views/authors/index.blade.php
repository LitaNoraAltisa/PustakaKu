@php
    use Illuminate\support\Str;
@endphp
@extends('layouts.app')
@section('title', 'Penulis')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h5 class="fw-semibold mb-1">
            <i class="bi bi-person-lines-fill me-2" style="color:#854F0B;"></i>Penulis Buku
        </h5>
        <p class="text-muted small mb-0">Kelola data penulis buku perpustakaan</p>
    </div>
    <a href="{{ route('authors.create') }}" class="btn text-white d-flex align-items-center gap-1" style="background:#3d2b1f;">
        <i class="bi bi-plus-lg"></i> Tambah Penulis
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Penulis</div>
                <div class="fs-4 fw-semibold">{{ $authors->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Buku</div>
                <div class="fs-4 fw-semibold">{{ $authors->sum('books_count') }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <input type="text" id="searchInput" class="form-control form-control-sm w-auto"
            placeholder="Cari penulis..." style="min-width:200px;">
        <span class="text-muted small">{{ $authors->count() }} penulis</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:14px;" id="authorTable">
            <thead class="table-light">
                <tr>
                    <th class="text-muted fw-semibold" style="font-size:11px; width:50px;">NO</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">NAMA PENULIS</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">JUMLAH BUKU</th>
                    <th class="text-muted fw-semibold" style="font-size:11px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $index => $author)
                <tr>
                    <td class="text-muted">{{ $index + 1 }}</td>
                    <td>
                        <div class="fw-semibold">{{ $author->name }}</div>
                        @if($author->biography)
                            <div class="text-muted small">{{ Str::limit($author->biography, 60) }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge rounded-pill" style="background:#FAEEDA; color:#633806;">
                            {{ $author->books_count }} buku
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus penulis ini?')">
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
                        Belum ada penulis.
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
        document.querySelectorAll('#authorTable tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', 'Buku')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h5 class="fw-semibold mb-1">
            <i class="bi bi-collection me-2" style="color:#854F0B;"></i>Daftar Buku
        </h5>
        <p class="text-muted small mb-0">Kelola koleksi buku perpustakaan</p>
    </div>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('books.create') }}" class="btn text-white d-flex align-items-center gap-1" style="background:#3d2b1f;">
        <i class="bi bi-plus-lg"></i> Tambah Buku
    </a>
    @endif
</div>

{{-- Stat Cards --}}
@if(auth()->user()->isAdmin())
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Total Buku</div>
                <div class="fs-4 fw-semibold">{{ $books->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Buku Tersedia</div>
                <div class="fs-4 fw-semibold" style="color:#3B6D11;">{{ $books->where('stock', '>', 0)->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="text-muted small mb-1">Buku Habis</div>
                <div class="fs-4 fw-semibold" style="color:#A32D2D;">{{ $books->where('stock', 0)->count() }}</div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Tabel --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
        <input type="text" id="searchInput" class="form-control form-control-sm w-auto"
            placeholder="Cari buku..." style="min-width:200px;">
        <span class="text-muted small">{{ $books->count() }} buku</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:14px;" id="bookTable">
            <thead class="table-light">
    <tr>
        <th class="text-muted fw-semibold" style="font-size:11px; width:50px;">NO</th>
        <th class="text-muted fw-semibold" style="font-size:11px;">BUKU</th>
        <th class="text-muted fw-semibold" style="font-size:11px;">KATEGORI</th>
        <th class="text-muted fw-semibold" style="font-size:11px;">PENULIS</th>
        <th class="text-muted fw-semibold" style="font-size:11px;">STOK</th>
        <th class="text-muted fw-semibold" style="font-size:11px;">AKSI</th>
    </tr>
</thead>

<tbody>
    @forelse($books as $index => $book)
    <tr>
        <td class="text-muted align-middle">
            {{ $index + 1 }}
        </td>

        <td>
            <div class="d-flex align-items-center gap-3">
                @if($book->cover)
                    <img
                        src="{{ Storage::url($book->cover) }}"
                        alt="{{ $book->title }}"
                        class="rounded shadow-sm"
                        style="width:55px; height:75px; object-fit:cover;">
                @else
                    <div
                        class="d-flex align-items-center justify-content-center bg-light rounded"
                        style="width:55px; height:75px;">
                        <i class="bi bi-book text-muted"></i>
                    </div>
                @endif

                <div>
                    <div class="fw-semibold">
                        {{ $book->title }}
                    </div>

                    <div class="text-muted small">
                        {{ $book->publisher }}
                        ·
                        {{ $book->publication_year }}
                    </div>
                </div>
            </div>
        </td>

        <td>
            <span class="badge rounded-pill"
                style="background:#FAEEDA; color:#633806;">
                {{ $book->category->name }}
            </span>
        </td>

        <td>
            {{ $book->author->name }}
        </td>

        <td>
            @if($book->stock > 0)
                <span class="badge rounded-pill"
                    style="background:#EAF3DE; color:#27500A;">
                    {{ $book->stock }} tersedia
                </span>
            @else
                <span class="badge rounded-pill"
                    style="background:#FCEBEB; color:#791F1F;">
                    Habis
                </span>
            @endif
        </td>

        <td>
            <a href="{{ route('books.show', $book->slug) }}"
                class="btn btn-sm btn-outline-secondary me-1">
                <i class="bi bi-eye"></i>
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('books.edit', $book->id) }}"
                    class="btn btn-sm btn-outline-secondary me-1">
                    <i class="bi bi-pencil"></i>
                </a>

                <form action="{{ route('books.destroy', $book->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-sm"
                        style="background:#FCEBEB; color:#791F1F; border:none;">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center text-muted py-5">
            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
            Belum ada buku.
        </td>
    </tr>
    @endforelse
</tbody>
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#bookTable tbody tr').forEach(function(row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
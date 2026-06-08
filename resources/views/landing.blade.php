@extends('layouts.guest')
@section('title', 'Selamat Datang')

@section('content')

{{-- Navbar Landing --}}
<nav class="navbar px-4 px-md-5 py-3" style="background:#3d2b1f; border-bottom: 3px solid #854F0B;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <span style="background:#854F0B; padding:6px 10px; border-radius:8px;">
                <i class="bi bi-book text-white fs-5"></i>
            </span>
            <span class="fw-semibold" style="color:#f5e6d3; font-size:18px;">PustakaKu</span>
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light" style="border-color:#854F0B; color:#f5e6d3;">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="btn btn-sm" style="background:#854F0B; color:#f5e6d3;">
                Daftar
            </a>
        </div>
    </div>
</nav>

@if(session('success'))
<div id="successAlert"
    class="alert alert-success alert-dismissible fade show position-fixed"
    style="top:20px; right:20px; z-index:9999; border-radius:8px; font-size:13px;">
    <i class="bi bi-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


{{-- Hero Section --}}
<div style="background: radial-gradient(circle at top left, #4a3525 0%, #251a12 100%); min-height: 90vh; position:relative; overflow:hidden;"
    class="d-flex align-items-center">


    {{-- Dekorasi --}}
    <div style="position:absolute; top:-100px; right:-50px; width:400px; height:400px;
        background:#854F0B; opacity:0.1; filter:blur(80px); border-radius:50%;"></div>
    <div style="position:absolute; bottom:-100px; left:-50px; width:300px; height:300px;
        background:#854F0B; opacity:0.1; filter:blur(60px); border-radius:50%;"></div>

    <div class="container py-5" style="position:relative; z-index:2;">
        <div class="row align-items-center">

            {{-- Teks Hero --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge px-3 py-2 mb-4" style="background:#854F0B; color:#f5e6d3; font-size:12px;">
                    <i class="bi bi-stars me-1"></i> Sistem Perpustakaan Digital
                </span>
                <h1 class="fw-bold mb-4" style="color:#f5e6d3; font-size:48px; line-height:1.2;">
                    Kelola Perpustakaan <span style="color:#dcb37c;">Lebih Mudah</span> & Modern
                </h1>
                <p class="mb-5" style="color:#c4a882; font-size:16px; line-height:1.8; max-width:480px;">
                    PustakaKu hadir sebagai solusi manajemen perpustakaan digital yang memudahkan pengelolaan buku, peminjaman, dan pengembalian secara efisien.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn px-4 py-3" style="background:#854F0B; color:#f5e6d3; border-radius:10px; font-weight:600;">
                        <i class="bi bi-person-plus me-2"></i> Mulai Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="btn px-4 py-3" style="background:rgba(255,255,255,0.1); color:#f5e6d3; border-radius:10px; border:1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                    </a>
                </div>
            </div>

            {{-- Fitur Cards --}}
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-4 rounded-3" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1);">
                            <div class="rounded-3 p-2 mb-3 d-inline-block" style="background:#FAEEDA;">
                                <i class="bi bi-book fs-4" style="color:#633806;"></i>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color:#f5e6d3;">Kelola Buku</h6>
                            <p class="mb-0" style="color:#c4a882; font-size:13px;">Tambah, edit, dan hapus koleksi buku dengan mudah</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-3" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1);">
                            <div class="rounded-3 p-2 mb-3 d-inline-block" style="background:#E1F5EE;">
                                <i class="bi bi-arrow-left-right fs-4" style="color:#085041;"></i>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color:#f5e6d3;">Peminjaman</h6>
                            <p class="mb-0" style="color:#c4a882; font-size:13px;">Catat dan pantau peminjaman buku secara real-time</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-3" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1);">
                            <div class="rounded-3 p-2 mb-3 d-inline-block" style="background:#EEEDFE;">
                                <i class="bi bi-arrow-return-left fs-4" style="color:#3C3489;"></i>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color:#f5e6d3;">Pengembalian</h6>
                            <p class="mb-0" style="color:#c4a882; font-size:13px;">Kelola pengembalian dan hitung denda otomatis</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-3" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1);">
                            <div class="rounded-3 p-2 mb-3 d-inline-block" style="background:#FAECE7;">
                                <i class="bi bi-bar-chart fs-4" style="color:#712B13;"></i>
                            </div>
                            <h6 class="fw-semibold mb-1" style="color:#f5e6d3;">Statistik</h6>
                            <p class="mb-0" style="color:#c4a882; font-size:13px;">Pantau statistik perpustakaan di dashboard admin</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="py-4 text-center" style="background:#3d2b1f; border-top: 3px solid #854F0B;">
    <small style="color:#c4a882;">
        © 2026 PustakaKu — Dibuat oleh <strong style="color:#f5e6d3;">Lita Nora</strong>
    </small>
</footer>

@endsection

@section('scripts')
<script>
    // auto hide alert setelah 3 detik
    setTimeout(function() {
        const alert = document.getElementById('successAlert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 300);
        }
    }, 3000);
</script>
@endsection
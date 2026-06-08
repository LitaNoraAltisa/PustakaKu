<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PustakaKu - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f5f0;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-pustaka {
            background-color: #3d2b1f;
            border-bottom: 3px solid #854F0B;
        }
        .navbar-pustaka .navbar-brand {
            color: #f5e6d3 !important;
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-pustaka .navbar-brand span {
            background: #854F0B;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 14px;
        }
        .navbar-pustaka .nav-link {
            color: #c4a882 !important;
            font-size: 14px;
            padding: 8px 12px !important;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .navbar-pustaka .nav-link:hover {
            color: #f5e6d3 !important;
            background: rgba(133, 79, 11, 0.3);
        }
        .navbar-pustaka .nav-link.active {
            color: #f5e6d3 !important;
            background: #854F0B;
        }
        .navbar-pustaka .nav-link i {
            margin-right: 4px;
        }
        .btn-logout {
            background: transparent;
            border: 1px solid #854F0B;
            color: #c4a882 !important;
            font-size: 14px;
            padding: 6px 14px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            background: #854F0B;
            color: #f5e6d3 !important;
        }
        .navbar-user {
            color: #c4a882;
            font-size: 13px;
            margin-right: 12px;
        }
        .navbar-user span {
            color: #f5e6d3;
            font-weight: 500;
        }
        .alert {
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-pustaka sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span><i class="bi bi-book"></i></span>
                PustakaKu
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-3">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                    <i class="bi bi-tags"></i> Kategori
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}" href="{{ route('authors.index') }}">
                                    <i class="bi bi-person-lines-fill"></i> Penulis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                    <i class="bi bi-book"></i> Buku
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}" href="{{ route('borrowings.index') }}">
                                    <i class="bi bi-arrow-left-right"></i> Peminjaman
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('return_books.*') ? 'active' : '' }}" href="{{ route('return_books.index') }}">
                                    <i class="bi bi-arrow-return-left"></i> Pengembalian
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}" href="{{ route('member.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                                    <i class="bi bi-book"></i> Buku
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                @auth
                <div class="d-flex align-items-center">
                    <span class="navbar-user">
                        <i class="bi bi-person-circle"></i>
                        Halo, <span>{{ auth()->user()->name }}</span>
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Alert --}}
    <div class="container mt-3">
        <div class="mb-3">
            @if(session('success'))
            <div id="successAlert"
                class="alert alert-success alert-dismissible fade show position-fixed"
                style="top:20px; right:20px; z-index:9999; border-radius:8px; font-size:13px;">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
        </div>
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed"
                style="top:20px; right:20px; z-index:9999; border-radius:8px; font-size:13px;">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="container mt-4 mb-5 pb-5 flex-grow-1">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="mt-auto py-4" style="background:#3d2b1f; border-top:3px solid #854F0B;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

            <div class="text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-1">
                    <span style="background:#854F0B; padding:4px 8px; border-radius:6px;">
                        <i class="bi bi-book" style="color:  #f5e6d3;"></i>
                    </span>
                    <span class="fw-semibold" style="color:#f5e6d3;">PustakaKu</span>
                </div>
                <small style="color: #c4a882;">Sistem Manajemen Perpustakaan</small>
            </div>

            <div class="text-center">
                <small style="color: #c4a882;">
                    <i class="bi bi-geo-alt me-1"></i>
                    Malang, Jawa Timur
                </small>
            </div>

            <div class="text-center text-md-end">
                <small style="color: #c4a882;">
                    © 2026 PustakaKu — Dibuat oleh <strong style="color:#f5e6d3;">Lita Nora</strong>
                </small>
            </div>

        </div>
    </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <script>
    // auto hide semua alert setelah 3 detik
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        });
    }, 3000);
</script>
</body>
</html>
@extends('layouts.guest')
@section('title', 'Login')

@section('content')

{{-- Wrapper Utama --}}
<div class="container-fluid min-vh-100 p-0 m-0 overflow-hidden bg-white">
    <div class="row g-0 min-vh-100">

        {{-- KOLOM KIRI - Branding & Ilustrasi --}}
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-between text-white min-vh-100"
            style="background: radial-gradient(circle at top left, #4a3525 0%, #251a12 100%);
                position: relative; padding: 4.5rem !important; overflow: hidden;">

            {{-- Dekorasi: Dot Pattern Background --}}
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                        background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 0);
                        background-size: 24px 24px; pointer-events: none;"></div>

            {{-- Logo PustakaKu --}}
            <div class="d-flex align-items-center gap-3" style="position: relative; z-index: 2;">
                <div style="background: linear-gradient(135deg, #a66a14 0%, #854F0B 100%);
                            width: 52px; height: 52px; border-radius:14px;
                            display: flex; align-items: center; justify-content: center;
                            box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                    <i class="bi bi-book-half text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="fw-bold m-0"
                        style="font-size: 28px; letter-spacing: 1px;
                            background: linear-gradient(to right, #ffffff, #f5e6d3);
                            -webkit-background-clip: text; background-clip: text;
                            -webkit-text-fill-color: transparent;">PustakaKu</h2>
                    <div style="width: 35px; height: 3px; background: #854F0B;
                                border-radius: 2px; margin-top: 4px;"></div>
                </div>
            </div>

            {{-- Tagline & Deskripsi --}}
            <div style="max-width: 440px; margin-top: auto; margin-bottom: auto; position: relative; z-index: 2;">
                <h1 class="fw-bold mb-3"
                    style="font-size: 36px; line-height: 1.2; color: #f5e6d3; letter-spacing: -0.5px;">
                    Ruang Baca <br>
                    <span style="color: #dcb37c; position: relative; display: inline-block;">
                        Digital Interaktif
                        <span style="position: absolute; bottom: 4px; left: 0; width: 100%; height: 8px;
                                    background: rgba(133,79,11,0.3); z-index: -1;"></span>
                    </span> Anda.
                </h1>
                <p class="lead opacity-75" style="font-size: 17px; line-height: 1.8; font-weight: 400;">
                    Jelajahi ribuan literasi digital dalam satu genggaman. Mari membaca lebih banyak hari ini.
                </p>
            </div>

            {{-- Copyright --}}
            <div class="opacity-50 small" style="letter-spacing: 0.5px; position: relative; z-index: 2;">
                © 2026 PustakaKu — Dibuat oleh <strong style="color:#f5e6d3;">Lita Nora</strong>
            </div>

            {{-- Dekorasi: Blur Lingkaran Kanan Atas --}}
            <div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px;
                        background: #854F0B; opacity: 0.15; filter: blur(80px);
                        border-radius: 50%; pointer-events: none;"></div>

            {{-- Dekorasi: SVG Kurva Kiri Bawah --}}
            <svg style="position: absolute; bottom: -20px; left: -20px; width: 320px; height: 320px;
                        opacity: 0.08; pointer-events: none;"
                viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" d="M 0,200 C 0,100 100,0 200,0 L 200,200 Z" />
            </svg>

            {{-- Dekorasi: Blur Lingkaran Kiri Bawah --}}
            <div style="position: absolute; bottom: -40px; left: -40px; width: 200px; height: 200px;
                        background: #854F0B; opacity: 0.1; filter: blur(40px); border-radius: 50%;"></div>
        </div>

        {{-- KOLOM KANAN - Form Login --}}
        <div class="col-md-6 col-12 p-4 p-sm-5 d-flex flex-column justify-content-center min-vh-100 align-items-center"
            style="background-color: #f3ede4;">
            <div class="w-100" style="max-width: 380px;">

                {{-- Alert Session Status --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show border-0 py-2 px-3 mb-4"
                        role="alert"
                        style="background-color: #e8f5e9; color: #2e7d32; font-size: 13px; border-radius: 10px;">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Logo Mobile (hanya muncul di layar kecil) --}}
                <div class="d-md-none mb-4 text-center">
                    <span style="background:#3d2b1f; padding:8px 12px; border-radius:10px;
                                display: inline-block;" class="mb-2">
                        <i class="bi bi-book-half text-white fs-4"></i>
                    </span>
                    <h3 class="fw-bold text-dark mb-0">PustakaKu</h3>
                </div>

                {{-- Judul Form --}}
                <div class="mb-4 text-start">
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Selamat Datang</h3>
                    <p class="text-muted small mb-0">Silakan masuk menggunakan akun terdaftar Anda.</p>
                </div>

                @if(session('success'))
                    <div id="successAlert"
                        class="alert alert-success alert-dismissible fade show position-fixed"
                        style="
                            top:20px;
                            right:20px;
                            z-index:9999;
                            border-radius:10px;
                            font-size:13px;
                            min-width:300px;
                            box-shadow:0 4px 12px rgba(0,0,0,.15);
                        ">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                {{-- Form Login --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- Input Email --}}
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase"
                            style="font-size: 11px; letter-spacing: 0.5px;">Alamat Email</label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required
                            style="border-radius: 10px; border: 1px solid #e0d7c6;
                                font-size: 14px; background-color: #faf9f6;">
                        @error('email')
                            <div class="invalid-feedback" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Password + Toggle Mata --}}
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase"
                            style="font-size: 11px; letter-spacing: 0.5px;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="••••••••"
                                required
                                style="border-radius: 10px 0 0 10px; border: 1px solid #e0d7c6;
                                    border-right: 0; font-size: 14px; background-color: #faf9f6;">
                            <button type="button" class="btn btn-outline-secondary border-start-0"
                                id="togglePassword"
                                style="border-radius: 0 10px 10px 0; border-color: #e0d7c6;
                                    color: #999; background: #faf9f6;">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <small class="text-danger mt-1 d-block" style="font-size: 11px;">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="btn w-100 border-0 shadow-sm text-white"
                        style="background:#3d2b1f; border-radius: 10px; font-weight: 600;
                            font-size: 15px; padding: 12px;">
                        Masuk Sekarang
                    </button>
                </form>

                {{-- Link ke Register --}}
                <div class="text-center mt-5">
                    <small class="text-muted" style="font-size: 13px;">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none"
                            style="color:#854F0B;">Daftar di sini</a>
                    </small>
                </div>

            </div>
        </div>
        {{-- End Kolom Kanan --}}

    </div>
</div>

@endsection

@section('scripts')
<script>
    // Toggle show/hide password
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        }
    });
</script>
<script>
    setTimeout(function () {
        let alert = document.getElementById('successAlert');

        if (alert) {
            alert.classList.remove('show');

            setTimeout(function () {
                alert.remove();
            }, 300);
        }
    }, 3000); // 3 detik
</script>
@endsection
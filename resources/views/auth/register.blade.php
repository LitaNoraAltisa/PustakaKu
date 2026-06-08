@extends('layouts.guest')
@section('title', 'Daftar Akun')

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
                    Bergabunglah bersama kami untuk menikmati akses penuh ke berbagai macam buku dan modul digital secara instan.
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
        {{-- End Kolom Kiri --}}

        {{-- KOLOM KANAN - Form Register --}}
        <div class="col-md-6 col-12 p-4 p-sm-5 d-flex flex-column justify-content-center min-vh-100 align-items-center"
            style="background-color: #f3ede4;">
            <div class="w-100" style="max-width: 380px;">

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
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Daftar Akun Baru</h3>
                    <p class="text-muted small mb-0">Lengkapi data Anda di bawah ini untuk memulai.</p>
                </div>

                {{-- Form Register --}}
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    {{-- Input Nama Lengkap --}}
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1"
                            style="font-size: 11px; letter-spacing: 0.5px;">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Nama lengkap Anda"
                            value="{{ old('name') }}"
                            required
                            style="border-radius: 10px; border: 1px solid #e0d7c6;
                                font-size: 14px; background-color: #faf9f6;">
                        @error('name')
                            <div class="invalid-feedback" style="font-size: 11px;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1"
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
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1"
                            style="font-size: 11px; letter-spacing: 0.5px;">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter"
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

                    {{-- Input Konfirmasi Password + Toggle Mata --}}
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase mb-1"
                            style="font-size: 11px; letter-spacing: 0.5px;">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password"
                                required
                                style="border-radius: 10px 0 0 10px; border: 1px solid #e0d7c6;
                                    border-right: 0; font-size: 14px; background-color: #faf9f6;">
                            <button type="button" class="btn btn-outline-secondary border-start-0"
                                id="toggleConfirmPassword"
                                style="border-radius: 0 10px 10px 0; border-color: #e0d7c6;
                                    color: #999; background: #faf9f6;">
                                <i class="bi bi-eye" id="confirmEyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="btn w-100 border-0 shadow-sm text-white"
                        style="background:#3d2b1f; border-radius: 10px; font-weight: 600;
                            font-size: 15px; padding: 12px;">
                        Daftar Sekarang
                    </button>
                </form>

                {{-- Link ke Login --}}
                <div class="text-center mt-4">
                    <small class="text-muted" style="font-size: 13px;">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="fw-bold text-decoration-none"
                            style="color:#854F0B;">Masuk di sini</a>
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
    // Toggle show/hide password utama
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

    // Toggle show/hide konfirmasi password
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordConfirm = document.getElementById('password_confirmation');
    const confirmEyeIcon = document.getElementById('confirmEyeIcon');

    toggleConfirmPassword.addEventListener('click', function() {
        if (passwordConfirm.type === 'password') {
            passwordConfirm.type = 'text';
            confirmEyeIcon.classList.remove('bi-eye');
            confirmEyeIcon.classList.add('bi-eye-slash');
        } else {
            passwordConfirm.type = 'password';
            confirmEyeIcon.classList.remove('bi-eye-slash');
            confirmEyeIcon.classList.add('bi-eye');
        }
    });
</script>
@endsection
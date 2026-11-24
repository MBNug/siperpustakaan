@extends('layouts.auth')

@section('title', 'Login Pustakawan — SIPerpustakaan')

@section('content')
    <div class="auth-box">
        <div class="mb-4">
            <div class="d-flex align-items-center d-lg-none mb-3" style="gap: 10px;">
                <span class="desk-brand-mark" style="background: var(--bg-shell); color: #A7F3D0; border-color: var(--bg-shell);">
                    <i class="fas fa-book-open"></i>
                </span>
                <span class="font-weight-bold" style="font-size: 16px;">SIPerpustakaan</span>
            </div>
            <h2 class="page-title" style="font-size: 22px;">Masuk Konsol Pustakawan</h2>
            <p class="page-desc">Kelola katalog buku, anggota, dan transaksi peminjaman.</p>
        </div>

        @if (session('status'))
            <div class="desk-alert desk-alert-success mb-3" role="alert">
                <div>
                    <i class="fas fa-circle-check mr-2"></i>{{ session('status') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="desk-alert desk-alert-danger mb-3" role="alert">
                <div>
                    <i class="fas fa-circle-exclamation mr-2"></i>{{ $errors->first() }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="desk-field">
                <label for="email" class="desk-label">Email Pustakawan</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="desk-input @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="admin@perpustakaan.test"
                    required
                    autofocus
                >
            </div>

            <div class="desk-field">
                <label for="password" class="desk-label">Kata Sandi</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="desk-input @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                    <label class="custom-control-label" for="remember_me" style="font-size: 13px; color: var(--text-secondary);">Ingat perangkat ini</label>
                </div>
                <a href="{{ route('home') }}" style="font-size: 13px; font-weight: 500;">Ke Halaman Absensi</a>
            </div>

            <button type="submit" class="btn-desk btn-desk-primary w-100" style="height: 44px; font-size: 14.5px;">
                <i class="fas fa-right-to-bracket"></i>
                <span>Masuk ke Konsol</span>
            </button>
        </form>

        @if (config('app.demo_mode') && config('app.demo_login_password'))
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span style="font-size: 12.5px; font-weight: 600; color: var(--text-secondary);">Akun Demo Portofolio</span>
                    <button type="button" class="btn-desk btn-desk-secondary btn-desk-sm" id="fillDemoBtn">
                        <i class="fas fa-wand-magic-sparkles"></i>
                        <span>Isi Otomatis</span>
                    </button>
                </div>
                <div class="p-2 rounded" style="background: var(--bg-canvas); border: 1px solid var(--border-linen); font-size: 12.5px;">
                    <div>Email: <span class="mono">{{ config('app.demo_login_email') }}</span></div>
                    <div>Password: <span class="mono">{{ config('app.demo_login_password') }}</span></div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    @if (config('app.demo_mode') && config('app.demo_login_password'))
        <script>
            document.getElementById('fillDemoBtn')?.addEventListener('click', function () {
                document.getElementById('email').value = @json(config('app.demo_login_email'));
                document.getElementById('password').value = @json(config('app.demo_login_password'));
            });
        </script>
    @endif
@endsection

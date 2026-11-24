<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIPerpustakaan — Absensi & Katalog')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/circulation.css') }}">
</head>

<body class="kiosk-page">
    <header class="kiosk-header">
        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none" style="gap: 12px; color: var(--text-primary);">
            <span class="desk-brand-mark" style="background: var(--bg-shell); color: #A7F3D0; border-color: var(--bg-shell);">
                <i class="fas fa-book-open"></i>
            </span>
            <span>
                <span class="d-block font-weight-bold" style="font-size: 16px; letter-spacing: -0.015em; line-height: 1.2;">SIPerpustakaan</span>
                <span class="d-block" style="font-size: 12px; color: var(--text-muted);">Meja Sirkulasi &amp; Absensi Digital</span>
            </span>
        </a>

        <div class="d-flex align-items-center" style="gap: 10px;">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-desk btn-desk-primary">
                    <i class="fas fa-gauge-high"></i>
                    <span>Buka Konsol Admin</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-desk btn-desk-secondary">
                    <i class="fas fa-user-shield"></i>
                    <span>Login Pustakawan</span>
                </a>
            @endauth
        </div>
    </header>

    <main class="kiosk-main">
        @yield('content')
    </main>

    <footer class="desk-footer justify-content-center">
        <span>&copy; {{ date('Y') }} SIPerpustakaan &mdash; Sistem Informasi Perpustakaan Digital</span>
    </footer>

    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2.all.min.js') }}"></script>
    @include('partials.flash-swal')
    @yield('script')
</body>

</html>

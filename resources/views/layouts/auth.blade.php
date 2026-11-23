<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login Pustakawan — SIPerpustakaan')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/circulation.css') }}">
</head>

<body>
    <div class="auth-split">
        <aside class="auth-aside">
            <div>
                <a href="{{ route('home') }}" class="d-inline-flex align-items-center text-white text-decoration-none" style="gap: 12px;">
                    <span class="desk-brand-mark">
                        <i class="fas fa-book-open"></i>
                    </span>
                    <div>
                        <div class="desk-brand-title">SIPerpustakaan</div>
                        <div class="desk-brand-sub">Sistem Informasi Perpustakaan Digital</div>
                    </div>
                </a>

                <h1 class="mt-5 mb-3 font-weight-bold" style="font-size: 32px; line-height: 1.2; letter-spacing: -0.025em; max-width: 420px;">
                    Kendali sirkulasi koleksi, anggota, dan keterlambatan dalam satu meja kerja.
                </h1>
                <p style="color: var(--text-on-shell-muted); font-size: 15px; max-width: 430px;">
                    Pantau rasio stok tersedia secara real-time, catat peminjaman dan pengembalian sekali klik, serta ekspor laporan sirkulasi ke Excel.
                </p>
            </div>

            <div class="pt-4" style="border-top: 1px solid rgba(255, 255, 255, 0.12); font-size: 13px; color: var(--text-on-shell-muted);">
                <div class="d-flex flex-wrap" style="gap: 20px;">
                    <span><i class="fas fa-check mr-2 text-success"></i>Cek stok buku live</span>
                    <span><i class="fas fa-check mr-2 text-success"></i>Deteksi keterlambatan</span>
                    <span><i class="fas fa-check mr-2 text-success"></i>Absensi NIS mandiri</span>
                </div>
            </div>
        </aside>

        <main class="auth-panel">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
</body>

</html>

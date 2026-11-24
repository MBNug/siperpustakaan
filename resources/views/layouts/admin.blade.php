<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIPerpustakaan — Konsol Pustakawan')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Onest:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/circulation.css') }}">
    @yield('style')
</head>

<body>
    <div class="desk-shell">
        <div class="desk-backdrop" id="deskBackdrop"></div>

        <aside class="desk-sidebar" id="deskSidebar">
            <a href="{{ route('admin.dashboard') }}" class="desk-brand text-decoration-none">
                <span class="desk-brand-mark">
                    <i class="fas fa-book-open"></i>
                </span>
                <span>
                    <span class="desk-brand-title d-block">SIPerpustakaan</span>
                    <span class="desk-brand-sub d-block">Konsol Sirkulasi</span>
                </span>
            </a>

            <nav class="desk-nav" aria-label="Navigasi Utama">
                @hasSection('sidebar')
                    @yield('sidebar')
                @else
                    <div class="desk-nav-group">Ringkasan</div>
                    <a href="{{ route('admin.dashboard') }}" class="desk-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                        <i class="fas fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>

                    <div class="desk-nav-group">Layanan Sirkulasi</div>
                    <a href="{{ route('borrow') }}" class="desk-nav-link {{ request()->routeIs('borrow*') ? 'is-active' : '' }}">
                        <i class="fas fa-arrows-rotate"></i>
                        <span>Peminjaman</span>
                    </a>
                    <a href="{{ route('book') }}" class="desk-nav-link {{ request()->routeIs('book*') ? 'is-active' : '' }}">
                        <i class="fas fa-books fas fa-book"></i>
                        <span>Katalog Buku</span>
                    </a>
                    <a href="{{ route('member') }}" class="desk-nav-link {{ request()->routeIs('member*') ? 'is-active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Anggota</span>
                    </a>
                @endif
            </nav>

            <div class="desk-sidebar-footer">
                <a href="{{ route('home') }}" class="desk-kiosk-shortcut text-decoration-none">
                    <span><i class="fas fa-id-card mr-2"></i>Halaman Absensi</span>
                    <i class="fas fa-arrow-up-right-from-square" style="font-size: 11px;"></i>
                </a>
            </div>
        </aside>

        <div class="desk-main">
            <header class="desk-topbar">
                <div class="desk-topbar-left">
                    <button type="button" class="desk-menu-toggle" id="deskMenuToggle" aria-label="Buka menu navigasi">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="desk-breadcrumb">
                        <span>SIPerpustakaan</span>
                        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                        <strong>@yield('crumb', 'Konsol Admin')</strong>
                    </div>
                </div>

                <div class="desk-topbar-right">
                    <div class="dropdown">
                        <button type="button" class="desk-user-trigger dropdown-toggle" id="deskUserMenu" data-toggle="dropdown" aria-expanded="false">
                            <span class="desk-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</span>
                            <span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Pustakawan' }}</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border" aria-labelledby="deskUserMenu" style="border-radius: 10px; min-width: 210px;">
                            <div class="px-3 py-2 border-bottom">
                                <div class="font-weight-bold" style="font-size: 13px;">{{ Auth::user()->name ?? 'Pustakawan' }}</div>
                                <div class="text-muted" style="font-size: 12px;">{{ Auth::user()->email ?? '' }}</div>
                            </div>
                            <a class="dropdown-item py-2" href="{{ route('home') }}">
                                <i class="fas fa-id-badge mr-2 text-muted"></i> Absensi Pengunjung
                            </a>
                            <div class="dropdown-divider my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-right-from-bracket mr-2"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="desk-content">
                @if (session('status') || session('success'))
                    <div class="desk-alert desk-alert-success" role="alert">
                        <div>
                            <i class="fas fa-circle-check mr-2"></i>{{ session('status') ?? session('success') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup" style="font-size: 18px; line-height: 1;">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="desk-alert desk-alert-danger" role="alert">
                        <div>
                            <i class="fas fa-triangle-exclamation mr-2"></i>{{ session('error') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup" style="font-size: 18px; line-height: 1;">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="desk-alert desk-alert-danger" role="alert">
                        <div>
                            <strong class="d-block mb-1"><i class="fas fa-circle-exclamation mr-2"></i>Periksa kembali input Anda:</strong>
                            <ul class="mb-0 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Tutup" style="font-size: 18px; line-height: 1;">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="desk-footer">
                <span>&copy; {{ date('Y') }} SIPerpustakaan &mdash; Sistem Informasi Perpustakaan Digital</span>
                <span class="mono" style="font-size: 12px;">{{ now()->translatedFormat('d M Y') }}</span>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2.all.min.js') }}"></script>

    <script>
        (function () {
            const toggle = document.getElementById('deskMenuToggle');
            const sidebar = document.getElementById('deskSidebar');
            const backdrop = document.getElementById('deskBackdrop');
            if (toggle && sidebar && backdrop) {
                const closeDrawer = () => {
                    sidebar.classList.remove('is-open');
                    backdrop.classList.remove('is-open');
                };
                toggle.addEventListener('click', () => {
                    sidebar.classList.toggle('is-open');
                    backdrop.classList.toggle('is-open');
                });
                backdrop.addEventListener('click', closeDrawer);
            }

            document.addEventListener('submit', function (e) {
                const form = e.target.closest('.js-confirm-action');
                if (!form || form.dataset.confirmed === '1') return;
                e.preventDefault();
                const title = form.dataset.title || 'Konfirmasi tindakan';
                const text = form.dataset.text || 'Data yang dihapus tidak dapat dikembalikan.';
                const confirmText = form.dataset.confirm || 'Ya, lanjutkan';
                const confirmColor = form.dataset.danger === '0' ? '#15803D' : '#B91C1C';

                Swal.fire({
                    title: title,
                    text: text,
                    icon: form.dataset.danger === '0' ? 'question' : 'warning',
                    showCancelButton: true,
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#66776F',
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.dataset.confirmed = '1';
                        form.submit();
                    }
                });
            });
        })();
    </script>
    @include('partials.flash-swal')
    @yield('script')
</body>

</html>

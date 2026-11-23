@extends('layouts.admin')

@section('title', 'Dashboard Sirkulasi — SIPerpustakaan')
@section('crumb', 'Dashboard')

@section('content')
    @php
        $totalCopies = (int) $books->sum('jumlah');
        $totalBorrowedCopies = (int) $books->sum('dipinjam');
        $totalAvailableCopies = max(0, $totalCopies - $totalBorrowedCopies);
        $stockPct = $totalCopies > 0 ? min(100, (int) round(($totalAvailableCopies / $totalCopies) * 100)) : 0;

        $weekOrdered = $pengunjungthisweek->sortBy('tanggal')->values();
        $weekLabels = $weekOrdered->map(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)->translatedFormat('D, d M');
        })->values()->toArray();
        $weekVisitors = $weekOrdered->pluck('jmlpengunjung')->values()->toArray();
        $weekLoans = $weekOrdered->pluck('jmlpinjam')->values()->toArray();
    @endphp

    <div class="page-head">
        <div>
            <h1 class="page-title">Ringkasan Meja Sirkulasi</h1>
            <p class="page-desc">Pantauan stok koleksi, kunjungan anggota, dan pinjaman aktif hari ini.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('borrow.create') }}" class="btn-desk btn-desk-primary">
                <i class="fas fa-plus"></i>
                <span>Catat Peminjaman</span>
            </a>
            <a href="{{ route('book.create') }}" class="btn-desk btn-desk-secondary">
                <i class="fas fa-book-medical"></i>
                <span>Tambah Buku</span>
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-tile">
            <div class="stat-tile-top">
                <span class="stat-label">Judul Koleksi</span>
                <span class="stat-icon is-emerald"><i class="fas fa-book"></i></span>
            </div>
            <div class="stat-value num">{{ $books->count() }}</div>
            <div class="stat-foot num">{{ $totalAvailableCopies }} / {{ $totalCopies }} eksemplar tersedia</div>
        </div>

        <div class="stat-tile">
            <div class="stat-tile-top">
                <span class="stat-label">Anggota Terdaftar</span>
                <span class="stat-icon is-teal"><i class="fas fa-users"></i></span>
            </div>
            <div class="stat-value num">{{ $members->count() }}</div>
            <div class="stat-foot num">{{ $members->sum('jmlkunjungan') }} total kunjungan tercatat</div>
        </div>

        <div class="stat-tile">
            <div class="stat-tile-top">
                <span class="stat-label">Sedang Dipinjam</span>
                <span class="stat-icon {{ $overdueBorrows->count() > 0 ? 'is-amber' : 'is-emerald' }}"><i class="fas fa-arrows-rotate"></i></span>
            </div>
            <div class="stat-value num {{ $overdueBorrows->count() > 0 ? 'is-amber' : '' }}">{{ $activeBorrows->count() }}</div>
            <div class="stat-foot num">
                @if ($overdueBorrows->count() > 0)
                    {{ $overdueBorrows->count() }} melewati jatuh tempo
                @else
                    Tidak ada keterlambatan
                @endif
            </div>
        </div>

        <div class="stat-tile">
            <div class="stat-tile-top">
                <span class="stat-label">Kunjungan Hari Ini</span>
                <span class="stat-icon is-emerald"><i class="fas fa-user-check"></i></span>
            </div>
            <div class="stat-value num">{{ $pengunjungtoday->jmlpengunjung ?? 0 }}</div>
            <div class="stat-foot num">{{ $pengunjungtoday->jmlpinjam ?? 0 }} peminjaman dibuat hari ini</div>
        </div>
    </div>

    <div class="dash-split">
        <section class="sheet">
            <div class="sheet-head">
                <div>
                    <h2 class="sheet-title">Aktivitas Sirkulasi Minggu Ini</h2>
                    <p class="sheet-subtitle">Perbandingan kunjungan harian dan transaksi peminjaman baru.</p>
                </div>
                <span class="desk-pill desk-pill-slate">
                    <i class="far fa-calendar"></i>
                    <span>{{ \Carbon\Carbon::today()->startOfWeek()->translatedFormat('d M') }} &ndash; {{ \Carbon\Carbon::today()->endOfWeek()->translatedFormat('d M Y') }}</span>
                </span>
            </div>
            <div class="sheet-body">
                <div style="height: 290px; position: relative;">
                    <canvas id="circulationChart"></canvas>
                </div>
            </div>
        </section>

        <section class="sheet">
            <div class="sheet-head">
                <div>
                    <h2 class="sheet-title">Prioritas Jatuh Tempo</h2>
                    <p class="sheet-subtitle">Pinjaman aktif yang perlu tindak lanjut pengembalian.</p>
                </div>
                <a href="{{ route('borrow') }}" style="font-size: 13px; font-weight: 600;">Lihat Semua</a>
            </div>
            <div class="sheet-body p-0">
                <div class="px-4 py-3 border-bottom" style="background: var(--bg-canvas);">
                    <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 12.5px;">
                        <span class="font-weight-bold text-secondary">Ketersediaan Koleksi Keseluruhan</span>
                        <span class="mono font-weight-bold">{{ $stockPct }}%</span>
                    </div>
                    <div class="stock-meter-track">
                        <div class="stock-meter-fill" style="width: {{ $stockPct }}%;"></div>
                    </div>
                </div>

                @php
                    $priorityBorrows = $activeBorrows->sortBy('tanggalwajibkembali')->take(5);
                    $todayDate = \Carbon\Carbon::today();
                @endphp

                @if ($priorityBorrows->isEmpty())
                    <div class="p-4 text-center text-muted" style="font-size: 13.5px;">
                        <i class="fas fa-circle-check text-success mb-2 d-block" style="font-size: 20px;"></i>
                        Semua pinjaman sudah dikembalikan.
                    </div>
                @else
                    <div class="divide-y">
                        @foreach ($priorityBorrows as $item)
                            @php
                                $due = \Carbon\Carbon::parse($item->tanggalwajibkembali)->startOfDay();
                                $lateDays = $due->diffInDays($todayDate, false);
                            @endphp
                            <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between" style="gap: 12px; {{ $lateDays > 0 ? 'background: var(--amber-row);' : '' }}">
                                <div class="min-w-0">
                                    <div class="font-weight-bold text-truncate" style="font-size: 13.5px; color: var(--text-primary);">
                                        {{ optional($item->book)->judul ?? $item->kode_buku }}
                                    </div>
                                    <div style="font-size: 12.5px; color: var(--text-secondary);">
                                        {{ optional($item->member)->nama ?? $item->nispeminjam }}
                                        &middot; <span class="mono">{{ $item->tanggalwajibkembali }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                    @if ($lateDays > 0)
                                        <span class="desk-pill desk-pill-amber num">Telat {{ $lateDays }}h</span>
                                    @elseif ($lateDays === 0)
                                        <span class="desk-pill desk-pill-amber">Hari ini</span>
                                    @else
                                        <span class="desk-pill desk-pill-slate">Aktif</span>
                                    @endif

                                    <form action="{{ route('borrow.kembalikan', $item->id) }}" method="POST" class="d-inline js-confirm-action" data-danger="0" data-title="Konfirmasi Pengembalian" data-text="Catat buku ini sudah dikembalikan hari ini?" data-confirm="Ya, kembalikan">
                                        @csrf
                                        <button type="submit" class="btn-desk btn-desk-secondary btn-desk-sm" title="Catat pengembalian">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const ctx = document.getElementById('circulationChart');
            if (!ctx || typeof Chart === 'undefined') return;

            const labels = @json($weekLabels);
            const visitors = @json($weekVisitors);
            const loans = @json($weekLoans);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels.length ? labels : ['Belum ada data minggu ini'],
                    datasets: [
                        {
                            label: 'Pengunjung',
                            data: visitors.length ? visitors : [0],
                            borderColor: '#15803D',
                            backgroundColor: 'rgba(21, 128, 61, 0.10)',
                            fill: true,
                            tension: 0.3,
                            borderWidth: 2.5,
                            pointRadius: 4,
                            pointBackgroundColor: '#15803D'
                        },
                        {
                            label: 'Peminjaman Baru',
                            data: loans.length ? loans : [0],
                            borderColor: '#B45309',
                            backgroundColor: 'rgba(180, 83, 9, 0.08)',
                            fill: true,
                            tension: 0.3,
                            borderWidth: 2,
                            pointRadius: 4,
                            pointBackgroundColor: '#B45309'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                font: { family: 'Onest, sans-serif', size: 12 }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, font: { family: 'JetBrains Mono, monospace', size: 11 } },
                            grid: { color: '#EEF1ED' }
                        },
                        x: {
                            ticks: { font: { family: 'Onest, sans-serif', size: 12 } },
                            grid: { display: false }
                        }
                    }
                }
            });
        })();
    </script>
@endsection

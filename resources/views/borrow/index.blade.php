@extends('layouts.admin')

@section('title', 'Peminjaman Buku — SIPerpustakaan')
@section('crumb', 'Peminjaman')

@section('content')
    @php
        $todayDate = \Carbon\Carbon::today();
        $activeCount = $borrows->whereNull('tanggalkembali')->count();
        $overdueCount = $borrows->whereNull('tanggalkembali')->filter(function ($b) use ($todayDate) {
            return \Carbon\Carbon::parse($b->tanggalwajibkembali)->startOfDay()->lt($todayDate);
        })->count();
    @endphp

    <div class="page-head">
        <div>
            <h1 class="page-title">Sirkulasi Peminjaman</h1>
            <p class="page-desc">
                <span class="num font-weight-bold">{{ $activeCount }}</span> transaksi aktif saat ini
                @if ($overdueCount > 0)
                    &middot; <span class="font-weight-bold" style="color: var(--amber);">{{ $overdueCount }} melewati jatuh tempo</span>
                @endif
            </p>
        </div>
        <div class="page-actions">
            <a href="{{ url('/borrow/export-excel') }}" class="btn-desk btn-desk-secondary">
                <i class="fas fa-file-excel"></i>
                <span>Ekspor Excel</span>
            </a>
            <a href="{{ route('borrow.create') }}" class="btn-desk btn-desk-primary">
                <i class="fas fa-plus"></i>
                <span>Peminjaman Baru</span>
            </a>
        </div>
    </div>

    <section class="sheet">
        <div class="sheet-body">
            <div class="table-responsive">
                <table class="table desk-table" id="borrowsTable">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            @php
                                $dueDate = \Carbon\Carbon::parse($borrow->tanggalwajibkembali)->startOfDay();
                                $lateDays = $borrow->tanggalkembali === null ? $dueDate->diffInDays($todayDate, false) : (int) $borrow->telat;
                                $isOverdue = $borrow->tanggalkembali === null && $lateDays > 0;
                            @endphp
                            <tr class="{{ $isOverdue ? 'is-overdue' : '' }}">
                                <td>
                                    <div class="font-weight-bold" style="color: var(--text-primary);">{{ optional($borrow->book)->judul ?? '-' }}</div>
                                    <div class="mono text-muted" style="font-size: 12px;">{{ $borrow->kode_buku }}</div>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ optional($borrow->member)->nama ?? '-' }}</div>
                                    <div class="mono text-muted" style="font-size: 12px;">NIS {{ $borrow->nispeminjam }}</div>
                                </td>
                                <td class="mono">{{ $borrow->tanggalpinjam }}</td>
                                <td class="mono">{{ $borrow->tanggalwajibkembali }}</td>
                                <td class="mono">{{ $borrow->tanggalkembali ?? '—' }}</td>
                                <td>
                                    @if ($borrow->tanggalkembali !== null)
                                        <span class="desk-pill desk-pill-emerald">
                                            <i class="fas fa-check"></i>
                                            Dikembalikan @if ($borrow->telat > 0) (Telat {{ $borrow->telat }}h) @endif
                                        </span>
                                    @elseif ($lateDays > 0)
                                        <span class="desk-pill desk-pill-amber num">
                                            <i class="fas fa-clock"></i>
                                            Telat {{ $lateDays }} hari
                                        </span>
                                    @elseif ($lateDays === 0)
                                        <span class="desk-pill desk-pill-amber">
                                            <i class="fas fa-bell"></i>
                                            Jatuh tempo hari ini
                                        </span>
                                    @else
                                        <span class="desk-pill desk-pill-slate">Dipinjam</span>
                                    @endif
                                </td>
                                <td class="text-right text-nowrap">
                                    @if ($borrow->tanggalkembali === null)
                                        <form action="{{ route('borrow.kembalikan', $borrow->id) }}" method="POST" class="d-inline js-confirm-action" data-danger="0" data-title="Konfirmasi Pengembalian" data-text="Catat buku {{ optional($borrow->book)->judul ?? $borrow->kode_buku }} sudah dikembalikan hari ini?" data-confirm="Ya, kembalikan">
                                            @csrf
                                            <button type="submit" class="btn-desk btn-desk-primary btn-desk-sm" title="Catat pengembalian hari ini">
                                                <i class="fas fa-rotate-left"></i>
                                                <span>Kembalikan</span>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('borrow.edit', $borrow->id) }}" class="btn-desk btn-desk-secondary btn-desk-sm" title="Edit transaksi">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('borrow.destroy', $borrow->id) }}" method="POST" class="d-inline js-confirm-action" data-title="Hapus Transaksi?" data-text="Catatan peminjaman ini akan dihapus permanen." data-confirm="Ya, hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-desk btn-desk-danger btn-desk-sm" title="Hapus transaksi">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $('#borrowsTable').DataTable({
                order: [],
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ entri',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ transaksi',
                    infoEmpty: 'Belum ada transaksi peminjaman',
                    zeroRecords: 'Tidak ada transaksi yang cocok',
                    paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
                }
            });
        });
    </script>
@endsection

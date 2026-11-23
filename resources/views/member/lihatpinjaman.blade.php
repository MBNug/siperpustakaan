@extends('layouts.admin')

@section('title', 'Riwayat Pinjaman Anggota — SIPerpustakaan')
@section('crumb', 'Anggota / Riwayat Pinjaman')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Pinjaman: {{ $member->nama ?? ($borrows->first()->nispeminjam ?? 'Anggota') }}</h1>
            <p class="page-desc">
                NIS: <span class="mono">{{ $member->nis ?? '-' }}</span>
                @if (isset($member->alamat))
                    &middot; {{ $member->alamat }}
                @endif
            </p>
        </div>
        <div class="page-actions">
            <a href="{{ route('member') }}" class="btn-desk btn-desk-secondary">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Anggota</span>
            </a>
            <a href="{{ route('borrow.create') }}" class="btn-desk btn-desk-primary">
                <i class="fas fa-plus"></i>
                <span>Pinjaman Baru</span>
            </a>
        </div>
    </div>

    <section class="sheet">
        <div class="sheet-body">
            <div class="table-responsive">
                <table class="table desk-table" id="memberLoansTable">
                    <thead>
                        <tr>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $todayDate = \Carbon\Carbon::today(); @endphp
                        @foreach ($borrows as $borrow)
                            @php
                                $dueDate = \Carbon\Carbon::parse($borrow->tanggalwajibkembali)->startOfDay();
                                $lateDays = $borrow->tanggalkembali === null ? $dueDate->diffInDays($todayDate, false) : (int) $borrow->telat;
                                $isOverdue = $borrow->tanggalkembali === null && $lateDays > 0;
                            @endphp
                            <tr class="{{ $isOverdue ? 'is-overdue' : '' }}">
                                <td class="mono font-weight-bold">{{ $borrow->kode_buku }}</td>
                                <td class="font-weight-bold">{{ optional($borrow->book)->judul ?? '-' }}</td>
                                <td class="mono">{{ $borrow->tanggalpinjam }}</td>
                                <td class="mono">{{ $borrow->tanggalwajibkembali }}</td>
                                <td class="mono">{{ $borrow->tanggalkembali ?? '—' }}</td>
                                <td>
                                    @if ($borrow->tanggalkembali !== null)
                                        <span class="desk-pill desk-pill-emerald">
                                            Dikembalikan @if ($borrow->telat > 0) (Telat {{ $borrow->telat }}h) @endif
                                        </span>
                                    @elseif ($lateDays > 0)
                                        <span class="desk-pill desk-pill-amber num">Telat {{ $lateDays }} hari</span>
                                    @elseif ($lateDays === 0)
                                        <span class="desk-pill desk-pill-amber">Jatuh tempo hari ini</span>
                                    @else
                                        <span class="desk-pill desk-pill-slate">Dipinjam</span>
                                    @endif
                                </td>
                                <td class="text-right text-nowrap">
                                    @if ($borrow->tanggalkembali === null)
                                        <form action="{{ route('borrow.kembalikan', $borrow->id) }}" method="POST" class="d-inline js-confirm-action" data-danger="0" data-title="Konfirmasi Pengembalian" data-text="Catat buku {{ optional($borrow->book)->judul ?? $borrow->kode_buku }} sudah dikembalikan hari ini?" data-confirm="Ya, kembalikan">
                                            @csrf
                                            <button type="submit" class="btn-desk btn-desk-primary btn-desk-sm">
                                                <i class="fas fa-check"></i>
                                                <span>Kembalikan</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted" style="font-size: 12.5px;">Selesai</span>
                                    @endif
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
            $('#memberLoansTable').DataTable({
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ entri',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ transaksi',
                    infoEmpty: 'Belum ada riwayat peminjaman',
                    zeroRecords: 'Tidak ada data yang cocok',
                    paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
                }
            });
        });
    </script>
@endsection

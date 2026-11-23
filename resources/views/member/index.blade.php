@extends('layouts.admin')

@section('title', 'Daftar Anggota — SIPerpustakaan')
@section('crumb', 'Anggota')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Keanggotaan Perpustakaan</h1>
            <p class="page-desc">Data anggota terdaftar, riwayat kunjungan absensi, dan pinjaman aktif.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('member.create') }}" class="btn-desk btn-desk-primary">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Anggota</span>
            </a>
        </div>
    </div>

    <section class="sheet">
        <div class="sheet-body">
            <div class="table-responsive">
                <table class="table desk-table" id="membersTable">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Anggota</th>
                            <th>Alamat</th>
                            <th>Total Kunjungan</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td class="mono font-weight-bold">{{ $member->nis }}</td>
                                <td>
                                    <div class="font-weight-bold" style="color: var(--text-primary);">{{ $member->nama }}</div>
                                </td>
                                <td>{{ $member->alamat }}</td>
                                <td>
                                    <span class="desk-pill desk-pill-emerald num">{{ $member->jmlkunjungan }}x hadir</span>
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{ route('member.lihatpinjaman', $member->id) }}" class="btn-desk btn-desk-secondary btn-desk-sm" title="Lihat riwayat pinjaman anggota">
                                        <i class="fas fa-book-reader"></i>
                                        <span>Pinjaman</span>
                                    </a>
                                    <a href="{{ route('member.edit', $member->id) }}" class="btn-desk btn-desk-secondary btn-desk-sm" title="Ubah data anggota">
                                        <i class="fas fa-pen"></i>
                                        <span>Edit</span>
                                    </a>
                                    <form action="{{ route('member.destroy', $member->id) }}" method="POST" class="d-inline js-confirm-action" data-title="Hapus Anggota?" data-text="Data anggota {{ $member->nama }} ({{ $member->nis }}) akan dihapus permanen." data-confirm="Ya, hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-desk btn-desk-danger btn-desk-sm" title="Hapus anggota">
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
            $('#membersTable').DataTable({
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ entri',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ anggota',
                    infoEmpty: 'Belum ada data anggota',
                    zeroRecords: 'Tidak ada anggota yang cocok',
                    paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
                }
            });
        });
    </script>
@endsection

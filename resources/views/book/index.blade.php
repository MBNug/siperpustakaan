@extends('layouts.admin')

@section('title', 'Katalog Buku — SIPerpustakaan')
@section('crumb', 'Katalog Buku')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Katalog Koleksi Buku</h1>
            <p class="page-desc">Kelola stok eksemplar, status peminjaman, dan metadata buku perpustakaan.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('book.create') }}" class="btn-desk btn-desk-primary">
                <i class="fas fa-plus"></i>
                <span>Tambah Buku</span>
            </a>
        </div>
    </div>

    <section class="sheet">
        <div class="sheet-body">
            <div class="table-responsive">
                <table class="table desk-table" id="booksTable">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Tahun &amp; Kategori</th>
                            <th>Rasio Stok</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td class="mono font-weight-bold" style="color: var(--text-primary);">{{ $book->kode }}</td>
                                <td>
                                    <div class="font-weight-bold" style="color: var(--text-primary);">{{ $book->judul }}</div>
                                </td>
                                <td>{{ $book->pengarang }}</td>
                                <td>
                                    <span class="num font-weight-bold">{{ $book->terbit }}</span>
                                    <span class="text-muted mx-1">&middot;</span>
                                    <span class="desk-pill desk-pill-slate">{{ $book->kategori }}</span>
                                </td>
                                <td>
                                    @include('partials.stock-meter', ['book' => $book])
                                </td>
                                <td class="text-right text-nowrap">
                                    <a href="{{ route('book.edit', $book->id) }}" class="btn-desk btn-desk-secondary btn-desk-sm" title="Ubah data buku">
                                        <i class="fas fa-pen"></i>
                                        <span>Edit</span>
                                    </a>
                                    @if ($book->dipinjam > 0)
                                        <button type="button" class="btn-desk btn-desk-ghost btn-desk-sm text-muted" disabled title="Tidak dapat dihapus saat masih ada eksemplar dipinjam">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                    @else
                                        <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="d-inline js-confirm-action" data-title="Hapus Buku?" data-text="Buku {{ $book->judul }} akan dihapus permanen dari katalog." data-confirm="Ya, hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-desk btn-desk-danger btn-desk-sm" title="Hapus buku">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
            $('#booksTable').DataTable({
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ entri',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ buku',
                    infoEmpty: 'Belum ada data buku',
                    zeroRecords: 'Tidak ada buku yang cocok',
                    paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
                }
            });
        });
    </script>
@endsection

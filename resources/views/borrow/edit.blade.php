@extends('layouts.admin')

@section('title', 'Edit Transaksi Peminjaman — SIPerpustakaan')
@section('crumb', 'Peminjaman / Edit')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Edit Transaksi Peminjaman</h1>
            <p class="page-desc">Perbarui tanggal jatuh tempo atau status pengembalian transaksi ini.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('borrow') }}" class="btn-desk btn-desk-secondary">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Sirkulasi</span>
            </a>
        </div>
    </div>

    <section class="sheet desk-form-grid">
        <div class="sheet-head">
            <h2 class="sheet-title">Detail Transaksi #{{ $borrow->id }}</h2>
        </div>
        <div class="sheet-body">
            <form action="{{ route('borrow.update', $borrow->id) }}" method="POST">
                @csrf
                @method('patch')

                <div class="desk-field">
                    <label for="kode_buku" class="desk-label">Kode Buku<span class="req">*</span></label>
                    <input id="kode_buku" name="kode_buku" list="kode_bukus" class="desk-input mono @error('kode_buku') is-invalid @enderror" value="{{ old('kode_buku', $borrow->kode_buku) }}" required>
                    <datalist id="kode_bukus">
                        @foreach ($books as $book)
                            <option value="{{ $book->kode }}">{{ $book->judul }}</option>
                        @endforeach
                    </datalist>
                    @error('kode_buku')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="desk-field">
                    <label for="nispeminjam" class="desk-label">NIS Peminjam<span class="req">*</span></label>
                    <input id="nispeminjam" name="nispeminjam" list="nispeminjams" class="desk-input mono @error('nispeminjam') is-invalid @enderror" value="{{ old('nispeminjam', $borrow->nispeminjam) }}" required>
                    <datalist id="nispeminjams">
                        @foreach ($members as $member)
                            <option value="{{ $member->nis }}">{{ $member->nama }}</option>
                        @endforeach
                    </datalist>
                    @error('nispeminjam')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 desk-field">
                        <label for="tanggalpinjam" class="desk-label">Tanggal Pinjam<span class="req">*</span></label>
                        <input id="tanggalpinjam" type="date" name="tanggalpinjam" class="desk-input mono @error('tanggalpinjam') is-invalid @enderror" value="{{ old('tanggalpinjam', $borrow->tanggalpinjam) }}" required>
                        @error('tanggalpinjam')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 desk-field">
                        <label for="tanggalwajibkembali" class="desk-label">Jatuh Tempo<span class="req">*</span></label>
                        <input id="tanggalwajibkembali" type="date" name="tanggalwajibkembali" class="desk-input mono @error('tanggalwajibkembali') is-invalid @enderror" value="{{ old('tanggalwajibkembali', $borrow->tanggalwajibkembali) }}" required>
                        @error('tanggalwajibkembali')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 desk-field">
                        <label for="tanggalkembali" class="desk-label">Tanggal Kembali</label>
                        <input id="tanggalkembali" type="date" name="tanggalkembali" class="desk-input mono @error('tanggalkembali') is-invalid @enderror" value="{{ old('tanggalkembali', $borrow->tanggalkembali) }}">
                        <div class="desk-help">Kosongkan bila buku belum dikembalikan.</div>
                    </div>
                </div>

                <div class="pt-3 border-top d-flex flex-wrap" style="gap: 10px;">
                    <button type="submit" class="btn-desk btn-desk-primary">
                        <i class="fas fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('borrow') }}" class="btn-desk btn-desk-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection

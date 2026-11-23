@extends('layouts.admin')

@section('title', 'Edit Buku — SIPerpustakaan')
@section('crumb', 'Katalog Buku / Edit')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Edit Data Buku</h1>
            <p class="page-desc">Perbarui metadata koleksi dan jumlah eksemplar untuk <span class="mono">{{ $book->kode }}</span>.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('book') }}" class="btn-desk btn-desk-secondary">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Katalog</span>
            </a>
        </div>
    </div>

    <section class="sheet desk-form-grid">
        <div class="sheet-head">
            <h2 class="sheet-title">{{ $book->judul }}</h2>
        </div>
        <div class="sheet-body">
            <form action="{{ route('book.update', $book->id) }}" method="POST">
                @csrf
                @method('patch')

                <div class="row">
                    <div class="col-md-5 desk-field">
                        <label for="kode" class="desk-label">Kode Buku<span class="req">*</span></label>
                        <input id="kode" type="text" name="kode" class="desk-input mono @error('kode') is-invalid @enderror" value="{{ old('kode', $book->kode) }}" required>
                        @error('kode')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-7 desk-field">
                        <label for="kategori" class="desk-label">Kategori<span class="req">*</span></label>
                        <input id="kategori" type="text" name="kategori" class="desk-input @error('kategori') is-invalid @enderror" value="{{ old('kategori', $book->kategori) }}" required>
                        @error('kategori')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="desk-field">
                    <label for="judul" class="desk-label">Judul Buku<span class="req">*</span></label>
                    <input id="judul" type="text" name="judul" class="desk-input @error('judul') is-invalid @enderror" value="{{ old('judul', $book->judul) }}" required>
                    @error('judul')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="desk-field">
                    <label for="pengarang" class="desk-label">Pengarang<span class="req">*</span></label>
                    <input id="pengarang" type="text" name="pengarang" class="desk-input @error('pengarang') is-invalid @enderror" value="{{ old('pengarang', $book->pengarang) }}" required>
                    @error('pengarang')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 desk-field">
                        <label for="terbit" class="desk-label">Tahun Terbit<span class="req">*</span></label>
                        <input id="terbit" type="number" name="terbit" class="desk-input num @error('terbit') is-invalid @enderror" value="{{ old('terbit', $book->terbit) }}" required>
                        @error('terbit')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 desk-field">
                        <label for="jumlah" class="desk-label">Total Eksemplar<span class="req">*</span></label>
                        <input id="jumlah" type="number" min="0" name="jumlah" class="desk-input num @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $book->jumlah) }}" required>
                        @error('jumlah')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 desk-field">
                        <label for="dipinjam" class="desk-label">Sedang Dipinjam<span class="req">*</span></label>
                        <input id="dipinjam" type="number" min="0" name="dipinjam" class="desk-input num @error('dipinjam') is-invalid @enderror" value="{{ old('dipinjam', $book->dipinjam) }}" required>
                        @error('dipinjam')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @else
                            <div class="desk-help">Tidak boleh melebihi total eksemplar.</div>
                        @enderror
                    </div>
                </div>

                <div class="pt-3 border-top d-flex flex-wrap" style="gap: 10px;">
                    <button type="submit" class="btn-desk btn-desk-primary">
                        <i class="fas fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('book') }}" class="btn-desk btn-desk-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection

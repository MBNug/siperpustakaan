@extends('layouts.admin')

@section('title', 'Tambah Buku — SIPerpustakaan')
@section('crumb', 'Katalog Buku / Tambah')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Tambah Buku Baru</h1>
            <p class="page-desc">Daftarkan judul buku baru beserta jumlah eksemplar ke katalog perpustakaan.</p>
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
            <h2 class="sheet-title">Identitas &amp; Stok Buku</h2>
        </div>
        <div class="sheet-body">
            <form action="{{ route('book.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5 desk-field">
                        <label for="kode" class="desk-label">Kode Buku<span class="req">*</span></label>
                        <input id="kode" type="text" name="kode" class="desk-input mono @error('kode') is-invalid @enderror" placeholder="Mis. BK-001" value="{{ old('kode') }}" required>
                        @error('kode')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-7 desk-field">
                        <label for="kategori" class="desk-label">Kategori<span class="req">*</span></label>
                        <input id="kategori" type="text" name="kategori" class="desk-input @error('kategori') is-invalid @enderror" placeholder="Mis. Fiksi, Referensi, Sains" value="{{ old('kategori') }}" required>
                        @error('kategori')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="desk-field">
                    <label for="judul" class="desk-label">Judul Buku<span class="req">*</span></label>
                    <input id="judul" type="text" name="judul" class="desk-input @error('judul') is-invalid @enderror" placeholder="Judul lengkap buku" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="desk-field">
                    <label for="pengarang" class="desk-label">Pengarang<span class="req">*</span></label>
                    <input id="pengarang" type="text" name="pengarang" class="desk-input @error('pengarang') is-invalid @enderror" placeholder="Nama penulis atau penyusun" value="{{ old('pengarang') }}" required>
                    @error('pengarang')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 desk-field">
                        <label for="terbit" class="desk-label">Tahun Terbit<span class="req">*</span></label>
                        <input id="terbit" type="number" name="terbit" class="desk-input num @error('terbit') is-invalid @enderror" placeholder="Mis. 2024" value="{{ old('terbit') }}" required>
                        @error('terbit')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 desk-field">
                        <label for="jumlah" class="desk-label">Jumlah Eksemplar<span class="req">*</span></label>
                        <input id="jumlah" type="number" min="0" name="jumlah" class="desk-input num @error('jumlah') is-invalid @enderror" placeholder="Mis. 10" value="{{ old('jumlah') }}" required>
                        @error('jumlah')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="pt-3 border-top d-flex flex-wrap" style="gap: 10px;">
                    <button type="submit" class="btn-desk btn-desk-primary">
                        <i class="fas fa-plus"></i>
                        <span>Simpan Buku</span>
                    </button>
                    <a href="{{ route('book') }}" class="btn-desk btn-desk-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection

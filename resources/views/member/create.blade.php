@extends('layouts.admin')

@section('title', 'Tambah Anggota — SIPerpustakaan')
@section('crumb', 'Anggota / Tambah')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Daftarkan Anggota Baru</h1>
            <p class="page-desc">NIS baru langsung dapat digunakan pada halaman absensi pengunjung maupun peminjaman buku.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('member') }}" class="btn-desk btn-desk-secondary">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Anggota</span>
            </a>
        </div>
    </div>

    <section class="sheet desk-form-grid">
        <div class="sheet-head">
            <h2 class="sheet-title">Profil Anggota</h2>
        </div>
        <div class="sheet-body">
            <form action="{{ route('member.store') }}" method="POST">
                @csrf
                <div class="desk-field">
                    <label for="nis" class="desk-label">Nomor Induk Siswa (NIS)<span class="req">*</span></label>
                    <input id="nis" type="text" name="nis" class="desk-input mono @error('nis') is-invalid @enderror" placeholder="Mis. 20240101" value="{{ old('nis') }}" required>
                    @error('nis')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="desk-field">
                    <label for="nama" class="desk-label">Nama Lengkap<span class="req">*</span></label>
                    <input id="nama" type="text" name="nama" class="desk-input @error('nama') is-invalid @enderror" placeholder="Nama lengkap anggota" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="desk-field">
                    <label for="alamat" class="desk-label">Alamat / Kelas<span class="req">*</span></label>
                    <input id="alamat" type="text" name="alamat" class="desk-input @error('alamat') is-invalid @enderror" placeholder="Alamat domisili atau kelas" value="{{ old('alamat') }}" required>
                    @error('alamat')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="pt-3 border-top d-flex flex-wrap" style="gap: 10px;">
                    <button type="submit" class="btn-desk btn-desk-primary">
                        <i class="fas fa-user-plus"></i>
                        <span>Simpan Anggota</span>
                    </button>
                    <a href="{{ route('member') }}" class="btn-desk btn-desk-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Anggota — SIPerpustakaan')
@section('crumb', 'Anggota / Edit')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Edit Data Anggota</h1>
            <p class="page-desc">Perbarui identitas dan catatan kunjungan untuk <span class="mono">{{ $member->nis }}</span>.</p>
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
            <h2 class="sheet-title">{{ $member->nama }}</h2>
        </div>
        <div class="sheet-body">
            <form action="{{ route('member.update', $member->id) }}" method="POST">
                @csrf
                @method('patch')

                <div class="desk-field">
                    <label for="nis" class="desk-label">Nomor Induk Siswa (NIS)<span class="req">*</span></label>
                    <input id="nis" type="text" name="nis" class="desk-input mono @error('nis') is-invalid @enderror" value="{{ old('nis', $member->nis) }}" required>
                    @error('nis')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="desk-field">
                    <label for="nama" class="desk-label">Nama Lengkap<span class="req">*</span></label>
                    <input id="nama" type="text" name="nama" class="desk-input @error('nama') is-invalid @enderror" value="{{ old('nama', $member->nama) }}" required>
                    @error('nama')
                        <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-8 desk-field">
                        <label for="alamat" class="desk-label">Alamat / Kelas<span class="req">*</span></label>
                        <input id="alamat" type="text" name="alamat" class="desk-input @error('alamat') is-invalid @enderror" value="{{ old('alamat', $member->alamat) }}" required>
                        @error('alamat')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 desk-field">
                        <label for="jmlkunjungan" class="desk-label">Jumlah Kunjungan<span class="req">*</span></label>
                        <input id="jmlkunjungan" type="number" min="0" name="jmlkunjungan" class="desk-input num @error('jmlkunjungan') is-invalid @enderror" value="{{ old('jmlkunjungan', $member->jmlkunjungan) }}" required>
                        @error('jmlkunjungan')
                            <div class="text-danger mt-1" style="font-size: 12.5px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="pt-3 border-top d-flex flex-wrap" style="gap: 10px;">
                    <button type="submit" class="btn-desk btn-desk-primary">
                        <i class="fas fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('member') }}" class="btn-desk btn-desk-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection

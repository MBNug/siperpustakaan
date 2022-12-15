@extends('layouts.admin')

@section('title', 'Tambah Buku')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        <a href="{{ route('book') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-chevron-left fa-sm text-white-50"></i> Kembali</a>
    </div>
    <div class="col-lg-12 p-0">
        <small>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-tachometer-alt mr-1"></i> Home</a></li>
                <li><a href="{{ route('book') }}" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-chevron-right fa-sm mr-2"></i>Buku</a></li>
                <li class="active"><i class="fa fa-chevron-right fa-sm mr-2"></i>Tambah Buku</li>
            </ol>
        </small>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container mt-3 mb-2">

                <form action="{{ route('book.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Kode Buku*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" placeholder="Kode Buku" value="{{ old('kode') }}">
                            @error('kode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Judul Buku*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" placeholder="Judul Buku" value="{{ old('judul') }}">
                            @error('judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Pengarang Buku*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('pengarang') is-invalid @enderror" name="pengarang" placeholder="Pengarang Buku" value="{{ old('pengarang') }}">
                            @error('pengarang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Tahun Terbit*</label>
                        <div class="col-lg-10">
                            <input type="number" min="1900" class="form-control @error('terbit') is-invalid @enderror" name="terbit" placeholder="Tahun Terbit" value="{{ old('terbit') }}">
                            @error('terbit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Kategori*</label>
                        <div class="col-lg-10">
                            <select id="kategori" class="form-control custom-select @error('kategori') is-invalid @enderror"  name="kategori" placeholder="Kategori" value="{{ old('kategori') }}">
                                <option selected disabled>Pilih Salah Satu</option>
                                <option>Umum</option>
                                <option>Filsafat dan Psikologi</option>
                                <option>Agama</option>
                                <option>Sosial</option>
                                <option>Bahasa</option>
                                <option>Sains dan Matematika</option>
                                <option>Teknologi</option>
                                <option>Seni dan Rekreasi</option>
                                <option>Literatur dan Sastra</option>
                                <option>Sejarah dan Geografi</option>
                            </select>
                            {{-- <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" placeholder="Kategori" value="{{ old('kategori') }}"> --}}
                            @error('kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Jumlah*</label>
                        <div class="col-lg-10">
                            <input type="number" min="0" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" placeholder="Jumlah Buku" value="{{ old('jumlah') }}">
                            @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Tambah</button>
                        <a href="{{ route('book') }}" id="back" class="btn btn-light"><i class="fa fa-times mr-2"></i> Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

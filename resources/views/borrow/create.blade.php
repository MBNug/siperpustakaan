{{-- @dd($borrows) --}}
{{-- @dd($members) --}}
@extends('layouts.admin')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        <a href="{{ route('borrow') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-chevron-left fa-sm text-white-50"></i> Kembali</a>
    </div>
    <div class="col-lg-12 p-0">
        <small>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-tachometer-alt mr-1"></i> Home</a></li>
                <li><a href="{{ route('borrow') }}" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-chevron-right fa-sm mr-2"></i>Peminjaman</a></li>
                <li class="active"><i class="fa fa-chevron-right fa-sm mr-2"></i>Tambah Peminjaman</li>
            </ol>
        </small>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container mt-3 mb-2">

                <form action="{{ route('borrow.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Kode Buku*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('kode_buku') is-invalid @enderror" list="kode_bukus" id="kode_buku" name="kode_buku" placeholder="Kode Buku" value="{{ old('kode_buku') }}">
                            <datalist id="kode_bukus" name="kode_buku">
                                @foreach ($books as $book )
                                    <option value="{{$book->kode}}">{{ $book->judul }}</option>
                                @endforeach
                            </datalist>
                            @error('kode_buku')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">NIS Peminjam*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('nispeminjam') is-invalid @enderror" list="nispeminjams" id="nispeminjam" name="nispeminjam" placeholder="NIS Peminjam" value="{{ old('nispeminjam') }}">
                            <datalist id="nispeminjams" name="nispeminjam">
                                @foreach ($members as $member )
                                    <option value="{{$member->nis}}">{{ $member->nama }}</option>
                                @endforeach
                            </datalist>
                            @error('nispeminjam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Tanggal Pinjam*</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control @error('tanggalpinjam') is-invalid @enderror" name="tanggalpinjam" placeholder="Tanggal Pinjam" value="{{ old('tanggalpinjam') }}">
                            @error('tanggalpinjam')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Tanggal Wajib Kembali*</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control @error('tanggalwajibkembali') is-invalid @enderror" name="tanggalwajibkembali" placeholder="Tanggal Wajib Kembali" value="{{ old('tanggalwajibkembali') }}">
                            @error('tanggalwajibkembali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Tambah</button>
                        <a href="{{ route('borrow') }}" id="back" class="btn btn-light"><i class="fa fa-times mr-2"></i> Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

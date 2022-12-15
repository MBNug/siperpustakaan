@extends('layouts.admin')

@section('title', 'Tambah Anggota')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        <a href="{{ route('member') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-chevron-left fa-sm text-white-50"></i> Kembali</a>
    </div>
    <div class="col-lg-12 p-0">
        <small>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-tachometer-alt mr-1"></i> Home</a></li>
                <li><a href="{{ route('member') }}" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-chevron-right fa-sm mr-2"></i>Anggota</a></li>
                <li class="active"><i class="fa fa-chevron-right fa-sm mr-2"></i>Tambah Anggota</li>
            </ol>
        </small>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container mt-3 mb-2">

                <form action="{{ route('member.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Nomor Induk Siswa*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" placeholder="NIS" value="{{ old('nis') }}">
                            @error('nis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Nama*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Nama" value="{{ old('nama') }}">
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Alamat*</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Tambah</button>
                        <a href="{{ route('member') }}" id="back" class="btn btn-light"><i class="fa fa-times mr-2"></i> Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Anggota')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <section class="content-header">
        <div class="row">
            <div class="col-lg-9">
                <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            </div>
            <div class="col-lg-3">
                <small>
                    <ol class="breadcrumb">
                        <li><a href="" class="text-decoration-none text-gray-800 mr-2"><i class="fa fa-tachometer-alt mr-1"></i> Home</a></li>
                        <li class="active"><i class="fa fa-chevron-right fa-sm mr-2"></i>Anggota</li>
                    </ol>
                </small>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-lg">
            <a href="{{ route('member.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus mr-2"></i>Tambah Anggota Baru</a>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Kunjungan</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Jumlah Pinjaman yang belum kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $member->nis }}</td>
                                    <td>{{ $member->nama }}</td>
                                    <td>{{ $member->alamat }}</td>
                                    <td>{{ $member->jmlkunjungan }}</td>
                                    <td>{{ $borrows->where('nispeminjam', '=', $member->nis)->count('nispeminjam')}}</td>
                                    <td>{{ $borrows->where('nispeminjam', '=', $member->nis)->where('tanggalkembali','=',null)->count('nispeminjam')}}</td>
                                    <td>
                                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-warning btn-sm mt-1" title="Edit Anggota"><i class="fa fa-edit"></i>     Edit</a>
                                        <a data-toggle="modal" id="smallButton" class="btn btn-danger btn-sm mt-1" data-target="#smallModal" data-attr="{{ route('member.delete', $member->id) }}" title="Hapus Anggota">
                                            <i class="fas fa-trash "></i>      Hapus
                                        </a>
                                        <a href="{{ route('member.lihatpinjaman', $member->id) }}" class="btn btn-success btn-sm mt-1" title="Lihat Pinjaman Anggota"><i class="fa fa-file-export"></i>     Pinjaman</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

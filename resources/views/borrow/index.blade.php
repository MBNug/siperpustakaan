{{-- @dd($borrows) --}}
@extends('layouts.admin')

@section('title', 'Daftar Peminjaman')

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
                        <li class="active"><i class="fa fa-chevron-right fa-sm mr-2"></i>Peminjaman</li>
                    </ol>
                </small>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-lg">
            <a href="{{ route('borrow.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus mr-2"></i>Tambah Peminjaman Baru</a>
            <a href="/borrow/export-excel" class="btn btn-primary mb-3"><i class="fa fa-file-export mr-2"></i>Export Peminjaman</a>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>NIS</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal dipinjam</th>
                                    <th>Tanggal harus kembali</th>
                                    <th>Tanggal kembali</th>
                                    <th>Telat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrows as $borrow)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $borrow->kode_buku }}</td>
                                    <td>{{ $borrow->book->judul }}</td>
                                    <td>{{ $borrow->nispeminjam }}</td>
                                    <td>{{ $borrow->member->nama }}</td>
                                    <td>{{ $borrow->tanggalpinjam }}</td>
                                    <td>{{ $borrow->tanggalwajibkembali }}</td>
                                    @if ($borrow->tanggalkembali === null)
                                        <td>Belum dikembalikan</td>
                                        @php
                                            $telat = \Carbon\Carbon::parse($borrow->tanggalwajibkembali)->diffInDays(\Carbon\Carbon::parse(now()), false);
                                        @endphp
                                        @if ($telat < 0)
                                            <td>0</td>
                                        @else
                                            <td>{{ $telat }}</td>
                                        @endif
                                    @else
                                        <td>{{ $borrow->tanggalkembali }}</td>
                                        <td>{{ $borrow->telat }}</td>
                                    @endif
                                    
                                    <td>
                                        <a href="{{ route('borrow.edit', $borrow->id) }}" class="btn btn-warning btn-sm mt-1" title="Edit peminjaman"><i class="fa fa-edit"></i>     Edit</a>
                                        <a data-toggle="modal" id="smallButton" class="btn btn-danger btn-sm mt-1" data-target="#smallModal" data-attr="{{ route('borrow.delete', $borrow->id) }}" title="Hapus Peminjaman">
                                            <i class="fas fa-trash "></i>      Hapus
                                        </a>
                                        
                                        @if ($borrow->tanggalkembali === null)
                                            <a href="{{ route('borrow.kembalikan',$borrow->id) }}" class="btn btn-success btn-sm mt-1" data-text="Borrow" title="Kembalikan Buku"><i class="fa fa-calendar-check"></i>     Kembalikan</a>
                                        
                                        @endif
                                        
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

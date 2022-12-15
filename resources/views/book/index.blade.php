@extends('layouts.admin')

@section('title', 'Kelola Buku')

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
                        <li class="active"><i class="fa fa-chevron-right fa-sm mr-2"></i>Buku</li>
                    </ol>
                </small>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-lg">
            <a href="{{ route('book.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus mr-2"></i>Tambah Buku Baru</a>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Tahun Terbit</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Total</th>
                                    <th>Jumlah Dipinjam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $book->kode }}</td>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->pengarang }}</td>
                                    <td>{{ $book->terbit }}</td>
                                    <td>{{ $book->kategori }}</td>
                                    <td>{{ $book->jumlah }}</td>
                                    <td>{{ $book->dipinjam }}</td>
                                    <td>
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning btn-sm mt-1" title="Edit Buku"><i class="fa fa-edit"></i>     Edit</a>
                                        <a data-toggle="modal" id="smallButton" class="btn btn-danger btn-sm mt-1" data-target="#smallModal" data-attr="{{ route('book.delete', $book->id) }}" title="Hapus Buku">
                                            <i class="fas fa-trash "></i>      Hapus
                                        </a>
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

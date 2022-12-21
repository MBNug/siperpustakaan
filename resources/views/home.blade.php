@extends('layouts.guest')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5 text-center">
    <h2>Presensi</h2>
    <p>Masukan Nomor Induk Siswa Anda</p>
</div>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ route('home.hadir') }}" method="post">
                @csrf
                <label for="exampleDataList" class="form-label">NIS</label>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" list="niss" id="nis" name="nis" placeholder="Nomor Induk Siswa" value="{{ old('nis') }}">
                            <datalist id="niss" name="nis">
                                @foreach ($members as $member )
                                    <option value="{{$member->nis}}">{{ $member->nama }}</option>
                                @endforeach
                            </datalist>
                            @error('nis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Absen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

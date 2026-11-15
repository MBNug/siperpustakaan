@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container mt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-5 mt-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg col-sm col-md p-4">
                            <div class="p-lg-4 p-4 p-md-4">
                                <div class="text-center">
                                    <h3 class="text-gray mb-4 nav-link"><strong><a href="{{ route('home') }}">Home</a></strong></h3>
                                    <h1 class="h4 text-gray-900 mb-4">Masuk ke akun admin</h1>
                                </div>

                                @error('active')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <form class="user" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="text" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required placeholder="Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                @if (config('app.demo_mode') && config('app.demo_login_password'))
                                    <div class="alert alert-info mt-3 mb-0 small">
                                        <div class="font-weight-bold mb-1">Akun Demo Admin</div>
                                        <div>Email: <code>{{ config('app.demo_login_email') }}</code></div>
                                        <div>Password: <code>{{ config('app.demo_login_password') }}</code></div>
                                        <div class="text-muted mt-1">Database di-reset otomatis setiap hari pukul 03:00 WIB.</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

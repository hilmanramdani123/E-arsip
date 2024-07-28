@extends('layouts.main')

@section('content')
<div class="wrapper">
    <div class="logo">
        <img src="{{ asset('image/ptpn1.jpg') }}" alt="Logo PTPN">
    </div>
    <div class="text-center mt-4 name">E-Arsip Sub Bagian Kawasan</div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </form>
</div>
@endsection

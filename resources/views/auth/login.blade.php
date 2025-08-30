@php
    use Illuminate\Support\Facades\DB;

    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 50vh;">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
            <div class="border rounded px-4 py-4 shadow-sm">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Ilustrasi aplikasi Organisasi" class="img-fluid" style="max-height: 150px;">
                    </div>

                    <h1 class="text-center mb-4">Login</h1>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $item)
                            <p class="text-center mb-0">{{ $item }}</p>
                        @endforeach
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        @error('email')
                        <p class="text-danger fw-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" autocomplete="current-password">
                        @error('password')
                        <p class="text-danger fw-bold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <p class="text-center mb-1">
                        Belum Punya Akun? <a href="/register">Buat Akun</a>
                    </p>

                    @if (Route::has('password.request'))
                    <p class="text-center mb-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Password?</a>
                    </p>
                    @endif

                    <div class="text-center">
                        <a href="/" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

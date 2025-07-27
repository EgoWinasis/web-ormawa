@extends('layouts.app')
<title>VERIFIKASI</title>
@section('content')
<div class="container py-5">
    <h1 class="text-center">Verifikasi Alamat Email Anda</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    <p>{{ __('Sebelum melanjutkan, harap periksa email Anda untuk link verifikasi.') }}</p>
                    <p>{{ __('Jika Anda tidak menerima email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk meminta link verifikasi lainnya') }}</button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
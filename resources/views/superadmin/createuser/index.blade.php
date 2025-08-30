@extends('superadmin.layoutsuper.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Tambah Admin Baru</h5>
                </div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('tambahAdmin') }}">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name-input" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-input"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email-input" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email-input" name="email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Unit / Organisasi --}}
                        <div class="mb-3">
                            <label for="organisasi-input" class="form-label">Unit / Organisasi</label>
                            <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror"
                                id="organisasi-input" name="nama_organisasi" value="{{ old('nama_organisasi') }}">
                            @error('nama_organisasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info text-white">
                                <i class="fa-solid fa-user-plus me-2"></i> Tambah Admin
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-3 text-muted fst-italic text-center">Note: Tolong double check untuk data yang di-input 🙌
            </p>

        </div>
    </div>
</div>

@endsection

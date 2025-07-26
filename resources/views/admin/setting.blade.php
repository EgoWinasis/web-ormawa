@extends('superadmin.layoutsuper.main')

@section('konten')
<div class="container py-5">
    <h2 class="mb-4 text-center">Pengaturan Brand Image</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow p-4">
        <form action="{{ route('admin.setting.updateBrandImage') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="brand_image" class="form-label">Upload Brand Image (Navbar)</label>
                <input type="file" name="brand_image" id="brand_image" class="form-control @error('brand_image') is-invalid @enderror" required>
                @error('brand_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

          @php
    $imagePath = $brandImage
        ? asset('storage/file-logo/' . $brandImage)
        : asset('storage/file-logo/landing-page.png');
@endphp

<div class="mb-3">
    <p>Brand Image Saat Ini:</p>
    <img src="{{ $imagePath }}" alt="Brand Image" style="max-height: 80px;">
</div>



            <button type="submit" class="btn btn-primary">Update Brand Image</button>
        </form>
    </div>
</div>
@endsection

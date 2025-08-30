@php
    use Illuminate\Support\Facades\DB;

    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<div class="container py-2">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" 
                 alt="Logo Ormawa" 
                 class="img-fluid" 
                 style="max-width: 100px; height: auto;">
        </div>

        <!-- Profile -->
        <div class="d-flex align-items-center gap-3 mt-2 mt-sm-0">
            <p class="mb-0 fw-semibold">{{ $user->name }}</p>
            <img src="{{ asset('storage/' . $user->foto) }}" 
                 alt="Foto Profile" 
                 class="rounded-circle" 
                 style="width: 60px; height: 60px; object-fit: cover;">
        </div>
    </div>
</div>

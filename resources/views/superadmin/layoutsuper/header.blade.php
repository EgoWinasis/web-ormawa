@php
    use Illuminate\Support\Facades\DB;

    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<div class="nav-container">
    <div class="nav-logo">
        <div class="logo-container">
           <img class="logo-ormawa"
     src="{{ Storage::url('file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}"
     alt="Logo Ormawa" width="100px">

        </div>
    </div>
    <div class="nav-profile d-flex">
        <p class="nama">Super Admin</p>
        <div class="foto-container">
            <img class='profile-foto' src="{{ asset('storage/file-logo/logo-phb.png') }}" alt="poto profile"
                width="100px">
        </div>
    </div>
</div>

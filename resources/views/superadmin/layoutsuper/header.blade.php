@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Tombol sidebar toggle (hanya muncul di mobile) -->
        <button class="btn btn-outline-primary d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo" style="max-height: 40px;" class="me-2">
            <span class="fw-bold">Ormawa</span>
        </a>

        <!-- Profile -->
        <div class="d-flex align-items-center ms-auto">
            <p class="mb-0 fw-semibold me-3 text-truncate" style="max-width: 150px;">{{ $user->name }}</p>
            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
        </div>
    </div>
</nav>

<!-- SIDEBAR -->
<div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="nav flex-column">
            <a href="#" class="nav-link px-3 py-2">Dashboard</a>
            <a href="#" class="nav-link px-3 py-2">News</a>
            <a href="#" class="nav-link px-3 py-2">Arsip</a>
            <a href="#" class="nav-link px-3 py-2">Data Ormawa</a>
            <a href="#" class="nav-link px-3 py-2">Create User</a>
            <a href="#" class="nav-link px-3 py-2">Profile</a>
            <a href="#" class="nav-link px-3 py-2">Mahasiswa</a>
            <a href="#" class="nav-link px-3 py-2">Pengaturan</a>
            <a href="#" class="nav-link px-3 py-2 text-danger">Keluar</a>
        </nav>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar untuk layar besar -->
        <nav id="sidebarDesktop" class="col-lg-2 d-none d-lg-block bg-light vh-100 p-3">
            <nav class="nav flex-column">
                <a href="#" class="nav-link px-3 py-2">Dashboard</a>
                <a href="#" class="nav-link px-3 py-2">News</a>
                <a href="#" class="nav-link px-3 py-2">Arsip</a>
                <a href="#" class="nav-link px-3 py-2">Data Ormawa</a>
                <a href="#" class="nav-link px-3 py-2">Create User</a>
                <a href="#" class="nav-link px-3 py-2">Profile</a>
                <a href="#" class="nav-link px-3 py-2">Mahasiswa</a>
                <a href="#" class="nav-link px-3 py-2">Pengaturan</a>
                <a href="#" class="nav-link px-3 py-2 text-danger">Keluar</a>
            </nav>
        </nav>

        <!-- Konten utama -->
        <main class="col-lg-10 p-4">
            {{-- Tempat konten dinamis --}}
            @yield('content')
        </main>
    </div>
</div>

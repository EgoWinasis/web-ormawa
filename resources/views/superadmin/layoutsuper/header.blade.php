@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<!-- Font Awesome & Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Style -->
<style>
    .active {
        background-color: #29A1D4;
        font-weight: bold;
        color: white !important;
    }
    .nav-link {
        color: #000;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .nav-link:hover {
        background-color: #29A1D4;
                color: black !important;


    }
    .nav-link i {
        width: 20px;
        text-align: center;
    }
</style>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #29A1D4;">
    <div class="container-fluid">
        <!-- Sidebar toggle (mobile only) -->
        <button class="btn btn-outline-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo" style="max-height: 40px;" class="me-2">
            <span class="fw-bold text-white">Ormawa</span>
        </a>

        {{-- <!-- Profile -->
        <div class="d-flex align-items-center ms-auto">
            <p class="mb-0 fw-semibold me-3 text-truncate text-white" style="max-width: 150px;">{{ $user->name }}</p>
            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
        </div> --}}
    </div>
</nav>

<!-- SIDEBAR: MOBILE -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav flex-column px-2">
            <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.news') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.news') }}">
                    <i class="fas fa-bullhorn"></i> News
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.arsip') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.arsip') }}">
                    <i class="fas fa-bookmark"></i> Arsip
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.absensi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.absensi') }}">
                    <i class="fas fa-box"></i> Data Ormawa
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.tambahAdminView') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.tambahAdminView') }}">
                    <i class="fas fa-user-plus"></i> Create User
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.profile') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user-circle"></i> Data Profile
                </a>
            </li>
            <li class="nav-item {{ Route::is('mahasiswa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa') }}">
                    <i class="fas fa-user-graduate"></i> Data Mahasiswa
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin.setting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.setting') }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<!-- SIDEBAR: DESKTOP -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 d-none d-lg-block bg-light vh-100 p-0">
            <ul class="nav flex-column px-2 pt-3">
                <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.news') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.news') }}">
                        <i class="fas fa-bullhorn"></i> News
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.arsip') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.arsip') }}">
                        <i class="fas fa-bookmark"></i> Arsip
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.absensi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.absensi') }}">
                        <i class="fas fa-box"></i> Data Ormawa
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.tambahAdminView') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.tambahAdminView') }}">
                        <i class="fas fa-user-plus"></i> Create User
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-circle"></i> Data Profile
                    </a>
                </li>
                <li class="nav-item {{ Route::is('mahasiswa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa') }}">
                        <i class="fas fa-user-graduate"></i> Data Mahasiswa
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.setting') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.setting') }}">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-lg-10 p-4">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

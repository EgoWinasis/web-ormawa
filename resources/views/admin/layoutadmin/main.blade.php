@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Ormawa</title>

    <!-- Font Awesome & Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
            color: white !important;
        }
        .nav-link i {
            width: 20px;
            text-align: center;
        }

        @media (min-width: 992px) {
            .main-content {
                margin-left: 250px;
            }
            .sidebar-desktop {
                position: fixed;
                top: 56px;
                left: 0;
                width: 250px;
                height: calc(100% - 56px);
                overflow-y: auto;
                background-color: #f8f9fa;
            }
        }
        body {
            padding-top: 56px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #29A1D4;">
    <div class="container-fluid">
        <button class="btn btn-outline-light d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo" style="max-height: 40px;" class="me-2">
            <span class="fw-bold text-white">Ormawa</span>
        </a>
    </div>
</nav>

<!-- SIDEBAR: MOBILE -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav flex-column px-2">
            @includeWhen(View::exists('partials.sidebar-items'), 'partials.sidebar-items')
        </ul>
    </div>
</div>

<!-- SIDEBAR: DESKTOP -->
<div class="sidebar-desktop d-none d-lg-block">
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
<div class="main-content p-4">
    @yield('konten')
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

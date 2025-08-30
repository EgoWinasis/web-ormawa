@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

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
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #29A1D4;">
    <div class="container-fluid">
        <button class="btn btn-outline-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="fas fa-bars"></i>
        </button>

        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo" style="max-height: 40px;" class="me-2">
            <span class="fw-bold text-white">Ormawa</span>
        </a>
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
            @foreach([
                ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                ['route' => 'admin.news', 'icon' => 'fa-bullhorn', 'label' => 'News'],
                ['route' => 'admin.arsip', 'icon' => 'fa-bookmark', 'label' => 'Arsip'],
                ['route' => 'admin.absensi', 'icon' => 'fa-box', 'label' => 'Data Ormawa'],
                ['route' => 'admin.tambahAdminView', 'icon' => 'fa-user-plus', 'label' => 'Create User'],
                ['route' => 'admin.profile', 'icon' => 'fa-user-circle', 'label' => 'Data Profile'],
                ['route' => 'mahasiswa', 'icon' => 'fa-user-graduate', 'label' => 'Data Mahasiswa'],
                ['route' => 'admin.setting', 'icon' => 'fa-cog', 'label' => 'Pengaturan'],
            ] as $item)
                <li class="nav-item {{ Route::is($item['route']) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($item['route']) }}">
                        <i class="fas {{ $item['icon'] }}"></i> {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
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

<!-- MAIN LAYOUT -->
<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR: DESKTOP -->
        <div class="col-lg-2 d-none d-lg-block bg-light vh-100 p-0">
            <ul class="nav flex-column px-2 pt-3">
                @foreach([
                    ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                    ['route' => 'admin.news', 'icon' => 'fa-bullhorn', 'label' => 'News'],
                    ['route' => 'admin.arsip', 'icon' => 'fa-bookmark', 'label' => 'Arsip'],
                    ['route' => 'admin.absensi', 'icon' => 'fa-box', 'label' => 'Data Ormawa'],
                    ['route' => 'admin.tambahAdminView', 'icon' => 'fa-user-plus', 'label' => 'Create User'],
                    ['route' => 'admin.profile', 'icon' => 'fa-user-circle', 'label' => 'Data Profile'],
                    ['route' => 'mahasiswa', 'icon' => 'fa-user-graduate', 'label' => 'Data Mahasiswa'],
                    ['route' => 'admin.setting', 'icon' => 'fa-cog', 'label' => 'Pengaturan'],
                ] as $item)
                    <li class="nav-item {{ Route::is($item['route']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route($item['route']) }}">
                            <i class="fas {{ $item['icon'] }}"></i> {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
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
            @yield('konten')
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

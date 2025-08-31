@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

<!-- SIDEBAR MOBILE -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav flex-column px-2">
            @php
                $menuItems = [
                    ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                    ['route' => 'admin.news', 'icon' => 'fa-bullhorn', 'label' => 'News'],
                    ['route' => 'admin.arsip', 'icon' => 'fa-bookmark', 'label' => 'Arsip'],
                ];
                if ($user->nama_organisasi == 'bem') {
                    $menuItems[] = ['route' => 'rutin.index', 'icon' => 'fa-calendar-check', 'label' => 'Rutinitas'];
                }
                $menuItems = array_merge($menuItems, [
                    ['route' => 'admin.absensi', 'icon' => 'fa-users', 'label' => 'Pengurus'],
                    ['route' => 'admin.calon', 'icon' => 'fa-clipboard-check', 'label' => 'Seleksi Administrasi'],
                    ['route' => 'admin.wawancara', 'icon' => 'fa-comments', 'label' => 'Seleksi Wawancara'],
                    ['route' => 'admin.profile', 'icon' => 'fa-user-circle', 'label' => 'Data Profile'],
                ]);
            @endphp

            @foreach($menuItems as $item)
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
    <div class="px-3 py-2 border-top mt-3">
        <small class="text-muted d-block">
            Login sebagai:<br>
            <strong>{{ Auth::user()->name }}</strong>
        </small>
    </div>
</div>

<!-- LAYOUT -->
<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR DESKTOP -->
        <div class="col-lg-2 d-none d-lg-block bg-light vh-100 p-0">
            <ul class="nav flex-column px-2 pt-3">
                @foreach($menuItems as $item)
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
            <div class="px-3 py-2 border-top mt-3">
                <small class="text-muted d-block">
                    Login sebagai:<br>
                    <strong>{{ Auth::user()->name }}</strong>
                </small>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-lg-10 p-4">
            @yield('konten')
        </main>
    </div>
</div>

@include('chatbot')

<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

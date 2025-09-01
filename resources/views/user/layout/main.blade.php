@php
use Illuminate\Support\Facades\DB;
$brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Panel</title>

    {{-- <link rel="stylesheet" href="../../css/root.css"> --}}

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>User</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #29A1D4;">
        <div class="container-fluid">
            <button class="btn btn-outline-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo"
                    style="max-height: 40px;" class="me-2">
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
                    ['route' => 'user.index', 'icon' => 'fa-edit', 'label' => 'Form'],
                    ['route' => 'user.history', 'icon' => 'fa-box-archive', 'label' => 'Tahap Pendaftaran'],
                    ['route' => 'user.riwayat', 'icon' => 'fa-history', 'label' => 'Riwayat'],
                ] as $item)
                    <li class="nav-item {{ Route::is($item['route']) ? 'active' : '' }}">
                        <a class="nav-link d-flex align-items-center {{ Route::is($item['route']) ? 'text-primary fw-bold' : 'text-dark' }}"
                           href="{{ route($item['route']) }}">
                            <i class="fas {{ $item['icon'] }} me-2"></i> {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="nav-link text-danger bg-transparent border-0 w-100 text-start d-flex align-items-center">
                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
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
    </div>

    <!-- MAIN LAYOUT -->
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- SIDEBAR: DESKTOP -->
            <div class="col-lg-2 d-none d-lg-block bg-light d-flex flex-column min-vh-100 p-0">

                <ul class="nav flex-column px-2 pt-3">
                    @foreach([
                    ['route' => 'user.index', 'icon' => 'fa-edit', 'label' => 'Form'],
                    ['route' => 'user.history', 'icon' => 'fa-box-archive', 'label' => 'Tahap Pendaftaran'],
                    ['route' => 'user.riwayat', 'icon' => 'fa-history', 'label' => 'Riwayat'],
                    ] as $item)
                    <li class="nav-item {{ Route::is($item['route']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route($item['route']) }}">
                            <i class="fas {{ $item['icon'] }}"></i> {{ $item['label'] }}
                        </a>
                    </li>
                    @endforeach
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
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


    <!-- Bootstrap JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#anggotaTable').DataTable({
                ordering: false
            });


           
        });

   

   

      


    </script>

    @if (session('swal_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Sukses!',
                text: '{{ session('swal_success') }}',
                confirmButtonColor: '#3085d6',
            });
        });
    </script>
@endif

</body>

</html>

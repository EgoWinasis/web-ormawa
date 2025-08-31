@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Root & Landing -->
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>@yield('title', 'Website ORMAWA')</title>

    <style>
        /* Navbar */
        .nav-container {
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
        }

        .nav-logo img {
            max-height: 55px;
            object-fit: contain;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #007bff !important;
        }

        /* Dropdown */
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
@if (session('success'))
    <script>alert('Berhasil mendaftar');</script>
@endif

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm nav-container">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand nav-logo" href="#">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo ORMAWA">
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#jadwal">Jadwal Kegiatan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#organisasi" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Organisasi
                    </a>
                    <ul class="dropdown-menu">
                        @yield('dropdown-options')
                    </ul>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary text-white" href="/login">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<main>
    @yield('content')
</main>

<!-- FOOTER / SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="{{ asset('js/landing.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@include('chatbot')
</body>
</html>

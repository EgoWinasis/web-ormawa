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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">

    <!-- Google Icons -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>@yield('title', 'Website ORMAWA')</title>

    <style>
        /* Navbar Container */
        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .8rem 1.5rem;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .nav-logo img {
            max-height: 60px;
            object-fit: contain;
        }

        .nav-list {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-list a {
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: .3s;
        }

        .nav-list a:hover,
        .nav-list a.active {
            color: #007bff;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: .5rem;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .1);
            padding: .5rem 0;
            z-index: 1000;
        }

        .dropdown:hover .dropdown-options {
            display: block;
        }

        .dropdown-options .dropdown-item {
            padding: .5rem 1rem;
            color: #333;
            text-decoration: none;
            display: block;
        }

        .dropdown-options .dropdown-item:hover {
            background: #f8f9fa;
        }

        .nav-button .btn a {
            background: #007bff;
            color: #fff;
            padding: .5rem 1rem;
            border-radius: .4rem;
            text-decoration: none;
        }

        .nav-button .btn a:hover {
            background: #0056b3;
        }

        /* Responsive Navbar */
        @media (max-width: 768px) {
            .nav-list {
                display: none;
                flex-direction: column;
                background: #fff;
                position: absolute;
                top: 70px;
                right: 0;
                width: 100%;
                padding: 1rem;
                border-top: 1px solid #eee;
            }

            .nav-list.show {
                display: flex;
            }

            .menu-toggle {
                display: block;
                cursor: pointer;
                font-size: 1.8rem;
            }
        }

        @media (min-width: 769px) {
            .menu-toggle {
                display: none;
            }
        }
    </style>
</head>

<body>
    @if (session('success'))
        <script>alert('Berhasil mendaftar');</script>
    @endif

    {{-- HEADER --}}
    <header>
        <div class="nav-container">
            <div class="nav-logo">
                <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}"
                     alt="Logo ORMAWA">
            </div>

            <div class="menu-toggle text-dark">
                <i class="fa fa-bars"></i>
            </div>

            <div class="nav-list">
                <a href="#beranda" class="active">Beranda</a>
                <a href="#jadwal">Jadwal Kegiatan</a>
                <div class="dropdown">
                    <a href="#organisasi">Organisasi</a>
                    <div class="dropdown-options">
                        @yield('dropdown-options')
                    </div>
                </div>
            </div>

            <div class="nav-button">
                <div class="btn"><a href="/login">Masuk</a></div>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER / SCRIPT --}}
    <script>
        // Toggle menu untuk mobile
        document.addEventListener("DOMContentLoaded", () => {
            const toggle = document.querySelector(".menu-toggle");
            const navList = document.querySelector(".nav-list");

            toggle.addEventListener("click", () => {
                navList.classList.toggle("show");
            });
        });
    </script>

    <script src="{{ asset('js/landing.js') }}"></script>
    @include('chatbot')

    <!-- Bootstrap JS -->
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

</body>
</html>

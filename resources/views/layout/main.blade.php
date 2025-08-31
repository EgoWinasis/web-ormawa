@php
    use Illuminate\Support\Facades\DB;
    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('css/root.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/landing.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Tambahkan animate.css di <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
    /* Typewriter effect */
    .typewriter {
      overflow: hidden;
      border-right: .15em solid orange; 
      white-space: nowrap;
      margin: 0 auto;
      letter-spacing: .05em;
      animation: 
        typing 4s steps(40, end),
        blink-caret .75s step-end infinite;
    }
    
    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }
    
    @keyframes blink-caret {
      from, to { border-color: transparent }
      50% { border-color: orange }
    }
    </style>
    <title>@yield('title', 'Website ORMAWA')</title>
</head>
<body>
@if (session('success'))
    <script>alert('Berhasil mendaftar');</script>
@endif

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg text-white bg-info shadow-sm w-100">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}"
                 alt="Logo ORMAWA" style="max-height: 55px; object-fit: contain;">
        </a>

        <!-- Toggle Button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#jadwal">Jadwal Kegiatan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/list-organisasi">
                        Organisasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary text-white px-3" href="/login">Masuk</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN -->
<main class="container-fluid py-4">
    @yield('konten')
</main>

<!-- FOOTER / SCRIPT -->
@include('chatbot')

<script src="{{ asset('js/landing.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
</body>
</html>

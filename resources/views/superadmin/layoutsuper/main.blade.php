<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="../../css/root.css">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>SUPER ADMIN</title>


</head>

<body>
    <header>
        @include('superadmin.layoutsuper.header')
    </header>
    @if (session()->has('success'))
        <script>
            // Menampilkan SweetAlert2 setelah halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: 'top-end', // Posisi di pojok kanan atas
                    icon: 'success', // Ikon sukses
                    title: '{{ session('success') }}', // Pesan sukses
                    showConfirmButton: false, // Tidak menampilkan tombol konfirmasi
                    timer: 3000, // Waktu tampil 3 detik
                    toast: true, // Menggunakan mode toast
                    background: '#28a745', // Warna latar belakang hijau
                    color: 'white', // Warna teks putih
                    timerProgressBar: true, // Menampilkan progress bar
                });
            });
        </script>
    @endif


    <!-- container -->
    <div class="container-main d-flex">
        @include('superadmin.layoutsuper.sidebar')

        <div class="container-content">
            @yield('konten')

        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
    {{-- <script src="{{ asset('js/user.js') }}"></script> --}}
</body>

</html>

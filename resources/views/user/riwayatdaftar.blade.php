<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href='{{ asset('/css/root.css') }}'>

    <!-- link ke css landing -->
    <link rel="stylesheet" href='{{ asset('/css/admin.css') }}'>



    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard Pendaftaran</title>
</head>
@if (session()->has('succes'))
    <script>
        alert('Berhasil Mendaftar');
    </script>
@endif

<body>
    <header>
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-container">
                    <img class='logo-ormawa'
                        src={{ asset('storage/file-logo/landing-page.png') }}
                        alt="poto profile" width="100px">
                </div>
            </div>

            <div class="nav-profile d-flex">
                <p class="nama">{{ $user->name }}</p>
                <div class="foto-container">
                </div>
            </div>
        </div>
    </header>

    <!-- container -->
    <div class="container-main d-flex">
        <div class="sidebar">
            <div class="link-bar d-flex">
                <li class="{{ Route::is('user.index') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}">
                        <span class="material-symbols-outlined">edit</span>Form
                    </a>
                </li>
                <li class="{{ Route::is('user.history') ? 'active' : '' }}">
                    <a href="{{ route('user.history') }}">
                        <span class="material-symbols-outlined">inventory</span>Tahap Pendaftaran
                    </a>
                </li>
                <li class="{{ Route::is('user.riwayat') ? 'active' : '' }}">
                    <a href="{{ route('user.riwayat') }}">
                        <span class="material-symbols-outlined">history</span>Riwayat
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit"
                            style="background: none; border: none; display: flex; align-items: center; justify-content: center; color: black;">
                            <span class="material-symbols-outlined">close</span>Keluar
                        </button>
                    </form>
                </li>
            </div>
        </div>
        <div class="container-content" id="container-dashboard-anggota">
            <div id="history" class="container-history d-flex active">
                <div class="container-arsip d-flex active">
                    <h2>RIWAYAT PENDAFTARAN</h2>
                    <div class="table-wrapper">
                        <table class="fl-table">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Organisasi Tujuan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 0)
                                @forelse ($riwayat as $item)
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $item->organisasi_tujuan }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Tidak ada data riwayat.</td>
                                    </tr>
                                @endforelse
                            <tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
    </div>
    {{-- <script src={{ asset('js/user.js') }}></script> --}}
    
</body>
@if(session('swal_success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '{{ session('swal_success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

</html>

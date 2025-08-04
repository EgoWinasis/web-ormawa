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
@php
    use Illuminate\Support\Facades\DB;

    $brandImage = DB::table('brand_image')->latest('id')->first();
@endphp
<body>
    <header>
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-container">
                    <img class='logo-ormawa'
                        src={{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}
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
                @if ($user->status == 'calon')
                    <h1>Sedang DiProses Tahap Administrasi..<h1>
                        @elseif ($user->status == 'Lolos ke Wawancara')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Selamat {{ $user->name }} Anda Lolos Tahap Administrasi</h3>

                            <h4 style="margin-bottom: 10px;">Selanjutnya anda akan dijadwalkan wawancara berikut
                                detailnya:</h4>
                            <h4><span>Tempat</span> <span
                                    style="display: inline-block; width: 10px; text-align: center;">:</span>
                                <span>{{ $user->tempat_wawancara }}</span>
                            </h4>
                            <h4><span>Hari, Tanggal</span> <span
                                    style="display: inline-block; width: 10px; text-align: center;">:</span>
                                <span>{{ \Carbon\Carbon::parse($user->tgl_wawancara)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                            </h4>
                            <h4><span>Jam</span> <span
                                    style="display: inline-block; width: 10px; text-align: center;">:</span>
                                <span>{{ $user->jam_wawancara }}</span>
                            </h4>
                        @elseif($user->status == 'aktif')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Selamat {{ $user->name }} Anda Lolos Tahap Wawancara </h3>
                            <h3>Sekarang anda Adalah {{ $user->jabatan }} {{ $user->nama_organisasi }}</h3>
                        @elseif($user->status == 'gagal tahap administrasi')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Mohon Maaf {{ $user->name }} kamu belum lolos menjadi anggota
                                {{ $user->nama_organisasi }} </h3>
                            <h3>kamu {{ $user->status }}</h3>
                        @elseif($user->status == 'gagal tahap wawancara')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Mohon Maaf {{ $user->name }} kamu belum lolos menjadi anggota
                                {{ $user->nama_organisasi }} </h3>
                            <h3>kamu {{ $user->status }}</h3>
                        @else
                            <h1>Silahkan Lengkapi Berkas...</h1>
                @endif

            </div>

        </div>
    </div>
    {{-- <script src={{ asset('js/user.js') }}></script> --}}
    
</body>

</html>

@extends('layout.main')

@section('title', 'Beranda ORMAWA')

@section('dropdown-options')
<div class="dropdown w-100">
    <button class="btn btn-outline-primary w-100 d-md-none mb-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Pilih Organisasi
    </button>
    <div class="dropdown-menu w-100" style="max-height: 200px; overflow-y: auto;">
        @php $uniqueOrganisasi = []; @endphp
        @foreach ($user as $u)
            @if ($u->nama_organisasi !== 'kesiswaan' && !in_array($u->nama_organisasi, $uniqueOrganisasi))
                @php $uniqueOrganisasi[] = $u->nama_organisasi; @endphp
                <div class="dropdown-item text-dark list-org"
                     style="cursor: pointer;"
                     data-name="{{ Str::slug($u->nama_organisasi) }}">
                     {{ Str::title($u->nama_organisasi) }}
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection

@section('content')

<!-- HERO SECTION -->
<div id="beranda" 
     class="container-fluid d-flex align-items-center"
     style="background-image: url('{{ asset('storage/file-logo/Phb_10.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            background-color: rgba(255, 255, 255, 0.7);
            background-blend-mode: overlay;">

    <div class="row w-100 text-center text-md-start">
        <!-- Text -->
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center p-4">
            <h1 class="fw-bold">Selamat Datang 🙌</h1>
            <div class="typing-container">
                <span class="typing-line">Website Sistem Informasi Manajemen Organisasi</span>
                <span class="typing-line">Mahasiswa Politeknik Harapan Bersama Tegal</span>
            </div>
        </div>

        <!-- Image -->
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center p-4">
            <div class="img-container animate-bounce">
                <img src="{{ asset('storage/file-logo/logo-landing.png') }}"
                     alt="ilustrasi aplikasi Organisasi"
                     class="img-fluid"
                     style="max-width: 220px;">
            </div>
        </div>
    </div>
</div>

<!-- JADWAL -->
<div id="jadwal" class="container my-5">
    <h2 class="mb-4 text-center fw-bold">JADWAL SEMUA KEGIATAN ORGANISASI POLTEK HARBER</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Unit Ormawa</th>
                    <th>Tempat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rutin as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->hari }}</td>
                        <td>{{ $r->unit }}</td>
                        <td>{{ $r->tempat_kegiatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- NEWS -->
<div id="organisasi" class="container my-5">
    <h2 class="title mb-4 text-center fw-bold">NEWS</h2>
    <div class="row">
        @foreach ($kegiatan as $k)
            @isset($k->lpj)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $k->gambar) }}"
                             class="card-img-top img-fluid"
                             alt="Gambar {{ $k->nama_kegiatan }}"
                             style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase fw-bold mb-2">{{ $k->nama_kegiatan }}</h5>
                            <p class="card-text mb-2">
                                <strong class="text-muted">Waktu Pelaksanaan:</strong><br>
                                {{ \Carbon\Carbon::parse($k->tanggal_mulai)->locale('id')->translatedFormat('l, d F Y') }}
                            </p>
                            <p class="card-text text-start">
                                <strong class="text-muted">Keterangan:</strong><br>
                                {{ $k->keterangan }}
                            </p>
                        </div>
                    </div>
                </div>
            @endisset
        @endforeach
    </div>

    <!-- Visi Misi tiap Ormawa -->
    @foreach ($user as $u)
        @if ($u->nama_organisasi !== 'kesiswaan')
            <div class="container-text-{{ Str::slug($u->nama_organisasi) }} container-unit my-5"
                 id="{{ Str::slug($u->nama_organisasi) }}">
                <div class="row align-items-center g-4 text-center">
                    <!-- Visi -->
                    <div class="col-md-4 col-12 border rounded p-3 shadow-sm">
                        <h3 class="fw-bold">Visi</h3>
                        <p class="text-start">{{ $u->visi }}</p>
                    </div>

                    <!-- Logo -->
                    <div class="col-md-4 col-12">
                        <img src="{{ asset('storage/' . $u->foto) }}"
                             alt="Logo {{ $u->nama_organisasi }}"
                             class="img-fluid mx-auto d-block" style="max-width: 150px;">
                    </div>

                    <!-- Misi -->
                    <div class="col-md-4 col-12 border rounded p-3 shadow-sm">
                        <h3 class="fw-bold">Misi</h3>
                        <p class="text-start">{{ $u->misi }}</p>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection

@section('css')
<style>
    .typing-container {
        font-weight: bold;
        display: inline-block;
    }
    .typing-line {
        display: block;
        overflow: hidden;
        white-space: nowrap;
        width: 0;
        animation: typing 2s steps(30, end) forwards, blink-caret 0.5s step-end infinite;
    }
    .typing-line:nth-child(2) {
        animation-delay: 2s;
    }
    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }
    @keyframes blink-caret {
        from, to { border-color: transparent; }
        50% { border-color: black; }
    }

    .animate-bounce {
        animation: bounce 2s infinite;
    }
    @keyframes bounce {
        0%,100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    .dropdown-item.list-org:hover {
        background-color: #f0f0f0;
        color: #000;
    }
    .dropdown-item.list-org:active {
        background-color: #dcdcdc;
        color: #000;
    }

    /* Responsif untuk HP */
    @media (max-width: 576px) {
        h1, h2, h3 {
            font-size: 1.2rem;
        }
        .card-title {
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.list-org');
        items.forEach(item => {
            item.addEventListener('click', function () {
                items.forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endsection

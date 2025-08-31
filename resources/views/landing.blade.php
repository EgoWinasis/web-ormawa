@extends('layout.main')

@section('title', 'Beranda ORMAWA')

@section('dropdown-options')
<div class="dropdown-menu show" style="width: 250px; max-height: 200px; overflow-y: auto;">
    @php $uniqueOrganisasi = []; @endphp
    @foreach ($user as $u)
        @if ($u->nama_organisasi !== 'kesiswaan' && !in_array($u->nama_organisasi, $uniqueOrganisasi))
            @php $uniqueOrganisasi[] = $u->nama_organisasi; @endphp
            <div href="#"
                 onclick="return false;"
                 class="dropdown-item text-dark list-org"
                 style="cursor: pointer;"
                 data-name="{{ Str::slug($u->nama_organisasi) }}">
                 {{ Str::title($u->nama_organisasi) }}
            </div>
        @endif
    @endforeach
</div>
@endsection

@section('content')

<!-- HERO SECTION -->
<div id="beranda" class="d-flex flex-column flex-md-row justify-content-center align-items-center text-center text-md-start"
     style="background-image: url('{{ asset('storage/file-logo/Phb_10.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.7);
            background-blend-mode: overlay;
            width: 100vw;">

    <!-- Text -->
    <div class="ber-container-right p-3">
        <h1 class="fw-bold">Selamat Datang 🙌</h1>

        <div class="typing-container">
            <span class="typing-line">Website Sistem Informasi Manajemen Organisasi</span>
            <span class="typing-line">Mahasiswa Politeknik Harapan Bersama Tegal</span>
        </div>
    </div>

    <!-- Image -->
    <div class="ber-container-left p-3">
        <div class="img-container animate-bounce">
            <img src="{{ asset('storage/file-logo/logo-landing.png') }}"
                 alt="ilustrasi aplikasi Organisasi"
                 class="img-fluid" style="max-width: 300px;">
        </div>
    </div>
</div>

<!-- JADWAL -->
<div id="jadwal" class="container my-5">
    <h2 class="mb-3">JADWAL SEMUA KEGIATAN ORGANISASI POLTEK HARBER</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
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
    <h2 class="title mb-4">NEWS</h2>
    <div class="news container-unit active">
        <div class="row">
            @foreach ($kegiatan as $k)
                @isset($k->lpj)
                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $k->gambar) }}"
                                 class="card-img-top img-fluid"
                                 alt="Gambar {{ $k->nama_kegiatan }}"
                                 style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase fw-bold mb-2">{{ $k->nama_kegiatan }}</h5>
                                <p class="card-text mb-2">
                                    <strong class="text-muted">Waktu Pelaksanaan:</strong><br>
                                    {{ \Carbon\Carbon::parse($k->tanggal_mulai)->locale('id')->translatedFormat('l, d F Y') }}
                                </p>
                                <p class="card-text text-justify">
                                    <strong class="text-muted">Keterangan:</strong><br>
                                    {{ $k->keterangan }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endisset
            @endforeach
        </div>
    </div>

    <!-- Visi Misi tiap Ormawa -->
    @foreach ($user as $u)
        @if ($u->nama_organisasi !== 'kesiswaan')
            <div class="container-text-{{ Str::slug($u->nama_organisasi) }} container-unit my-5"
                 id="{{ Str::slug($u->nama_organisasi) }}">
                <div class="row align-items-center text-center g-4">
                    <!-- Visi -->
                    <div class="col-md-4 col-12 border rounded p-3 shadow-sm">
                        <h3>Visi</h3>
                        <p class="text-justify">{{ $u->visi }}</p>
                    </div>

                    <!-- Logo -->
                    <div class="col-md-4 col-12">
                        <img src="{{ asset('storage/' . $u->foto) }}"
                             alt="Logo {{ $u->nama_organisasi }}"
                             class="img-fluid mx-auto d-block" style="max-width: 200px;">
                    </div>

                    <!-- Misi -->
                    <div class="col-md-4 col-12 border rounded p-3 shadow-sm">
                        <h3>Misi</h3>
                        <p class="text-justify">{{ $u->misi }}</p>
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

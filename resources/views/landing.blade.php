@extends('layout.main')

@section('title', 'Beranda ORMAWA')


<!-- HERO -->
<div id="beranda"
     class="container-fluid d-flex align-items-center min-vh-100"
     style="background: url('{{ asset('storage/file-logo/Phb_10.jpg') }}') center/cover no-repeat;
            background-color: rgba(255,255,255,.7);
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
            <img src="{{ asset('storage/file-logo/logo-landing.png') }}"
                 alt="Ilustrasi aplikasi Organisasi"
                 class="img-fluid animate-bounce" style="max-width: 220px;">
        </div>
    </div>
</div>

<!-- JADWAL -->
<div id="jadwal" class="container my-5">
    <h2 class="text-center fw-bold mb-4">
        JADWAL SEMUA KEGIATAN ORGANISASI POLTEK HARBER
    </h2>
    <div class="table-responsive mb-5"> {{-- ada jarak bawah --}}
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
<div id="organisasi" class="container my-5 pt-5"> {{-- ada jarak atas --}}
    <h2 class="text-center fw-bold mb-4">NEWS</h2>
    <div class="row g-4"> {{-- pakai g-4 untuk spasi antar kolom --}}
        @foreach ($kegiatan as $k)
            @isset($k->lpj)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $k->gambar) }}"
                             class="card-img-top"
                             alt="Gambar {{ $k->nama_kegiatan }}"
                             style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase fw-bold">{{ $k->nama_kegiatan }}</h5>
                            <p class="card-text">
                                <strong>Waktu Pelaksanaan:</strong><br>
                                {{ \Carbon\Carbon::parse($k->tanggal_mulai)->locale('id')->translatedFormat('l, d F Y') }}
                            </p>
                            <p class="card-text">
                                <strong>Keterangan:</strong><br>
                                {{ $k->keterangan }}
                            </p>
                        </div>
                    </div>
                </div>
            @endisset
        @endforeach
    </div>
</div>

<!-- CSS -->
<style>
    /* efek typing */
    .typing-container { font-weight: bold; display: inline-block; }
    .typing-line {
        display: block;
        overflow: hidden;
        white-space: nowrap;
        width: 0;
        animation: typing 2s steps(30, end) forwards, blink-caret .5s step-end infinite;
    }
    .typing-line:nth-child(2) { animation-delay: 2s; }
    @keyframes typing { from { width: 0; } to { width: 100%; } }
    @keyframes blink-caret { 50% { border-color: black; } }

    /* bounce img */
    .animate-bounce { animation: bounce 2s infinite; }
    @keyframes bounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-20px);} }

    /* Hover dropdown item */
    .dropdown-item.list-org:hover { background-color:#f0f0f0; }
    .dropdown-item.list-org:active { background-color:#dcdcdc; }

    /* responsive kecil */
    @media (max-width:576px) {
        h1,h2,h3 { font-size:1.2rem; }
        .card-title { font-size:1rem; }
    }
</style>

<!-- JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('.list-org');
        items.forEach(item => {
            item.addEventListener('click', function () {
                items.forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>

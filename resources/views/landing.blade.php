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
               class="dropdown-item text-dark list-org" style="cursor: pointer;" 
               data-name="{{ Str::slug($u->nama_organisasi) }}">
               {{ Str::title($u->nama_organisasi) }}
            </div>
        @endif
    @endforeach
</div>
@endsection



@section('content')

    <div id="beranda" class="d-flex justify-content-center align-items-center"
        style="background-image: url('storage/file-logo/Phb_10.jpg'); 
       background-size: cover; 
       background-position: center; 
       background-repeat: no-repeat; 
       height: 100vh; 
       background-color: rgba(255, 255, 255, 0.7); 
       background-blend-mode: overlay; 
       width: 100vw;">
        <div class="ber-container-right">
            <h1 class="fw-bold">Selamat Datang 🙌</h1>
            <style>
                .typing-container {
                    font-weight: bold;
                    display: inline-block;
                    /* border-right: 2px solid black; */
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
                    /* Menunda animasi baris kedua */
                }

                @keyframes typing {
                    from {
                        width: 0;
                    }

                    to {
                        width: 100%;
                    }
                }

                @keyframes blink-caret {

                    from,
                    to {
                        border-color: transparent;
                    }

                    50% {
                        border-color: black;
                    }
                }
            </style>

            <div class="typing-container">
                <span class="typing-line">Website Sistem Informasi Manajemen Organisasi</span>
                <span class="typing-line">Mahasiswa Politeknik Harapan Bersama Kota Tegal</span>
            </div>


        </div>
        <div class="ber-container-left">
            <style>
                .animate-bounce {
                    animation: bounce 2s infinite;
                    /* Nama animasi, durasi 2 detik, pengulangan tak terbatas */
                }

                @keyframes bounce {

                    0%,
                    100% {
                        transform: translateY(0);
                        /* Posisi awal dan akhir */
                    }

                    50% {
                        transform: translateY(-20px);
                        /* Naik ke atas 20px */
                    }
                }
            </style>

            <div class="img-container animate-bounce">
                <img src="storage/file-logo/logo-landing.png" alt="ilustrasi aplikasi Organisasi">
            </div>
        </div>
    </div>
    <div id="jadwal" class="container d-flex">
        <h2>JADWAL SEMUA KEGIATAN ORGANISASI POLTEK HARBER</h2>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
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

                <tbody>
            </table>
        </div>


    </div>

    <div id="organisasi" class="container-detail-unit">
        <h2 class="title">NEWS</h2>
        {{-- <div class="news container-unit active">
            <div class="container-news">
                @foreach ($kegiatan as $k)
                    @isset($k->lpj)
                        <div class="container-new">
                            <div class="container-img">
                                <img src="storage/{{ $k->gambar }}" alt="">
                            </div>
                            <p class="name">{{ Str::upper($k->nama_kegiatan) }}</p>
                            <p>Waktu Pelaksanaan:
                                {{ \Carbon\Carbon::parse($k->tanggal_mulai)->locale('id')->translatedFormat('l') }},
                                {{ $k->tanggal_mulai }}</p>
                            <p class="ket">Keterangan: {{ $k->keterangan }}</p>
                        </div>
                    @endisset
                @endforeach
            </div>
        </div> --}}
        <div class="news container-unit active">
            <div class="row">
                @foreach ($kegiatan as $k)
                    @isset($k->lpj)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <!-- Gambar -->
                              <img src="{{ asset('storage/' . $k->gambar) }}"
     class="card-img-top"
     alt="Gambar {{ $k->nama_kegiatan }}"
     style="height: 300px; object-fit: contain; width: 100%; background-color: #f8f9fa;">


                                <!-- Konten Card -->
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

        {{-- @foreach ($user as $u)
            @if ($u->nama_organisasi == 'kesiswaan')
                @php
                    continue;
                @endphp
            @else
                <div class="container-text-{{ $u->nama_organisasi }} container-unit" id="{{ $u->nama_organisasi }}">
                    <div class="container-visi">
                        <h3>Visi</h3>
                        <p class="visi">{{ $u->visi }}</p>
                    </div>
                    <div class="container-mid">
                        <img src="storage/{{ $u->logo }}" alt="" width="200px">
                    </div>
                    <div class="container-visi">
                        <h3>Misi</h3>
                        <p class="visi">{{ $u->misi }}</p>
                    </div>
                </div>
            @endif
        @endforeach --}}

        @foreach ($user as $u)
            @if ($u->nama_organisasi == 'kesiswaan')
                @php
                    continue;
                @endphp
            @else
                <div class="container-text-{{ Str::slug($u->nama_organisasi) }} container-unit"
                    id="{{ Str::slug($u->nama_organisasi) }}">
                    <div class="row align-items-center text-center">
                        <!-- Kolom Visi -->
                        <div class="col-md-4 border border-default rounded p-3">
                            <h3>Visi</h3>
                            <p class="text-justify">{{ $u->visi }}</p>
                        </div>

                        <!-- Kolom Logo -->
                        <div class="col-md-4">
                            <img src="storage/{{ $u->foto }}" alt="Logo {{ $u->nama_organisasi }}"
                                class="img-fluid mx-auto d-block" style="max-width: 200px;">
                        </div>

                        <!-- Kolom Misi -->
                        <div class="col-md-4 border border-default rounded p-3">
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
    .dropdown-item.list-org:hover {
        background-color: #f0f0f0; /* Light gray */
        color: #000; /* Text color on hover */
    }

    .dropdown-item.list-org:active {
        background-color: #dcdcdc; /* Slightly darker for active state */
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
                // Remove 'active' from all
                items.forEach(el => el.classList.remove('active'));

                // Add 'active' to clicked one
                this.classList.add('active');
            });
        });
    });


</script>



@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="../../css/root.css">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../css/admin.css">

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>SUPER ADMIN</title>


</head>

<body>
    <header>
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-container">
                    <img class='logo-ormawa'
                        src="{{asset('storage/file-logo/landing-page.png')}}"
                        alt="poto profile" width="100px">
                </div>
            </div>
            <div class="nav-profile d-flex">
                <p class="nama">Super Admin</p>
                <div class="foto-container">
                    <img class='profile-foto' src="{{asset('storage/file-logo/logo-phb.png')}}" alt="poto profile" width="100px">
                </div>
            </div>
        </div>
    </header>

    <!-- container -->
    <div class="container-main d-flex">
        <div class="sidebar">
            <div class="link-bar d-flex">
                <li data-name="dashboard" class="active"><span class="material-symbols-outlined">home</span>Dashboard
                </li>
                <li data-name="kegiatan"><span class="material-symbols-outlined">campaign</span>NEWS</li>
                <li data-name="arsip"><span class="material-symbols-outlined">bookmark</span>Arsip</li>
                <li data-name="absensi"><span class="material-symbols-outlined">inventory</span>Data Ormawa</li>
                <li data-name="profile"><span class="material-symbols-outlined">person</span>Create User</li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            style="display:flex; align-items:center;justify-content: center; color:black; border:none; background:none;">
                            <span class="material-symbols-outlined">close</span>Keluar
                        </button>
                    </form>
                </li>
            </div>
        </div>
        <div class="container-content">
            <div id="dashboard" class="container-dashboard d-flex active">
                <div class="box-container">
                    <h2>{{ count($admin) - 1 }}</h2>
                    <p>Total Unit</p>
                </div>
                <div class="box-container">
                    <h2>{{ count($anggota) }}</h2>
                    <p>Total Anggota</p>
                </div>
                <div class="box-container">
                    <h2>{{ count($kegiatan) }}</h2>
                    <p>Total Arsip</p>
                </div>
                <div class="box-container">
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($kegiatan as $item)
                        @isset($item->lpj)
                            @php
                                $count++;
                            @endphp
                        @endisset
                    @endforeach
                    <h2>{{ $count }}</h2>
                    <p>Total News</p>
                </div>


            </div>
            <div class="container-absensi d-flex">
                <h2>Total Anggota</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>WhatsApp</th>
                                <th>Unit</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)

                            @foreach ($anggota as $p)
                                @if ($p->status == 'aktif')
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</th>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->nomor }}</td>
                                        <td>{{ $p->nama_organisasi }}</td>
                                        <td>{{ $p->jabatan }}</td>
                                    </tr>
                                @endif
                            @endforeach



                        <tbody>
                    </table>
                </div>
            </div>
            <div class="container-kegiatan d-flex">
                <h2>NEWS</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                                <th>Nama Kegiatan</th>
                                <th>Tempat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($kegiatan as $k)
                                @isset($k->lpj)
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</td>
                                        <td>{{ $k->tanggal_mulai }}</td>
                                        <td class="img"><img src="{{ asset('storage/' . $k->gambar) }}" alt=""
                                                width="60px"></td>
                                        <td>{{ $k->nama_kegiatan }}</td>
                                        <td>{{ $k->tempat_kegiatan }}</td>
                                        <td style="display: none">{{ $k->tempat_kegiatan }}</td>
                                    </tr>
                                @endisset
                            @endforeach


                        <tbody>
                    </table>
                </div>
            </div>

            <div class="container-arsip d-flex">
                <h2>ARSIP SEMUA UNIT ORMAWA</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tempat</th>
                            <th>Gambar</th>
                            <th>Proposal</th>
                            <th>LPJ</th>
                            <th>Panitia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)

                            @foreach ($kegiatan as $k)
                                <tr>
                                    @php($count++)
                                    <td>{{ $count }}</th>
                                    <td>{{ $k->nama_kegiatan }}</td>
                                    <td>{{ $k->tempat_kegiatan }}</td>
                                    <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->gambar) }}}"
                                            title="{{ $k->slug }}"><img class="img"
                                                src="{{ asset('storage/' . $k->gambar) }}" alt="" width="60px"></a>
                                    </td>
                                    <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->proposal) }}"
                                            title="{{ $k->slug }}">{{ Str::limit($k->proposal, 20) }}</a></td>
                                    @if ($k->lpj)
                                        <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->lpj) }}"
                                                title="{{ $k->slug }}">{{ Str::limit($k->lpj, 20) }}</a></td>
                                    @else
                                        <td>Belum ada</td>
                                    @endif

                                    <td class="kegiatan">
                                        @if (count($k->users) != 0)
                                            <span style="display: flex; justify-content: center">
                                                <button style="width: 3rem;"
                                                    onclick="toggleFlyout(event)">{{ count($k->users) }}</button>
                                                <div class="flyout" style="display: none;">
                                                    {{-- Ganti konten berikut dengan apa yang ingin Anda tampilkan dalam flyout --}}
                                                    @foreach ($k->users as $a)
                                                        <li>{{ $a->name }}</li>
                                                    @endforeach
                                                </div>
                                            </span>
                                        @else
                                            Belum Ada Kegiatan
                                        @endif
                                    </td>

                                    <td style="display: none"><a href="/kegiatan/{{ $k->id }}"
                                            style="color:blue">Lihat Panitia</a></td>
                                </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>


            <div class="container-profile d-flex">
                <div class="form-container">
                    <form method="post" enctype="multipart/form-data" action="/admin/tambah/user">
                        @csrf

                        <div class="form-box">
                            <div class="input-box">
                                <label for="organisai-input">Nama: </label>
                                <input type="text" id="organisai-input" name="name" value="">
                            </div>
                            <div class="input-box">
                                <label for="email-input">Email: </label>
                                <input type="email" id="email-input" name="email" value="">
                            </div>

                        </div>
                        <div class="form-box">

                            <div class="input-box">
                                <label for="organisasi-input">Unit: </label>
                                <input type="organisasi" id="organisasi-input" name="nama_organisasi"
                                    value="">
                            </div>
                            <div class="input-box">
                                <button style="color: white; width: 12rem; border-radius: 6px;" class="edit"><span
                                        class="material-symbols-outlined">edit</span>Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p style="font-style: italic">Note: Tolong double check untuk data yang di input🙌</p>
            </div>
        </div>
    </div>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/user.js')}}"></script>
</body>

</html>

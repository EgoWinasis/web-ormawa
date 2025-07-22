<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>ADMIN BEM</title>


</head>

<body>
    <header>
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-container">
                    <img class='logo-ormawa'
                        src="{{ asset('storage/file-logo/landing-page.png') }}"
                        alt="poto profile" width="100px">
                </div>
            </div>

            <div class="nav-profile d-flex">
                <p class="nama">{{ $user->name }}</p>
                <div class="foto-container">
                    <img class='profile-foto logo' src="{{ asset('storage/' . $user->logo) }}" alt="poto profile"
                        width="100px">
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
                {{-- <li data-name="arsip" onclick="window.location='{{ route('arsip.index') }}'">
                    <span class="material-symbols-outlined">bookmark</span> Arsip
                </li> --}}
                @if ($user->nama_organisasi == 'bem')
                    <li data-name="rutinitas"><span class="material-symbols-outlined">routine</span>Rutinitas</li>
                @endif
                <li data-name="absensi"><span class="material-symbols-outlined">diversity_3</span>Pengurus</li>
                <li data-name="calon"><span class="material-symbols-outlined">inventory</span>Seleksi Administrasi</li>
                <li data-name="wawancara"><span class="material-symbols-outlined">inventory</span>Seleksi Wawancara</li>
                <li data-name="profile"><span class="material-symbols-outlined">person</span>Data Profile</li>
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
            <div class="container-kegiatan d-flex">
                <h2>BERITA ACARA</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                                <th>Nama Kegiatan</th>
                                <th>Tempat</th>
                                <th>Aksi</th>
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
                                                width="60px" height="60px"></td>
                                        <td>{{ $k->nama_kegiatan }}</td>
                                        <td>{{ $k->tempat_kegiatan }}</td>
                                        <td style="display: none">{{ $k->tempat_kegiatan }}</td>
                                        <td>
                                            <form action="news/destroy/{{ $k->id }}" method="post">
                                                @csrf
                                                <button onclick="return confirm('yakin ingin menghapus news?')"><span
                                                        class="material-symbols-outlined">delete</span></button>
                                            </form></span>
                                        </td>
                                    </tr>
                                @endisset
                            @endforeach


                        <tbody>
                    </table>
                </div>
            </div>

            <div class="container-arsip d-flex">

                <h2>ARSIP KEGIATAN</h2>
                {{-- <div data-name="arsip" class="addButton"><span class="material-symbols-outlined">add</span>Tambah</div> --}}
                {{-- <div data-name="arsip" class="addButton" onclick="window.location='{{ route('arsip.create') }}'">
                    <span class="material-symbols-outlined">add</span> Tambah
                </div> --}}
                <div>
                    {{-- <a href="{{route('arsip.create')}}" class="btn btn-success text-dark">Tambah</a> --}}
                    <a href="{{ route('arsip.create') }}" id="tambahtambahan">
                        <span style="margin-right: 8px; font-size: 1.2rem;">+</span>Tambah
                    </a>
                </div>
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
                                    <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->gambar) }}"
                                            title="{{ $k->slug }}">
                                            <img src="{{ asset('storage/' . $k->gambar) }}" alt="Logo"
                                                width='60px' height="60px" style="object-fit: cover">
                                        </a></td>
                                    <td><a download="{{ $k->slug }}"
                                            href="{{ asset('storage/' . $k->proposal) }}"
                                            title="{{ $k->slug }}">Download Proposal</a></td>
                                    @if ($k->lpj)
                                        <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->lpj) }}"
                                                title="{{ $k->slug }}">Download LPJ</a></td>
                                    @else
                                        <td>Belum ada</td>
                                    @endif
                                    @if (!count($k->users) == '0')
                                        <td><a href="/admin/kegiatan/{{ $k->id }}"
                                                style="color:blue">{{ count($k->users) }}</a></td>
                                    @else
                                        <td><a href="/admin/kegiatan/{{ $k->id }}" style="color:blue"> Belum Ada
                                                Panitia</a></td>
                                    @endif
                                    <td style="display: none"><a href="/admin/kegiatan/{{ $k->id }}"
                                            style="color:blue">Lihat Panitia</a></td>
                                </tr>
                            @endforeach


                        <tbody>
                    </table>
                </div>


            </div>
            <div class="container-rutinitas d-flex">
                <h2>JADWAL SEMUA KEGIATAN UNIT ORGANISASI MAHASISWA UKM</h2>
                {{-- <div data-name="rutin" class="addButton"><span class="material-symbols-outlined">add</span>Tambah
                </div> --}}
                <div>
                    <a href="{{ route('rutin.create') }}" id="tambahtambahan">
                        <span style="margin-right: 8px; font-size: 1.2rem;">+</span>Tambah
                    </a>
                </div>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Unit Ormawa</th>
                                <th>Tempat</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($rutin as $p)
                                <tr>
                                    @php($count++)
                                    <td>{{ $count }}</td>
                                    <td>{{ $p->hari }}</td>
                                    <td>{{ $p->unit }}</td>
                                    <td>{{ $p->tempat_kegiatan }}</td>
                                    <td style="display: flex; justify-content:center; gap:1rem">
                                        <form action="rutin/update/{{ $p->id }}/view" method="get"> @csrf
                                            <button><span class="material-symbols-outlined">edit</span>
                                            </button>
                                        </form>
                                        <form action="rutin/destroy/{{ $p->id }}" method="post"> @csrf
                                            @method('delete')
                                            <button onclick="return confirm('yakin ingin menghapus kegiatan?')"><span
                                                    class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        <tbody>
                    </table>
                </div>
            </div>
            <div id ="tambah-arsip">
                <div class="form-container">

                    <form method="post" enctype="multipart/form-data" action="arsip/store">
                        @csrf
                        <div class="form-box">
                            <div class="input-box">
                                <label for="kegiatan-input">Nama Kegiatan: </label>
                                <input type="text" id="kegiatan-input" value="{{ old('nama_kegiatan') }}"
                                    name="nama_kegiatan">
                                @error('nama_kegiatan')
                                    <p class="ket error">*wajib di isi</p>
                                @enderror
                            </div>

                            <div class="input-box">
                                <label for="img-input">Gambar: </label>
                                <input type="file" id="img-input" accept="image/*" value="{{ old('gambar') }}"
                                    name="gambar">
                                <p
                                    class="ket 
                            @error('gambar')  
                                error
                            @enderror ">
                                    *Pastikan memasukan gambar berkestensi jpg atau png saja. Max: 2MB</p>

                            </div>
                            <div class="input-box">
                                <label for="tempat-input">Tempat Kegiatan: </label>
                                <input type="text" id="tempat-input" value="{{ old('tempat_kegiatan') }}"
                                    name="tempat_kegiatan">
                                @error('tempat_kegiatan')
                                    <p class="ket error">*wajib di isi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="input-box">
                                <label for="date-start-input">Tanggal Mulai Kegiatan: </label>
                                <input type="date" id="date-start-input" value="{{ old('tanggal_mulai') }}"
                                    name="tanggal_mulai">
                                @error('tanggal_mulai')
                                    <p class="ket error">*wajib di isi</p>
                                @enderror
                            </div>
                            <div class="input-box">
                                <label for="proposal">Proposal: </label>
                                <input type="file" id="proposal"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                    value="{{ old('proposal') }}" name="proposal">
                                <p
                                    class="ket 
                            @error('proposal')  
                                error
                            @enderror ">
                                    *Pastikan memasukan File berkestensi PDF saja.</p>
                            </div>
                            <div class="input-box">
                                <label for="keterangan">Keterangan :</label>
                                <input type="text" id="keterangan" value="{{ old('keterangan') }}"
                                    name="keterangan">
                                @error('nama_kegiatan')
                                    <p class="ket error">*wajib di isi</p>
                                @enderror
                            </div>
                            <input class="submitButton" type="submit" value="Tambah">
                        </div>
                    </form>
                </div>

            </div>
            <div id ="tambah-rutin">
                <div style="margin-top: 5rem;" class="form-container">
                    {{-- update --}}
                    <form method="post" enctype="multipart/form-data" action="rutin/store">
                        @csrf
                        <div class="form-box">

                            <div class="input-box">
                                <label for="hari">Hari: </label>
                                <input type="text" id="hari" accept="image/*" value="{{ old('hari') }}"
                                    name="hari">
                                <p
                                    class="ket 
                            @error('hari')  
                                error
                            @enderror ">
                                    *Tulis hari dengan format: senin-sabtu</p>

                            </div>
                            <div class="input-box">
                                <label for="tempat-input">Tempat Rutinitas: </label>
                                <input type="text" id="tempat-input" value="{{ old('tempat_kegiatan') }}"
                                    name="tempat_kegiatan">
                                @error('tempat_kegiatan')
                                    <p class="ket error">*wajib di isi</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-box">

                            <div class="input-box">
                                <label for="unit">Unit Ormawa :</label>
                                <input type="text" id="unit" value="{{ old('unit') }}" name="unit">
                                @error('nama_kegiatan')
                                    <p class="ket error">*wajib di isi</p>
                                @enderror
                            </div>
                            <input style="margin-top: 5rem;" class="submitButton" type="submit" value="Tambah">
                        </div>
                    </form>
                </div>

            </div>
            <div class="container-absensi d-flex">
                <h2>Daftar Anggota Aktif</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>kegiatan Diikuti</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($anggota as $p)
                                @if ($p->status == 'aktif')
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->jabatan }}</td>
                                        <td class="kegiatan">
                                            @if (count($p->agendas) != 0)
                                                <span style="display: flex; justify-content: center">
                                                    <button style="width: 3rem;"
                                                        onclick="toggleFlyout(event)">{{ count($p->agendas) }}</button>
                                                    <div class="flyout" style="display: none;">
                                                        {{-- Ganti konten berikut dengan apa yang ingin Anda tampilkan dalam flyout --}}
                                                        <ul>
                                                            @foreach ($p->agendas as $agenda)
                                                                <li>{{ $agenda->nama_kegiatan }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </span>
                                            @else
                                                Belum Ada Kegiatan
                                            @endif
                                        </td>
                                        <td> <span>
                                                <form action="kegiatan/panitia/{{ $p->id }}/destroy"
                                                    method="post"> @csrf @method('delete')
                                                    <button
                                                        onclick="return confirm('yakin ingin menghapus anggota?')"><span
                                                            class="material-symbols-outlined">delete</span></button>
                                                </form>
                                            </span></td>
                                    </tr>
                                @endif
                            @endforeach


                        <tbody>
                    </table>
                </div>
            </div>
            <div class="container-calon d-flex">
                <h2>Daftar calon Anggota</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomer Whatsapp</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($anggota as $p)
                                @if ($p->status == 'calon')
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->nomor }}</td>
                                        <td style="display: flex; justify-content:center; gap:1rem">
                                            <form action="kegiatan/panitia/{{ $p->id }}/view" method="get">
                                                @csrf
                                                <button><span class="material-symbols-outlined">edit</span>
                                                </button>
                                            </form>
                                            <form action="kegiatan/panitia/{{ $p->id }}/destroy"
                                                method="post"> @csrf @method('delete')
                                                <button
                                                    onclick="return confirm('yakin ingin menghapus anggota?')"><span
                                                        class="material-symbols-outlined">delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach


                        <tbody>
                    </table>
                </div>
            </div>
            <div class="container-wawancara d-flex">
                <h2>Daftar calon Anggota Lolos Ke Wawancara</h2>
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($anggota as $p)
                                @if ($p->status == 'Lolos ke Wawancara')
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</td>
                                        <td>{{ $p->name }}</td>

                                        <td style="display: flex; justify-content:center; gap:1rem">
                                            <form action="kegiatan/panitia/{{ $p->id }}/wawancara"
                                                method="get"> @csrf
                                                <button><span class="material-symbols-outlined">edit</span>
                                                </button>
                                            </form>
                                            <form action="kegiatan/panitia/{{ $p->id }}/destroy"
                                                method="post"> @csrf @method('delete')
                                                <button
                                                    onclick="return confirm('yakin ingin menghapus anggota?')"><span
                                                        class="material-symbols-outlined">delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach


                        <tbody>
                    </table>
                </div>
            </div>
            <div class="container-profile d-flex">
                <div class="form-container">
                    {{-- update --}}
                    <form method="post" enctype="multipart/form-data" action="user/{{ $user->id }}/edit">
                        @csrf

                        <div class="form-box">
                            <div class="input-box">
                                <label for="organisai-input">Nama: </label>
                                <input type="text" id="organisai-input" name="name"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="input-box">
                                <label for="visi-input">Visi: </label>
                                <input type="text" id="visi-input" value="{{ $user->visi }}" name="visi">
                            </div>
                            <div class="input-box">
                                <label for="logo-input">Logo: </label>
                                <input type="file" id="logo-input" accept="image/*" value=""
                                    name="logo">
                                <p
                                    class="ket 
                            @error('gambar')  
                                error
                            @enderror ">
                                    Pastikan memasukan File berkestensi jpg atau png saja. Max: 2MB</p>
                            </div>
                            <div class="input-box">
                                <label for="password">password: </label>
                                <input type="password" id="password" name="password">
                                <p class="ket">kektuatan password: <span id="power-point">Maukan min 6
                                        karakter</span></p>
                            </div>

                        </div>
                        <div class="form-box">
                            <div class="input-box">
                                <label for="struktur-input">Email: </label>
                                <input type="email" id="struktur-input" value="{{ $user->email }}"
                                    name="email">
                            </div>
                            <div class="input-box">
                                <label for="misi-input">Misi: </label>
                                <input type="text" id="misi-input" value="{{ $user->visi }}" name="misi">
                            </div>
                            <div class="input-box">
                                <label for="tupoksi-input">Tugas Pokok: </label>
                                <input type="text" id="tupoksi-input" value="{{ $user->tupoksi }}"
                                    name="tupoksi">
                            </div>
                            <div class="input-box">
                                <button style="color: white; width: 12rem; border-radius: 6px;" class="edit"><span
                                        class="material-symbols-outlined">edit</span>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p>Note: <span style="font-style: oblique">pertama kali masuk ubah password🙌</span></p>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>

</body>

</html>

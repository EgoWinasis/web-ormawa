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
            <div id="form" class="container-form d-flex active">
                <h2>FORM PENDAFTARAN</h2>
                <div class="form-container">
                    <form method="post" enctype="multipart/form-data" action="/anggota/store/{{ $user->id }}">
                        @csrf
                        <div class="form-box">
                            <div class="input-box">
                                <label for="name">Nama Lengkap: </label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
                                    disabled>
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="nim">NIM: </label>
                                <input type="text" id="nim" maxlength="9" name="nim" value="{{ $user->nim }}"
                                    disabled>
                                @if ($errors->has('nim'))
                                    <div class="text-danger">
                                        {{ $errors->first('nim') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="nomor">Whatsapp: </label>
                                <input type="text" id="nomor" maxlength="13" name="nomor"
                                    value="{{ $user->nomor }}" disabled>
                                @if ($errors->has('nomor'))
                                    <div class="text-danger">
                                        {{ $errors->first('nomor') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="semester">Semester: </label>
                                <input type="text" id="semester" maxlength="2" name="semester"
                                    value="{{ $user->semester }}" disabled>
                                @if ($errors->has('semester'))
                                    <div class="text-danger">
                                        {{ $errors->first('semester') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="input-box">
                                <label for="foto">Pas Foto: <span style="color:red;">*</span></label>
                                <input type="file" id="foto" accept="image/*" name="foto" value="">
                                <p>*Pastikan memasukan File berkestensi jpg atau png saja. Max: 2MB</p>
                                @if ($errors->has('foto'))
                                    <div class="text-danger">
                                        {{ $errors->first('foto') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="riwayat_studi">Riwayat Studi: <span style="color:red;">*</span></label>
                                <input type="file" id="riwayat_studi"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                    {{-- accept="image/*" --}}
                                    name="riwayat_studi" value="">
                                <p>*Pastikan File Screenshots berkestensi PDF saja, dapat dilihat di oase
                                <p>
                                    <a href="https://oase.poltekharber.ac.id/" style="color: red ">Klik disini</a> 
                                </p>
                                @if ($errors->has('riwayat_studi'))
                                    <div class="text-danger">
                                        {{ $errors->first('riwayat_studi') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="ktm">Kartu Tanda Mahasiswa: <span style="color:red;">*</span></label>
                                <input type="file" id="ktm"
                                    accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                    name="ktm" value="">
                                <p>*Pastikan memasukan File berkestensi pdf saja</p>
                                @if ($errors->has('ktm'))
                                    <div class="text-danger">
                                        {{ $errors->first('ktm') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="sertif">Sertifikasi: <span style="color:red;">*</span></label>
                                <input type="file" id="sertif" multiple class="mb-4"
                                    accept=".rar,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                    name="sertif" value="">
                                <p>*Pastikan memasukan File berkestensi pdf saja</p>
                                @if ($errors->has('sertif'))
                                    <div class="text-danger">
                                        {{ $errors->first('sertif') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="input-box">
                                <label for="prodi">Program Studi : </label>
                                <input type="text" id="prodi" name="prodi" value="{{ $user->prodi }}"
                                    disabled>
                                @if ($errors->has('prodi'))
                                    <div class="text-danger">
                                        {{ $errors->first('prodi') }}
                                    </div>
                                @endif
                            </div>
                            <div class="input-box">
                                <label for="nama_organisasi">Organisasi Tujuan</label>
                                <select name="nama_organisasi" id="nama_organisasi">
                                    @php
                                        $uniqueOrganisasi = [];
                                    @endphp

                                    @foreach ($admin as $u)
                                        @if ($u->nama_organisasi == 'kesiswaan')
                                            @php
                                                continue;
                                            @endphp
                                        @elseif (!in_array($u->nama_organisasi, $uniqueOrganisasi))
                                            @php
                                                $uniqueOrganisasi[] = $u->nama_organisasi;
                                            @endphp
                                            <option style="text-align: center; padding-bottom: 5px;"
                                                value="{{ $u->nama_organisasi }}">
                                                {{ Str::upper($u->nama_organisasi) }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                @if ($errors->has('nama_organisasi'))
                                    <div class="text-danger">
                                        {{ $errors->first('nama_organisasi') }}
                                    </div>
                                @endif
                            </div>
                            <button class="submitButton btn"
                                {{ $user->status == 'calon' ? 'disabled' : '' }}>Daftar</button>
                                
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    {{-- <script src={{ asset('js/user.js') }}></script> --}}
</body>

</html>

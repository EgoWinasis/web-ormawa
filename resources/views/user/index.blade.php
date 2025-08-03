<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href='{{ asset('/css/root.css') }}'>

    <!-- link ke css landing -->
    <link rel="stylesheet" href='{{ asset('/css/admin.css') }}'>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            <div class="container py-4" >
                <div class="row justify-content-center" style="padding-top: 7%;padding-bottom: 7%">
                    <div class="col-md-8">
                        <div class="card shadow" >
                            <div class="card-header bg-primary text-white text-center">
                                <h4 class="mb-0">Form Pendaftaran Anggota</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" action="/anggota/store/{{ $user->id }}">
                                    @csrf
            
                                    <!-- Nama Lengkap -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control w-100" id="name" name="name" value="{{ $user->name }}" disabled>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- NIM -->
                                    <div class="mb-3">
                                        <label for="nim" class="form-label">NIM</label>
                                        <input type="text" class="form-control w-100" id="nim" maxlength="9" name="nim" value="{{ $user->nim }}" disabled>
                                        @error('nim')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <!-- Program Studi -->
                                     <div class="mb-3">
                                        <label for="prodi" class="form-label">Program Studi</label>
                                        <input type="text" class="form-control w-100" id="prodi" name="prodi" value="{{ $user->prodi }}" disabled>
                                        @error('prodi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- WhatsApp -->
                                    <div class="mb-3">
                                        <label for="nomor" class="form-label">WhatsApp</label>
                                        <input type="text" class="form-control w-100" id="nomor" maxlength="13" name="nomor" value="{{ $user->nomor }}" disabled>
                                        @error('nomor')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Semester -->
                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Semester</label>
                                        <input type="text" class="form-control w-100" id="semester" maxlength="2" name="semester" value="{{ $user->semester }}" disabled>
                                        @error('semester')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Pas Foto -->
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Pas Foto <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control w-100" id="foto" name="foto" accept="image/*">
                                        <small class="text-muted">File harus .jpg atau .png, max 2MB.</small>
                                        @error('foto')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Riwayat Studi -->
                                    <div class="mb-3">
                                        <label for="riwayat_studi" class="form-label">Riwayat Studi <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control w-100" id="riwayat_studi"
                                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                            name="riwayat_studi">
                                        <small class="text-muted">Hanya file PDF dari OASE:
                                            <a href="https://oase.poltekharber.ac.id/" target="_blank" class="text-primary">Klik di sini</a>
                                        </small>
                                        @error('riwayat_studi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- KTM -->
                                    <div class="mb-3">
                                        <label for="ktm" class="form-label">Kartu Tanda Mahasiswa <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control w-100" id="ktm"
                                            accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                            name="ktm">
                                        <small class="text-muted">File harus .pdf.</small>
                                        @error('ktm')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Sertifikasi -->
                                    <div class="mb-3">
                                        <label for="sertif" class="form-label">Sertifikasi <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control w-100" id="sertif" name="sertif" multiple
                                            accept=".rar,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        <small class="text-muted">File harus .pdf.</small>
                                        @error('sertif')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                   
            
                                    <!-- Organisasi Tujuan -->
                                    <div class="mb-3">
                                        <label for="nama_organisasi" class="form-label">Organisasi Tujuan</label>
                                        <select class="form-select w-100" name="nama_organisasi" id="nama_organisasi">
                                            @php $uniqueOrganisasi = []; @endphp
                                            @foreach ($admin as $u)
                                                @if ($u->nama_organisasi !== 'kesiswaan' && !in_array($u->nama_organisasi, $uniqueOrganisasi))
                                                    @php $uniqueOrganisasi[] = $u->nama_organisasi; @endphp
                                                    <option value="{{ $u->nama_organisasi }}">{{ Str::upper($u->nama_organisasi) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('nama_organisasi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
            
                                    <!-- Submit -->
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary px-4" {{ $user->status == 'calon' ? 'disabled' : '' }}>
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    {{-- <script src={{ asset('js/user.js') }}></script> --}}

    @include('chatbot')

</body>

</html>

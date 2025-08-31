<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendaftaran</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />

    <!-- FontAwesome & Google Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400;700&display=swap" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>

<body class="bg-light">

    @if (session()->has('succes'))
        <script>
            alert('Berhasil Mendaftar');
        </script>
    @endif

    @php
        use Illuminate\Support\Facades\DB;
        $brandImage = DB::table('brand_image')->latest('id')->first();
    @endphp

    <!-- HEADER -->
    <header class="bg-white shadow-sm">
        <div class="container-fluid d-flex justify-content-between align-items-center py-2 px-3">
            <div class="d-flex align-items-center">
                <img class="me-2" src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}"
                    alt="Logo" width="60">
                <h5 class="mb-0 fw-bold">Dashboard Pendaftaran</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-2 fw-semibold">{{ $user->name }}</span>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white border-end vh-100 p-3">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center {{ Route::is('user.index') ? 'active fw-bold text-primary' : 'text-dark' }}"
                            href="{{ route('user.index') }}">
                            <span class="material-symbols-outlined me-2">edit</span> Form
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center {{ Route::is('user.history') ? 'active fw-bold text-primary' : 'text-dark' }}"
                            href="{{ route('user.history') }}">
                            <span class="material-symbols-outlined me-2">inventory</span> Tahap Pendaftaran
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link d-flex align-items-center {{ Route::is('user.riwayat') ? 'active fw-bold text-primary' : 'text-dark' }}"
                            href="{{ route('user.riwayat') }}">
                            <span class="material-symbols-outlined me-2">history</span> Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-danger d-flex align-items-center p-0">
                                <span class="material-symbols-outlined me-2">close</span> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- MAIN CONTENT -->
            <main class="col-md-9 col-lg-10 px-md-4 py-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Form Pendaftaran Anggota</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="/anggota/store/{{ $user->id }}">
                            @csrf

                            <div class="row g-3">

                                <!-- Nama -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
                                </div>

                                <!-- NIM -->
                                <div class="col-md-6">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" maxlength="9" value="{{ $user->nim }}" disabled>
                                </div>

                                <!-- Prodi -->
                                <div class="col-md-6">
                                    <label for="prodi" class="form-label">Program Studi</label>
                                    <input type="text" class="form-control" id="prodi" value="{{ $user->prodi }}" disabled>
                                </div>

                                <!-- WhatsApp -->
                                <div class="col-md-6">
                                    <label for="nomor" class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" id="nomor" maxlength="13" value="{{ $user->nomor }}" disabled>
                                </div>

                                <!-- Semester -->
                                <div class="col-md-6">
                                    <label for="semester" class="form-label">Semester</label>
                                    <input type="text" class="form-control" id="semester" maxlength="2" value="{{ $user->semester }}" disabled>
                                </div>

                                <!-- Pas Foto -->
                                <div class="col-md-6">
                                    <label for="foto" class="form-label">Pas Foto <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                    <small class="text-muted">File harus .jpg/.png, max 2MB.</small>
                                </div>

                                <!-- Riwayat Studi -->
                                <div class="col-md-6">
                                    <label for="riwayat_studi" class="form-label">Riwayat Studi <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="riwayat_studi" name="riwayat_studi" accept="image/*">
                                    <small class="text-muted">File harus .jpg/.png, max 2MB. 
                                        <a href="https://oase.poltekharber.ac.id/" target="_blank">Klik di sini</a>
                                    </small>
                                </div>

                                <!-- KTM -->
                                <div class="col-md-6">
                                    <label for="ktm" class="form-label">KTM <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="ktm" name="ktm" accept=".pdf">
                                    <small class="text-muted">File harus .pdf</small>
                                </div>

                                <!-- Sertifikasi -->
                                <div class="col-md-6">
                                    <label for="sertif" class="form-label">Sertifikasi <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="sertif" name="sertif" multiple
                                        accept=".rar,.pdf,.doc,.docx">
                                    <small class="text-muted">File harus .pdf</small>
                                </div>

                                <!-- Organisasi -->
                                <div class="col-12">
                                    <label for="nama_organisasi" class="form-label">Organisasi Tujuan</label>
                                    <select class="form-select" name="nama_organisasi" id="nama_organisasi">
                                        @php $uniqueOrganisasi = []; @endphp
                                        @foreach ($admin as $u)
                                            @if ($u->nama_organisasi !== 'kesiswaan' && !in_array($u->nama_organisasi, $uniqueOrganisasi))
                                                @php $uniqueOrganisasi[] = $u->nama_organisasi; @endphp
                                                <option value="{{ $u->nama_organisasi }}">{{ Str::upper($u->nama_organisasi) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4"
                                    {{ $user->status == 'calon' ? 'disabled' : '' }}>
                                    Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <!-- JS Bootstrap & Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

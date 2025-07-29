<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN BEM</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">
                        Edit Jadwal Rutin
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('rutin.update', $rutin->id) }}">
                            @csrf
                            @method('POST') {{-- Ganti dengan PATCH jika rutenya RESTful --}}

                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari:</label>
                                <input type="text" id="hari" name="hari" value="{{ $rutin->hari }}"
                                    class="form-control @error('hari') is-invalid @enderror">
                                @error('hari')
                                    <div class="invalid-feedback">
                                        *Field ini wajib diisi dengan format yang benar
                                    </div>
                                @else
                                    <div class="form-text">*Tulis hari dengan format: senin-sabtu</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tempat-input" class="form-label">Tempat Rutinitas:</label>
                                <input type="text" id="tempat-input" name="tempat_kegiatan"
                                    value="{{ $rutin->tempat_kegiatan }}"
                                    class="form-control @error('tempat_kegiatan') is-invalid @enderror">
                                @error('tempat_kegiatan')
                                    <div class="invalid-feedback">
                                        *Wajib diisi
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="unit" class="form-label">Unit Ormawa:</label>
                                <input type="text" id="unit" name="unit" value="{{ $rutin->unit }}"
                                    class="form-control @error('unit') is-invalid @enderror">
                                @error('unit')
                                    <div class="invalid-feedback">
                                        *Wajib diisi
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                                <a href="/admin/rutin" class="btn btn-secondary">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap & Font Awesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>

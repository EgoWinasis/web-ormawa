<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Google Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Kegiatan</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form -->
                        <form method="post" enctype="multipart/form-data" action="/admin/kegiatan/{{ $kegiatan->id }}/edit">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kegiatan-input" class="form-label">Nama Kegiatan:</label>
                                        <input type="text" id="kegiatan-input" value="{{ $kegiatan->nama_kegiatan }}"
                                            name="nama_kegiatan" class="form-control">
                                        @error('nama_kegiatan')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="date-end-input" class="form-label">Tanggal Mulai:</label>
                                        <input type="date" id="date-end-input" value="{{ $kegiatan->tanggal_mulai }}"
                                            name="tanggal_mulai" class="form-control">
                                        @error('tanggal_mulai')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempat_kegiatan" class="form-label">Tempat Kegiatan:</label>
                                        <input type="text" id="tempat_kegiatan"
                                            value="{{ $kegiatan->tempat_kegiatan }}" name="tempat_kegiatan"
                                            class="form-control">
                                        @error('tempat_kegiatan')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan:</label>
                                        <input type="text" id="keterangan" value="{{ $kegiatan->keterangan }}"
                                            name="keterangan" class="form-control">
                                        @error('keterangan')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="img-input" class="form-label">Gambar:</label>
                                        <input type="file" id="img-input" accept="image/*"
                                            value="{{ $kegiatan->gambar }}" name="gambar" class="form-control">
                                        <small class="text-muted">*JPG atau PNG. Max: 2MB</small>
                                        @error('gambar')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="proposal" class="form-label">Proposal:</label>
                                        <input type="file" id="proposal"
                                            accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                            value="{{ $kegiatan->proposal }}" name="proposal" class="form-control">
                                        <small class="text-muted">*Hanya File PDF</small>
                                        @error('proposal')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="lpj" class="form-label">Laporan:</label>
                                        <input type="file" id="lpj"
                                            accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                                            name="lpj" class="form-control">
                                        <small class="text-muted">*Hanya File PDF</small>
                                        @error('lpj')
                                            <p class="text-danger small">*wajib di isi</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Table -->
                            <div class="table-responsive">
                                <table id="table-panitia" class="table table-striped table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($count = 0)
                                        @foreach ($panitia as $p)
                                            @if ($p->status == 'aktif')
                                                <tr>
                                                    @php($count++)
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->jabatan }}</td>
                                                    <td>
                                                        <input type="checkbox" name="panitia[]" value="{{ $p->user_id }}"
                                                            {{ $kegiatan->users->contains($p->user_id) ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="/admin/arsip" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table-panitia').DataTable({
                "ordering": false,
            });
        });
    </script>
</body>

</html>

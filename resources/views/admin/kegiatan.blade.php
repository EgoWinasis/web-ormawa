<div class="container my-4">
    <form method="POST" enctype="multipart/form-data" action="/admin/kegiatan/{{ $kegiatan->id }}/edit">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="kegiatan-input" class="form-label">Nama Kegiatan</label>
                            <input type="text" id="kegiatan-input" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="form-control @error('nama_kegiatan') is-invalid @enderror">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">*wajib di isi</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date-end-input" class="form-label">Tanggal Mulai</label>
                            <input type="date" id="date-end-input" name="tanggal_mulai" value="{{ $kegiatan->tanggal_mulai }}" class="form-control @error('tanggal_mulai') is-invalid @enderror">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">*wajib di isi</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_kegiatan" class="form-label">Tempat Kegiatan</label>
                            <input type="text" id="tempat_kegiatan" name="tempat_kegiatan" value="{{ $kegiatan->tempat_kegiatan }}" class="form-control @error('tempat_kegiatan') is-invalid @enderror">
                            @error('tempat_kegiatan')
                                <div class="invalid-feedback">*wajib di isi</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" id="keterangan" name="keterangan" value="{{ $kegiatan->keterangan }}" class="form-control @error('keterangan') is-invalid @enderror">
                            @error('keterangan')
                                <div class="invalid-feedback">*wajib di isi</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="img-input" class="form-label">Gambar</label>
                            <input type="file" id="img-input" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">*JPG atau PNG. Max: 2MB</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proposal" class="form-label">Proposal</label>
                            <input type="file" id="proposal" name="proposal" class="form-control @error('proposal') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            <small class="text-muted">*Hanya File PDF</small>
                            @error('proposal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lpj" class="form-label">Laporan</label>
                            <input type="file" id="lpj" name="lpj" class="form-control @error('lpj') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            <small class="text-muted">*Hanya File PDF</small>
                            @error('lpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5>Daftar Panitia</h5>
            <div class="table-responsive">
                <table id="table-panitia" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count = 0)
                        @foreach ($panitia as $p)
                            @if ($p->status == 'aktif')
                                @php($count++)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->jabatan }}</td>
                                    <td>
                                        <input type="checkbox" name="panitia[]" value="{{ $p->id }}" {{ $kegiatan->users->contains($p->id) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="/admin/arsip" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-panitia').DataTable();
    });
</script>

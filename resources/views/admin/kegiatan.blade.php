@extends('admin.layoutadmin.main')

@section('konten')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Kegiatan</h4>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/admin/kegiatan/{{ $kegiatan->id }}/edit">
                        @csrf
                        <div class="row g-4">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <!-- Nama Kegiatan -->
                                <div class="mb-3">
                                    <label for="kegiatan-input" class="form-label">Nama Kegiatan</label>
                                    <input type="text" id="kegiatan-input" 
                                           value="{{ $kegiatan->nama_kegiatan }}" 
                                           name="nama_kegiatan" 
                                           class="form-control @error('nama_kegiatan') is-invalid @enderror">
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback">*wajib di isi</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Mulai -->
                                <div class="mb-3">
                                    <label for="date-end-input" class="form-label">Tanggal Mulai</label>
                                    <input type="date" id="date-end-input" 
                                           value="{{ $kegiatan->tanggal_mulai }}" 
                                           name="tanggal_mulai" 
                                           class="form-control @error('tanggal_mulai') is-invalid @enderror">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">*wajib di isi</div>
                                    @enderror
                                </div>

                                <!-- Tempat Kegiatan -->
                                <div class="mb-3">
                                    <label for="tempat_kegiatan" class="form-label">Tempat Kegiatan</label>
                                    <input type="text" id="tempat_kegiatan" 
                                           value="{{ $kegiatan->tempat_kegiatan }}" 
                                           name="tempat_kegiatan" 
                                           class="form-control @error('tempat_kegiatan') is-invalid @enderror">
                                    @error('tempat_kegiatan')
                                        <div class="invalid-feedback">*wajib di isi</div>
                                    @enderror
                                </div>

                                <!-- Keterangan -->
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" id="keterangan" 
                                           value="{{ $kegiatan->keterangan }}" 
                                           name="keterangan" 
                                           class="form-control @error('keterangan') is-invalid @enderror">
                                    @error('keterangan')
                                        <div class="invalid-feedback">*wajib di isi</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <!-- Gambar -->
                                <div class="mb-3">
                                    <label for="img-input" class="form-label">Gambar</label>
                                    <input type="file" id="img-input" accept="image/*" 
                                           name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                                    <small class="form-text text-muted">*JPG atau PNG. Max: 2MB</small>
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Proposal -->
                                <div class="mb-3">
                                    <label for="proposal" class="form-label">Proposal</label>
                                    <input type="file" id="proposal" 
                                           accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf" 
                                           name="proposal" class="form-control @error('proposal') is-invalid @enderror">
                                    <small class="form-text text-muted">*Hanya File PDF</small>
                                    @error('proposal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- LPJ -->
                                <div class="mb-3">
                                    <label for="lpj" class="form-label">Laporan</label>
                                    <input type="file" id="lpj" 
                                           accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf" 
                                           name="lpj" class="form-control @error('lpj') is-invalid @enderror">
                                    <small class="form-text text-muted">*Hanya File PDF</small>
                                    @error('lpj')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Table Panitia -->
                        <div class="mt-4">
                            <h5>Daftar Panitia</h5>
                            <div class="table-responsive">
                                <table id="table-panitia" class="table table-striped table-bordered">
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
                                                        <input type="checkbox" name="panitia[]" value="{{ $p->id }}"
                                                            {{ $kegiatan->users->contains($p->id) ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/admin/arsip" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
@endsection

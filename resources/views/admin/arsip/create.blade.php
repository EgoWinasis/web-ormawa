@extends('admin.layoutadmin.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">

    <div class="row justify-content-center" style="padding-bottom: 4%">
        <div class="col-lg-8">

            <!-- Card -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Tambah Arsip</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('arsip.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Kegiatan -->
                        <div class="mb-3">
                            <label for="kegiatan-input" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                id="kegiatan-input" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                            @error('nama_kegiatan')
                            <div class="invalid-feedback">*wajib diisi</div>
                            @enderror
                        </div>
                        <!-- Tanggal Kegiatan -->
                        <div class="mb-3">
                            <label for="date-start-input" class="form-label">Tanggal Kegiatan</label>
                            <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                id="date-start-input" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                            @error('tanggal_mulai')
                            <div class="invalid-feedback">*wajib diisi</div>
                            @enderror
                        </div>

                        <!-- Tempat Kegiatan -->
                        <div class="mb-3">
                            <label for="tempat-input" class="form-label">Tempat Kegiatan</label>
                            <input type="text" class="form-control @error('tempat_kegiatan') is-invalid @enderror"
                                id="tempat-input" name="tempat_kegiatan" value="{{ old('tempat_kegiatan') }}">
                            @error('tempat_kegiatan')
                            <div class="invalid-feedback">*wajib diisi</div>
                            @enderror
                        </div>
                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                            <div class="invalid-feedback">*wajib diisi</div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="img-input" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="img-input"
                                name="gambar" accept="image/*">
                            <div class="form-text @error('gambar') text-danger @enderror">
                                *Pastikan gambar berekstensi JPG atau PNG saja. Max: 2MB
                            </div>
                        </div>





                        <!-- Proposal -->
                        <div class="mb-3">
                            <label for="proposal" class="form-label">Proposal</label>
                            <input type="file" class="form-control @error('proposal') is-invalid @enderror"
                                id="proposal" name="proposal"
                                accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf">
                            <div class="form-text @error('proposal') text-danger @enderror">
                                *Pastikan file berekstensi PDF saja.
                            </div>
                        </div>
                      



                     <!-- Buttons -->
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
    <a href="/admin/arsip" class="btn btn-secondary w-100 w-sm-auto px-5">Kembali</a>
    <button type="submit" class="btn btn-primary w-100 w-sm-auto px-5">Tambah</button>
</div>

                    </form>
                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
</div>


@endsection

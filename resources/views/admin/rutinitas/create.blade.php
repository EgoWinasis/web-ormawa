@extends('admin.layoutadmin.main')

@section('konten')
<div class="container-arsip d-flex active">

<div class="container"  style="padding-top:7%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">
                    Tambah Jadwal Rutin UKM
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('rutin.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari:</label>
                            <input type="text" id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror"
                                   value="{{ old('hari') }}" placeholder="Contoh: senin, selasa, rabu...">
                            @error('hari')
                                <div class="invalid-feedback">
                                    *Tulis hari dengan format: senin-sabtu
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat-input" class="form-label">Tempat Rutinitas:</label>
                            <input type="text" id="tempat-input" name="tempat_kegiatan" class="form-control @error('tempat_kegiatan') is-invalid @enderror"
                                   value="{{ old('tempat_kegiatan') }}">
                            @error('tempat_kegiatan')
                                <div class="invalid-feedback">
                                    *wajib di isi
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label">Unit Ormawa:</label>
                            <input type="text" id="unit" name="unit" class="form-control @error('unit') is-invalid @enderror"
                                   value="{{ old('unit') }}">
                            @error('unit')
                                <div class="invalid-feedback">
                                    *wajib di isi
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus me-1"></i> Tambah
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
</div>
@endsection

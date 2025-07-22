@extends('admin.layoutadmin.main')
@section('konten')
    <div id ="tambah-rutin active">
        <div style="margin-top: 5rem;" class="form-container">
            {{-- update --}}
            <form method="post" enctype="multipart/form-data" action="{{ route('rutin.store') }}">
                @csrf
                <div class="form-box">

                    <div class="input-box">
                        <label for="hari">Hari: </label>
                        <input type="text" id="hari" accept="image/*" value="{{ old('hari') }}" name="hari">
                        <p class="ket 
            @error('hari')  
                error
            @enderror ">
                            *Tulis hari dengan format: senin-sabtu</p>

                    </div>
                    <div class="input-box">
                        <label for="tempat-input">Tempat Rutinitas: </label>
                        <input type="text" id="tempat-input" value="{{ old('tempat_kegiatan') }}" name="tempat_kegiatan">
                        @error('tempat_kegiatan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                </div>
                <div class="form-box">

                    <div class="input-box">
                        <label for="unit">Unit Ormawa :</label>
                        <input type="text" id="unit" value="{{ old('unit') }}" name="unit">
                        @error('unit')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                    <input style="margin-top: 5rem;" class="submitButton" type="submit" value="Tambah">
                    
                    <a href="/admin/rutin" style="display: inline-block; margin-top: 5px; color: white; background-color: rgb(0, 173, 221); padding: 1px 70px; text-decoration: none; border-radius: 5px;">Kembali</a>
                </div>
                
            </form>
        </div>

    </div>
    {{-- <div id="tambah-arsip active">
        <div class="form-container">

            <form method="post" enctype="multipart/form-data" action="{{ route('rutin.store') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="hari" class="form-label">Hari: </label>
                        <input type="text" id="hari" class="form-control" value="{{ old('hari') }}" name="hari">
                        <p>*Tulis hari dengan format: senin-sabtu</p>
                        @error('hari')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label for="tempat-input" class="form-label">Tempat Rutinitas: </label>
                        <input type="text" id="tempat-input" class="form-control" value="{{ old('tempat_kegiatan') }}"
                            name="tempat_kegiatan">
                        @error('tempat_kegiatan')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="unit" class="form-label">Unit Ormawa: </label>
                        <input type="text" id="unit" class="form-control" value="{{ old('unit') }}"
                            name="unit">
                        <div class="form-text">*Unit Ormawa wajib di isi.</div>
                        @error('nama_kegiatan')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
                <div style="text-align: center; margin-top: 0px;">
                    <a href="/admin/arsip" style="color: white; background-color: rgb(0, 173, 221); padding: 0px 196px; text-decoration: none; border-radius: 5px;">Kembali</a>
                </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection

@extends('admin.layoutadmin.main')

@section('konten')
    <div id ="tambah-arsip d-flex active">
        <div class="form-container">

            <form method="post" enctype="multipart/form-data" action="{{ route('arsip.store') }}">
                @csrf
                <div class="form-box">
                    <div class="input-box">
                        <label for="kegiatan-input">Nama Kegiatan: </label>
                        <input type="text" id="kegiatan-input" value="{{ old('nama_kegiatan') }}" name="nama_kegiatan">
                        @error('nama_kegiatan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label for="img-input">Gambar: </label>
                        <input type="file" id="img-input" accept="image/*" value="{{ old('gambar') }}" name="gambar">
                        <p
                            class="ket 
                @error('gambar')  
                    error
                @enderror ">
                            *Pastikan memasukan gambar berkestensi jpg atau png saja. Max: 2MB</p>

                    </div>
                    <div class="input-box">
                        <label for="tempat-input">Tempat Kegiatan: </label>
                        <input type="text" id="tempat-input" value="{{ old('tempat_kegiatan') }}" name="tempat_kegiatan">
                        @error('tempat_kegiatan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                </div>
                <div class="form-box">
                    <div class="input-box">
                        <label for="date-start-input">Tanggal Mulai Kegiatan: </label>
                        <input type="date" id="date-start-input" value="{{ old('tanggal_mulai') }}" name="tanggal_mulai">
                        @error('tanggal_mulai')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="proposal">Proposal: </label>
                        <input type="file" id="proposal"
                            accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                            value="{{ old('proposal') }}" name="proposal">
                        <p
                            class="ket 
                @error('proposal')  
                    error
                @enderror ">
                            *Pastikan memasukan File berkestensi PDF saja.</p>
                    </div>
                    <div class="input-box">
                        <label for="keterangan">Keterangan :</label>
                        <input type="text" id="keterangan" value="{{ old('keterangan') }}" name="keterangan">
                        @error('nama_kegiatan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                    <input class="submitButton" type="submit" value="Tambah">
                </div>
            </form>
        </div>

    </div>
@endsection

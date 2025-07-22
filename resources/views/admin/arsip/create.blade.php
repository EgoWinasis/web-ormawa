{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ADMIN BEM</title>

</head>

<body>
    <style>
        body {
            background-color: #f4f2f2;
            /* Warna abu-abu terang */
        }
    </style>

    <!-- container -->
    <div class="container my-2">

        <div class="container my-2 d-flex justify-content-center">
            <h1>
                Form Tambah Arsip
            </h1>


        </div> --}}
@extends('admin.layoutadmin.main')
@section('konten')
    <div id="tambah-arsip active">
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
                        <label for="date-start-input">Tanggal Kegiatan: </label>
                        <input type="date" id="date-start-input" value="{{ old('tanggal_mulai') }}" name="tanggal_mulai">
                        @error('tanggal_mulai')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
        <script>
                const inputTanggal = document.getElementById('date-start-input');
                const today = new Date();
            
                // Fungsi untuk format tanggal ke "YYYY-MM-DD"
                function formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
            
                // Hitung batas minimum dan maksimum
                const minDate = new Date(today);
                minDate.setMonth(minDate.getMonth() - 3);
            
                const maxDate = new Date(today);
                maxDate.setMonth(maxDate.getMonth() + 3);
            
                // Set atribut min dan max ke input
                inputTanggal.min = formatDate(minDate);
                inputTanggal.max = formatDate(maxDate);
        </script>
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
                        @error('keterangan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                    <input class="submitButton" type="submit" value="Tambah">
                    <div style="text-align: center; margin-top: 15px;">
                    <a href="/admin/arsip" style="color: white; background-color: rgb(0, 173, 221); padding: 0px 196px; text-decoration: none; border-radius: 5px;">Kembali</a>
                </div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="kegiatan-input" class="form-label">Nama Kegiatan: </label>
                        <input type="text" id="kegiatan-input" class="form-control" value="{{ old('nama_kegiatan') }}"
                            name="nama_kegiatan">
                        @error('nama_kegiatan')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label for="tempat-input" class="form-label">Tempat Kegiatan: </label>
                        <input type="text" id="tempat-input" class="form-control" value="{{ old('tempat_kegiatan') }}"
                            name="tempat_kegiatan">
                        @error('tempat_kegiatan')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-2">
                        <label for="img-input" class="form-label">Gambar: </label>
                        <input type="file" id="img-input" class="form-control" accept="image/*"
                            value="{{ old('gambar') }}" name="gambar">
                        <div class="form-text">*Pastikan memasukan gambar berkestensi jpg atau png saja. Max: 2MB
                        </div>
                        @error('gambar')
                            <div class="text-danger">*Gambar wajib di upload</div>
                        @enderror
                    </div>


                    <div class="col-md-4">
                        <label for="date-start-input" class="form-label">Tanggal Mulai Kegiatan: </label>
                        <input type="date" id="date-start-input" class="form-control" value="{{ old('tanggal_mulai') }}"
                            name="tanggal_mulai">
                        @error('tanggal_mulai')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="proposal" class="form-label">Proposal: </label>
                        <input type="file" id="proposal" class="form-control"
                            accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                            value="{{ old('proposal') }}" name="proposal">
                        <div class="form-text">*Pastikan memasukan File berkestensi PDF saja.</div>
                        @error('proposal')
                            <div class="text-danger">*Proposal wajib di upload</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="keterangan" class="form-label">Keterangan: </label>
                        <input type="text" id="keterangan" class="form-control" value="{{ old('keterangan') }}"
                            name="keterangan">
                        <div class="form-text">*Keterangan wajib di isi.</div>
                        @error('keterangan')
                            <div class="text-danger">*wajib di isi</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">


                    <button class="btn btn-primary" type="submit">Tambah</button>
                    <div style="text-align: center; margin-top: 20px;">
                    <a href="/admin/arsip" style="color: white; background-color: rgb(0, 173, 221); padding: 0px 5px; text-decoration: none; border-radius: 5px;">Kembali</a>
                </div>
                </div> --}}
            </form>
        </div>
    </div>
@endsection
{{-- </div>
</body>

</html> --}}

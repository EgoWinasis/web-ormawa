<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="../../../../css/root.css">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../../../css/admin.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Data Calon</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div class="container-calon d-flex">
        <h2>{{ $panitia->name }}</h2>
        <img src="../../../../storage/{{ $panitia->foto }}" alt="foto calon anggota" width="180px" height="240px">
        <div class="container-both d-flex">
            <div class="container-data d-flex">
                <P>Prodi: {{ $panitia->prodi }}</P>
                <P>NIM: {{ $panitia->nim }}</P>
                <P>Semester: {{ $panitia->semester }}</P>
                <P>Nomor Wa: {{ $panitia->nomor }}</P>
                <a href="/admin/dashboard"> Kembali</a>
            </div>
            <hr style="width: 1px; height: 100%; color:black; margin:1rem">
            <div class="container-document d-flex">
                <p style="display: flex;">Downlaod: <span><a download="{{ $panitia->foto }}"
                            href="../../../../storage/{{ $panitia->foto }}"
                            title="{{ $panitia->nama }}_ktm">{{ Str::limit($panitia->foto, 10) }}_pas-foto</a></span>
                </p>
                <p style="display: flex;">Downlaod: <span><a download="{{ $panitia->ktm }}"
                            href="../../../../storage/{{ $panitia->ktm }}"
                            title="{{ $panitia->nama }}_ktm">{{ Str::limit($panitia->ktm, 10) }}_ktm</a></span></p>
                <p style="display: flex;">Downlaod: <span><a download="{{ $panitia->riwayat_studi }}"
                            href="../../../../storage/{{ $panitia->riwayat_studi }}"
                            title="{{ $panitia->riwayat_studi }}_studi">{{ Str::limit($panitia->riwayat_studi, 10) }}_studi</a></span>
                </p>
                <p style="display: flex;">Downlaod: <span><a download="{{ $panitia->sertif }}"
                            href="../../../../storage/{{ $panitia->sertif }}"
                            title="{{ $panitia->sertif }}_studi">{{ Str::limit($panitia->sertif, 10) }}_sertif</a></span>
                </p>
                <div style="gap: 1rem" class="d-flex">
                    <form class="d-flex" id='dataForm' style="gap: 1rem"
                        action="{{ route('admin.nextSession', ['id' => $panitia->id]) }}" method="post"> @csrf
                        <button type="button" class="btn btn-primary" id="acceptButton">Terima</button>
                    </form>
                    <form class="d-flex" id="dataFormReject" style="gap: 1rem"
                        action="{{ route('admin.reject', ['id' => $panitia->id]) }}" method="post"> @csrf
                        <button type="button" class="btn btn-danger" id="rejectButton">Tolak</button>
                    </form>
                </div>
                <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="inputModalLabel">Masukan Keterangan Aksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="additionalData" class="form-control"
                                    placeholder="Masukan Alasan">

                                <!-- Tempat Wawancara -->
                                <div class="mt-3">
                                    <label for="tempat_wawancara" class="form-label">Tempat Wawancara</label>
                                    <input type="text" id="tempat_wawancara" name="tempat_wawancara"
                                        class="form-control" placeholder="Masukkan tempat wawancara">
                                </div>

                                <!-- Tanggal Wawancara -->
                                <div class="mt-3">
                                    <label for="tgl_wawancara" class="form-label">Tanggal Wawancara</label>
                                    <input type="date" id="tgl_wawancara" name="tgl_wawancara" class="form-control">
                                </div>

                                <!-- Jam Wawancara -->
                                <div class="mt-3">
                                    <label for="jam_wawancara" class="form-label">Jam Wawancara</label>
                                    <input type="time" id="jam_wawancara" name="jam_wawancara" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary" id="confirmButton">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../../js/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    {{-- <script>
        let aksi = '';
        document.getElementById('acceptButton').onclick = function() {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'terima'
            myModal.show();

        };
        document.getElementById('rejectButton').onclick = function() {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'ditolak'
            myModal.show();
        };

        // document.getElementById('confirmButton').onclick = function() {
        //     var additionalData = document.getElementById('additionalData').value;

        //     // Append additionalData ke form jika diperlukan  
        //     var input = document.createElement('input');
        //     input.type = 'hidden';
        //     input.name = 'additional_data'; // Sesuaikan nama input sesuai backend Anda  
        //     input.value = additionalData;
        //     if (aksi == 'terima') {
        //         document.getElementById('dataForm').appendChild(input);

        //         // Submit form  
        //         document.getElementById('dataForm').submit();
        //     } else {
        //         document.getElementById('dataFormReject').appendChild(input);

        //         // Submit form  
        //         document.getElementById('dataFormReject').submit();
        //     }
        // };

        document.getElementById('confirmButton').onclick = function() {
            var additionalData = document.getElementById('additionalData').value;
            var tempatWawancara = document.getElementById('tempat_wawancara').value;
            var tglWawancara = document.getElementById('tgl_wawancara').value;
            var jamWawancara = document.getElementById('jam_wawancara').value; // Ambil nilai jam

            // Append additionalData, tempat_wawancara, tgl_wawancara, dan jam_wawancara ke form
            var inputAlasan = document.createElement('input');
            inputAlasan.type = 'hidden';
            inputAlasan.name = 'additional_data'; // Sesuaikan nama input sesuai backend Anda  
            inputAlasan.value = additionalData;

            var inputTempat = document.createElement('input');
            inputTempat.type = 'hidden';
            inputTempat.name = 'tempat_wawancara';
            inputTempat.value = tempatWawancara;

            var inputTanggal = document.createElement('input');
            inputTanggal.type = 'hidden';
            inputTanggal.name = 'tgl_wawancara';
            inputTanggal.value = tglWawancara;

            var inputJam = document.createElement('input'); // Input untuk jam wawancara
            inputJam.type = 'hidden';
            inputJam.name = 'jam_wawancara'; // Nama input untuk jam
            inputJam.value = jamWawancara;

            if (aksi == 'terima') {
                document.getElementById('dataForm').appendChild(inputAlasan);
                document.getElementById('dataForm').appendChild(inputTempat);
                document.getElementById('dataForm').appendChild(inputTanggal);
                document.getElementById('dataForm').appendChild(inputJam); // Menambahkan jam wawancara

                // Submit form  
                document.getElementById('dataForm').submit();
            } else {
                document.getElementById('dataFormReject').appendChild(inputAlasan);
                document.getElementById('dataFormReject').appendChild(inputTempat);
                document.getElementById('dataFormReject').appendChild(inputTanggal);
                document.getElementById('dataFormReject').appendChild(inputJam); // Menambahkan jam wawancara

                // Submit form  
                document.getElementById('dataFormReject').submit();
            }
        };
    </script> --}}

    {{-- <script>
        let aksi = '';
        document.getElementById('acceptButton').onclick = function() {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'terima'; // Set aksi ke "terima"
            // Tampilkan input untuk tempat, tanggal, dan jam wawancara
            document.getElementById('tempat_wawancara').parentElement.style.display = 'block';
            document.getElementById('tgl_wawancara').parentElement.style.display = 'block';
            document.getElementById('jam_wawancara').parentElement.style.display = 'block';
            myModal.show();
        };

        document.getElementById('rejectButton').onclick = function() {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'ditolak'; // Set aksi ke "ditolak"
            // Sembunyikan input untuk tempat, tangga
            // l, dan jam wawancara
            document.getElementById('tempat_wawancara').parentElement.style.display = 'none';
            document.getElementById('tgl_wawancara').parentElement.style.display = 'none';
            document.getElementById('jam_wawancara').parentElement.style.display = 'none';
            myModal.show();
        };

        document.getElementById('confirmButton').onclick = function() {
            var additionalData = document.getElementById('additionalData').value;

            // Buat input tersembunyi untuk alasan
            var inputAlasan = document.createElement('input');
            inputAlasan.type = 'hidden';
            inputAlasan.name = 'additional_data'; // Nama sesuai backend
            inputAlasan.value = additionalData;

            if (aksi === 'terima') {
                // Ambil nilai tempat, tanggal, dan jam wawancara
                var tempatWawancara = document.getElementById('tempat_wawancara').value;
                var tglWawancara = document.getElementById('tgl_wawancara').value;
                var jamWawancara = document.getElementById('jam_wawancara').value;

                // Buat input tambahan
                var inputTempat = document.createElement('input');
                inputTempat.type = 'hidden';
                inputTempat.name = 'tempat_wawancara';
                inputTempat.value = tempatWawancara;

                var inputTanggal = document.createElement('input');
                inputTanggal.type = 'hidden';
                inputTanggal.name = 'tgl_wawancara';
                inputTanggal.value = tglWawancara;

                var inputJam = document.createElement('input');
                inputJam.type = 'hidden';
                inputJam.name = 'jam_wawancara';
                inputJam.value = jamWawancara;

                // Tambahkan input ke form
                document.getElementById('dataForm').appendChild(inputAlasan);
                document.getElementById('dataForm').appendChild(inputTempat);
                document.getElementById('dataForm').appendChild(inputTanggal);
                document.getElementById('dataForm').appendChild(inputJam);

                // Submit form
                document.getElementById('dataForm').submit();
            } else {
                // Tambahkan hanya input alasan untuk Reject
                document.getElementById('dataFormReject').appendChild(inputAlasan);

                // Submit form
                document.getElementById('dataFormReject').submit();
            }
        };
    </script> --}}

    <script>
        let aksi = '';
    
        document.getElementById('acceptButton').onclick = function() {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'terima'; // Set aksi ke "terima"
            // Tampilkan input untuk tempat, tanggal, dan jam wawancara
            document.getElementById('tempat_wawancara').parentElement.style.display = 'block';
            document.getElementById('tgl_wawancara').parentElement.style.display = 'block';
            document.getElementById('jam_wawancara').parentElement.style.display = 'block';
            myModal.show();
        };
    
        document.getElementById('rejectButton').onclick = function() {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'ditolak'; // Set aksi ke "ditolak"
            // Sembunyikan input untuk tempat, tanggal, dan jam wawancara
            document.getElementById('tempat_wawancara').parentElement.style.display = 'none';
            document.getElementById('tgl_wawancara').parentElement.style.display = 'none';
            document.getElementById('jam_wawancara').parentElement.style.display = 'none';
            myModal.show();
        };
    
        document.getElementById('confirmButton').onclick = function() {
            var additionalData = document.getElementById('additionalData').value;
    
            // Validasi alasan tidak boleh kosong
            if (!additionalData) {
                alert('Alasan wajib diisi!');
                return;
            }
    
            // Validasi untuk "Tolak"
            if (aksi === 'ditolak') {
                // Buat input tersembunyi untuk alasan
                var inputAlasan = document.createElement('input');
                inputAlasan.type = 'hidden';
                inputAlasan.name = 'additional_data'; // Nama sesuai backend
                inputAlasan.value = additionalData;
    
                // Tambahkan input ke form dan submit
                document.getElementById('dataFormReject').appendChild(inputAlasan);
                document.getElementById('dataFormReject').submit();
            }
    
            // Validasi untuk "Terima"
            if (aksi === 'terima') {
                var tempatWawancara = document.getElementById('tempat_wawancara').value;
                var tglWawancara = document.getElementById('tgl_wawancara').value;
                var jamWawancara = document.getElementById('jam_wawancara').value;
    
                // Cek jika ada field kosong
                if (!tempatWawancara || !tglWawancara || !jamWawancara) {
                    alert('Tempat, tanggal, dan jam wawancara wajib diisi untuk menerima!');
                    return;
                }
    
                // Validasi tanggal harus lebih besar atau sama dengan hari ini
                let today = new Date().toISOString().split('T')[0];
                if (tglWawancara < today) {
                    alert('Tanggal wawancara tidak boleh kurang dari hari ini!');
                    return;
                }
    
                // Buat input tambahan
                var inputTempat = document.createElement('input');
                inputTempat.type = 'hidden';
                inputTempat.name = 'tempat_wawancara';
                inputTempat.value = tempatWawancara;
    
                var inputTanggal = document.createElement('input');
                inputTanggal.type = 'hidden';
                inputTanggal.name = 'tgl_wawancara';
                inputTanggal.value = tglWawancara;
    
                var inputJam = document.createElement('input');
                inputJam.type = 'hidden';
                inputJam.name = 'jam_wawancara';
                inputJam.value = jamWawancara;
    
                // Buat input untuk alasan
                var inputAlasan = document.createElement('input');
                inputAlasan.type = 'hidden';
                inputAlasan.name = 'additional_data'; // Nama sesuai backend
                inputAlasan.value = additionalData;
    
                // Tambahkan input ke form
                document.getElementById('dataForm').appendChild(inputAlasan);
                document.getElementById('dataForm').appendChild(inputTempat);
                document.getElementById('dataForm').appendChild(inputTanggal);
                document.getElementById('dataForm').appendChild(inputJam);
    
                // Submit form
                document.getElementById('dataForm').submit();
            }
        };
    </script>
</body>

</html>

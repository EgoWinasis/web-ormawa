<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="../../../../css/root.css">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../../../css/admin.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Data Calon</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6 mx-auto">


                <div class="card shadow mb-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Detail Calon Anggota</h4>
                    </div>

                    <div class="card-body">
                        <!-- Photo -->
                        <div class="mb-4 d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $panitia->foto) }}" alt="foto calon anggota"
                                class="img-thumbnail shadow-sm" style=" object-fit: cover; border-radius: 8px;">
                        </div>

                        <!-- Single Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <tbody>
                                    <tr>
                                        <th>NIM</th>
                                        <td>{{ $panitia->nim }}</td>
                                    </tr>
                                    <tr>
                                        <th>NAMA</th>
                                        <td>{{ $panitia->name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Prodi</th>
                                        <td>{{ $panitia->prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Semester</th>
                                        <td>{{ $panitia->semester }}</td>
                                    </tr>

                                    <tr>
                                        <th>Nomor WA</th>
                                        <td>{{ $panitia->nomor }}</td>
                                    </tr>

                                    <tr>
                                        <th>KTM</th>
                                        <td>
                                            <a download="{{ $panitia->ktm }}"
                                                href="{{ asset('storage/' . $panitia->ktm) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Studi</th>
                                        <td>
                                            <a download="{{ $panitia->riwayat_studi }}"
                                                href="{{ asset('storage/' . $panitia->riwayat_studi) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sertifikasi</th>
                                        <td>
                                            <a download="{{ $panitia->sertif }}"
                                                href="{{ asset('storage/' . $panitia->sertif) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <form id="dataForm" action="{{ route('admin.nextSession', ['id' => $panitia->user_id]) }}"
                                method="post">
                                @csrf
                                <button type="button" class="btn btn-primary" id="acceptButton">Terima</button>
                            </form>
                            <form id="dataFormReject" action="{{ route('admin.reject', ['id' => $panitia->user_id]) }}"
                                method="post">
                                @csrf
                                <button type="button" class="btn btn-danger" id="rejectButton">Tolak</button>
                            </form>
                        </div>

                        <!-- Back Button -->
                        <div class="text-center mt-3">
                            <a href="/admin/dashboard" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputModalLabel">Masukan Keterangan Aksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="additionalData" class="form-control mb-3" placeholder="Masukan Alasan">

                    <div class="mb-3">
                        <label for="tempat_wawancara" class="form-label">Tempat Wawancara</label>
                        <input type="text" id="tempat_wawancara" name="tempat_wawancara" class="form-control"
                            placeholder="Masukkan tempat wawancara">
                    </div>

                    <div class="mb-3">
                        <label for="tgl_wawancara" class="form-label">Tanggal Wawancara</label>
                        <input type="date" id="tgl_wawancara" name="tgl_wawancara" class="form-control">
                    </div>

                    <div class="mb-3">
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



    <script src="../../js/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


    <script>
        let aksi = '';

        document.getElementById('acceptButton').onclick = function () {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'terima'; // Set aksi ke "terima"
            // Tampilkan input untuk tempat, tanggal, dan jam wawancara
            document.getElementById('tempat_wawancara').parentElement.style.display = 'block';
            document.getElementById('tgl_wawancara').parentElement.style.display = 'block';
            document.getElementById('jam_wawancara').parentElement.style.display = 'block';
            myModal.show();
        };

        document.getElementById('rejectButton').onclick = function () {
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));
            aksi = 'ditolak'; // Set aksi ke "ditolak"
            // Sembunyikan input untuk tempat, tanggal, dan jam wawancara
            document.getElementById('tempat_wawancara').parentElement.style.display = 'none';
            document.getElementById('tgl_wawancara').parentElement.style.display = 'none';
            document.getElementById('jam_wawancara').parentElement.style.display = 'none';
            myModal.show();
        };

        document.getElementById('confirmButton').onclick = function () {
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

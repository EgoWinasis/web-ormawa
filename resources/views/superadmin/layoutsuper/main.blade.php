<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="../../css/root.css">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>SUPER ADMIN</title>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <header>
        @include('superadmin.layoutsuper.header')
    </header>
    @if (session()->has('success'))
        <script>
            // Menampilkan SweetAlert2 setelah halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    position: 'top-end', // Posisi di pojok kanan atas
                    icon: 'success', // Ikon sukses
                    title: '{{ session('success') }}', // Pesan sukses
                    showConfirmButton: false, // Tidak menampilkan tombol konfirmasi
                    timer: 3000, // Waktu tampil 3 detik
                    toast: true, // Menggunakan mode toast
                    background: '#28a745', // Warna latar belakang hijau
                    color: 'white', // Warna teks putih
                    timerProgressBar: true, // Menampilkan progress bar
                });
            });
        </script>
    @endif


    <!-- container -->
    <div class="container-main d-flex">
        @include('superadmin.layoutsuper.sidebar')

        <div class="container-content">
            @yield('konten')

        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
    {{-- <script src="{{ asset('js/user.js') }}"></script> --}}
</body>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <script>
    $(document).ready(function () {
       $('#anggotaTable').DataTable({
  ordering: false
});


        $('.toggle-agendas').click(function () {
            const userId = $(this).data('user');
            const target = $('#agenda-' + userId);
            target.toggle(); // simple show/hide toggle
        });
    });

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.show-agendas-btn');
  
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const anggotas = JSON.parse(btn.getAttribute('data-anggota'));

            // console.log(anggotas);
              index = 1;
            if (anggotas.length === 0) {
                Swal.fire('Belum Ada Panitia');
                return;
            }

            let htmlTable = `
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f0f0f0;">
                            <th style="border: 1px solid #ddd; padding: 8px;">No</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            anggotas.forEach(anggota => {
                htmlTable += `
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">${index++}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">${anggota.name}</td>
                    </tr>
                `;
            });

            htmlTable += '</tbody></table>';

            Swal.fire({
                title: 'Daftar Panitia',
                html: htmlTable,
                width: '600px',
                confirmButtonText: 'Tutup',
                scrollbarPadding: false,
            });
        });
    });
});

$(document).ready(function() {
    $('.btn-edit-jabatan').click(function() {
        const $row = $(this).closest('tr');
        const userId = $row.data('user-id');
        const currentJabatan = $row.find('.jabatan').text().trim();

        Swal.fire({
            title: 'Edit Jabatan',
            input: 'text',
            inputLabel: 'Jabatan',
            inputValue: currentJabatan,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Jabatan tidak boleh kosong!';
                }
            }
        }).then((result) => {
            if (result.value) {
                const newJabatan = result.value;

                $.ajax({
                     url: `/admin/kegiatan/panitia/${userId}/update-jabatan`, // Your route to update jabatan
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        jabatan: newJabatan
                    },
                   success: function(response) {
    if(response.success) {
        // Update the jabatan text in the current row
        $row.find('.jabatan').text(newJabatan);

        Swal.fire('Berhasil!', 'Jabatan telah diupdate.', 'success').then(() => {
            // Reload the page after user clicks OK
            location.reload();
        });
    } else {
        Swal.fire('Gagal!', response.message || 'Terjadi kesalahan.', 'error');
    }
}
,
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan pada server.', 'error');
                    }
                });
            }
        });
    });
});

    let parsedData = [];

    document.getElementById('importBtn').addEventListener('click', function () {
        const fileInput = document.getElementById('excelFile');
        const file = fileInput.files[0];

        if (!file) {
            alert('Silakan pilih file Excel terlebih dahulu.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const sheet = workbook.Sheets[workbook.SheetNames[0]];
            const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });
            
            parsedData = []; // reset data
            const tbody = document.querySelector('#anggotaTable tbody');
            tbody.innerHTML = ''; // clear table

            rows.slice(1).forEach((row, index) => {
                if (row.length === 0 || !row[2]) return; // skip invalid

                parsedData.push({
                    prodi: row[1] || '',
                    nim: row[2] || '',
                    nama: row[3] || '',
                    jk: row[4] || '',
                    jalur: row[5] || '',
                    semester: row[6] || '',
                    kelas: row[7] || '',
                });

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${row[1] || ''}</td>
                    <td>${row[2] || ''}</td>
                    <td>${row[3] || ''}</td>
                    <td>${row[4] || ''}</td>
                    <td>${row[5] || ''}</td>
                    <td>${row[6] || ''}</td>
                    <td>${row[7] || ''}</td>
                `;
                tbody.appendChild(tr);
            });
        };

        reader.readAsArrayBuffer(file);
    });

    document.getElementById('simpanBtn').addEventListener('click', function () {
        if (parsedData.length === 0) {
            alert('Tidak ada data untuk disimpan.');
            return;
        }

   

        $.ajax({
            url: "{{ route('mahasiswa.store') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                data: parsedData
            },
            success: function (response) {
                alert(response.message || 'Data berhasil disimpan!');
                parsedData = [];
                $('#anggotaTable').DataTable().clear().draw(); // Clear table if using DataTable
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Gagal menyimpan data.');
            }
        });
    });

</script>


</html>

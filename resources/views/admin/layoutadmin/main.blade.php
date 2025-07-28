<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>ADMIN</title>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>
    <header>
        @include('admin.layoutadmin.header')
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
        @include('admin.layoutadmin.sidebar')

        <div class="container-content">
            @yield('konten')

            
            
            
        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
            const agendas = JSON.parse(btn.getAttribute('data-agendas'));

            console.log(agendas);
            
            if (agendas.length === 0) {
                Swal.fire('Belum Ada Kegiatan');
                return;
            }

            let htmlTable = `
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f0f0f0;">
                            <th style="border: 1px solid #ddd; padding: 8px;">Kegiatan</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            agendas.forEach(agenda => {
                const date = new Date(agenda.tanggal_mulai);
                const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });

                htmlTable += `
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">${agenda.nama_kegiatan}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">${formattedDate}</td>
                    </tr>
                `;
            });

            htmlTable += '</tbody></table>';

            Swal.fire({
                title: 'Daftar Kegiatan',
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

flatpickr("#date-start-input", {
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(-90), // 3 bulan ke belakang
        maxDate: new Date().fp_incr(90),  // 3 bulan ke depan
        defaultDate: new Date()           // Tanggal default: hari ini
    });

    
</script>

</html>

@php
use Illuminate\Support\Facades\DB;
$brandImage = DB::table('brand_image')->latest('id')->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    {{-- <link rel="stylesheet" href="../../css/root.css"> --}}

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

    <!-- Custom Style -->
    <style>
        .active {
            background-color: #29A1D4;
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: #000;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            background-color: #29A1D4;
            color: black !important;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #29A1D4;">
        <div class="container-fluid">
            <button class="btn btn-outline-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('storage/file-logo/' . ($brandImage->path ?? 'landing-page.png')) }}" alt="Logo"
                    style="max-height: 40px;" class="me-2">
                <span class="fw-bold text-white">Ormawa</span>
            </a>
        </div>
    </nav>

    <!-- SIDEBAR: MOBILE -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column px-2">
                @foreach([
                ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                ['route' => 'admin.news', 'icon' => 'fa-bullhorn', 'label' => 'News'],
                ['route' => 'admin.arsip', 'icon' => 'fa-bookmark', 'label' => 'Arsip'],
                ['route' => 'admin.otor', 'icon' => 'fa-bookmark', 'label' => 'Otorisasi Arsip'],
                ['route' => 'admin.absensi', 'icon' => 'fa-box', 'label' => 'Data Ormawa'],
                ['route' => 'admin.tambahAdminView', 'icon' => 'fa-user-plus', 'label' => 'Create User'],
                ['route' => 'admin.profile', 'icon' => 'fa-user-circle', 'label' => 'Data Profile'],
                ['route' => 'mahasiswa', 'icon' => 'fa-user-graduate', 'label' => 'Data Mahasiswa'],
                ['route' => 'admin.setting', 'icon' => 'fa-cog', 'label' => 'Pengaturan'],
                ] as $item)
                <li class="nav-item {{ Route::is($item['route']) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($item['route']) }}">
                        <i class="fas {{ $item['icon'] }}"></i> {{ $item['label'] }}
                    </a>
                </li>
                @endforeach
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
            <div class="px-3 py-2 border-top mt-3">
                <small class="text-muted d-block">
                    Login sebagai:<br>
                    <strong>{{ Auth::user()->name }}</strong>
                </small>
            </div>
        </div>
    </div>

    <!-- MAIN LAYOUT -->
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- SIDEBAR: DESKTOP -->
            <div class="col-lg-2 d-none d-lg-block bg-light d-flex flex-column min-vh-100 p-0">

                <ul class="nav flex-column px-2 pt-3">
                    @foreach([
                    ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard'],
                    ['route' => 'admin.news', 'icon' => 'fa-bullhorn', 'label' => 'News'],
                    ['route' => 'admin.arsip', 'icon' => 'fa-bookmark', 'label' => 'Arsip'],
                    ['route' => 'admin.otor', 'icon' => 'fa-bookmark', 'label' => 'Otorisasi Arsip'],
                    ['route' => 'admin.absensi', 'icon' => 'fa-box', 'label' => 'Data Ormawa'],
                    ['route' => 'admin.tambahAdminView', 'icon' => 'fa-user-plus', 'label' => 'Create User'],
                    ['route' => 'admin.profile', 'icon' => 'fa-user-circle', 'label' => 'Data Profile'],
                    ['route' => 'mahasiswa', 'icon' => 'fa-user-graduate', 'label' => 'Data Mahasiswa'],
                    ['route' => 'admin.setting', 'icon' => 'fa-cog', 'label' => 'Pengaturan'],
                    ] as $item)
                    <li class="nav-item {{ Route::is($item['route']) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route($item['route']) }}">
                            <i class="fas {{ $item['icon'] }}"></i> {{ $item['label'] }}
                        </a>
                    </li>
                    @endforeach
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
                <div class="px-3 py-2 border-top mt-3">
                    <small class="text-muted d-block">
                        Login sebagai:<br>
                        <strong>{{ Auth::user()->name }}</strong>
                    </small>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <main class="col-lg-10 p-4">
                @yield('konten')
            </main>
        </div>
    </div>



    @include('chatbot')


    <!-- Bootstrap JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
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

        $(document).ready(function () {
            $('.btn-edit-jabatan').click(function () {
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
                            success: function (response) {
                                if (response.success) {
                                    // Update the jabatan text in the current row
                                    $row.find('.jabatan').text(newJabatan);

                                    Swal.fire('Berhasil!',
                                            'Jabatan telah diupdate.', 'success')
                                        .then(() => {
                                            // Reload the page after user clicks OK
                                            location.reload();
                                        });
                                } else {
                                    Swal.fire('Gagal!', response.message ||
                                        'Terjadi kesalahan.', 'error');
                                }
                            },
                            error: function () {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan pada server.', 'error');
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
                const workbook = XLSX.read(data, {
                    type: 'array'
                });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
                const rows = XLSX.utils.sheet_to_json(sheet, {
                    header: 1
                });

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
                    // 
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



        function showStatusInfo(status, keterangan) {
            let icon, title, text;

            switch (status) {
                case 0:
                    icon = 'info';
                    title = 'Berkas Sedang Direview';
                    text = 'Berkas kamu sedang dalam proses pemeriksaan.';
                    break;
                case 1:
                    icon = 'success';
                    title = 'Berkas Disetujui';
                    text = 'Berkas kamu telah disetujui.';
                    break;
                case 2:
                    icon = 'error';
                    title = 'Berkas Ditolak';
                    text = 'Berkas kamu ditolak.';
                    break;
                default:
                    icon = 'warning';
                    title = 'Status Tidak Diketahui';
                    text = 'Status Berkas tidak valid.';
            }

            Swal.fire({
                icon: icon,
                title: title,
                html: `<p>${text}</p><hr><p><strong>Keterangan:</strong> ${keterangan}</p>`,
                confirmButtonColor: '#3085d6',
            });
        }

       function ubahStatus(tipe, id) {
    Swal.fire({
        title: `Ubah Status ${tipe.toUpperCase()}`,
        html: `
            <div style="display: flex; flex-direction: column; gap: 1rem; text-align: left;">
                <div>
                    <label for="swal-status" style="font-weight: 600; margin-bottom: 0.5rem;">Pilih Status:</label>
                    <select id="swal-status" class="swal2-input" style="width: 100%;">
                        <option value="" selected disabled>-- Pilih Status --</option>
                        <option value="1">Disetujui</option>
                        <option value="2">Ditolak</option>
                    </select>
                </div>
                <div>
                    <label for="swal-catatan" style="font-weight: 600; margin-bottom: 0.5rem;">Catatan:</label>
                    <textarea id="swal-catatan" class="swal2-textarea" placeholder="Masukkan catatan untuk pengajuan ini..." style="width: 100%; height: 100px;"></textarea>
                </div>
            </div>
        `,
        customClass: {
            popup: 'swal-wide'
        },
        showCancelButton: true,
        confirmButtonText: 'Update',
        cancelButtonText: 'Batal',
        focusConfirm: false,
        preConfirm: () => {
            const status = Swal.getPopup().querySelector('#swal-status').value;
            const catatan = Swal.getPopup().querySelector('#swal-catatan').value.trim();

            if (!status) {
                Swal.showValidationMessage('Status harus dipilih!');
            }
            if (!catatan) {
                Swal.showValidationMessage('Catatan harus diisi!');
            }

            return { status, catatan };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const { status, catatan } = result.value;

            fetch(`/admin/ubah-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id,
                    tipe: tipe,
                    status: status,
                    catatan: catatan
                })
            })
            .then(res => res.json())
            .then(res => {
                Swal.fire('Berhasil!', res.message, 'success').then(() => {
                    location.reload();
                });
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Gagal!', 'Terjadi kesalahan.', 'error');
            });
        }
    });
}





    </script>

</body>

</html>

@extends('admin.layoutadmin.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">


    <div class="row">

        <!-- TABEL PENGURUS -->
        <div class="col-12 mb-5">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Pengurus</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle" id="pengurusTable">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Kegiatan Diikuti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($anggota as $p)
                            @if ($p['user']['status'] === 'aktif' && $p['user']['jabatan'] !== 'anggota')
                            @php($count++)
                            <tr data-user-id="{{ $p['user']['id'] }}">
                                <td>{{ $count }}</td>
                                <td>{{ $p['user']['name'] }}</td>
                                <td>{{ $p['user']['jabatan'] }}</td>
                                <td class="kegiatan text-center">
                                    @if (count($p['agendas']) > 0)
                                    <button class="btn btn-sm btn-primary show-agendas-btn"
                                        data-agendas='@json($p["agendas"])'>
                                        {{ count($p["agendas"]) }}
                                    </button>
                                    @else
                                    <span class="text-muted">Belum Ada Kegiatan</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-edit-jabatan mx-2" title="Edit Jabatan">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <form action="{{ url('admin/kegiatan/panitia/' . $p['user']['id'] . '/destroy') }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota?')"
                                        style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>

        <!-- TABEL ANGGOTA -->
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Anggota</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle" id="anggotaTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Kegiatan Diikuti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 0)
                                @foreach ($anggota as $p)
                                @if ($p['user']['status'] === 'aktif' && $p['user']['jabatan'] === 'anggota')
                                @php($count++)
                                <tr data-user-id="{{ $p['user']['id'] }}">
                                    <td>{{ $count }}</td>
                                    <td>{{ $p['user']['name'] }}</td>
                                    <td>{{ $p['user']['jabatan'] }}</td>
                                    <td class="kegiatan text-center">
                                        @if (count($p['agendas']) > 0)
                                        <button class="btn btn-sm btn-primary show-agendas-btn"
                                            data-agendas='@json($p["agendas"])'>
                                            {{ count($p["agendas"]) }}
                                        </button>
                                        @else
                                        <span class="text-muted">Belum Ada Kegiatan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning btn-edit-jabatan mx-2"
                                            title="Edit Jabatan">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        <form
                                            action="{{ url('admin/kegiatan/panitia/' . $p['user']['id'] . '/destroy') }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota?')"
                                            style="display:inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@section('js')
    <script>
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
    </script>
@endsection
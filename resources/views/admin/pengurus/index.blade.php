@extends('admin.layoutadmin.main')

@section('konten')
<div class="container-arsip d-flex active">

<div class="container" style="padding-top: 70px">
    <h2 class="text-center">Daftar Anggota Aktif</h2>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header  d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Data
                    </h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-hover table-bordered align-middle fl-table" id="anggotaTable">
                        <thead class="table-light">
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
                                @if ($p['user']['status'] === 'aktif')
                                    @php($count++)
                                    <tr data-user-id="{{ $p['user']['id'] }}">
                                        <td>{{ $count }}</td>
                                        <td>{{ $p['user']['name'] }}</td>
                                        <td>{{ $p['user']['jabatan'] }}</td>
                                        <td class="kegiatan text-center">
                                            @if (count($p['agendas']) > 0)
                                                <button class="btn btn-sm btn-primary show-agendas-btn" data-agendas='@json($p["agendas"])'>
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


                                            <form action="{{ url('kegiatan/panitia/' . $p['user']['id'] . '/destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota?')" style="display:inline;">
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
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>
</div>
</div>
@endsection

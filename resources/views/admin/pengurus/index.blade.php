@extends('admin.layoutadmin.main')
@section('konten')
    <div class="container-absensi d-flex active">
        <h2>Daftar Anggota Aktif</h2>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>kegiatan Diikuti</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @php($count = 0)
                    @foreach ($anggota as $p)
                        @if ($p->status == 'aktif')
                            <tr>
                                @php($count++)
                                <td>{{ $count }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->jabatan }}</td>
                                <td class="kegiatan">
                                    @if (count($p->agendas) != 0)
                                        <span style="display: flex; justify-content: center">
                                            <button style="width: 3rem;"
                                                onclick="toggleFlyout(event)">{{ count($p->agendas) }}</button>
                                            <div class="flyout" style="display: none;">

                                                <ul>
                                                    @foreach ($p->agendas as $agenda)
                                                        <li>{{ $agenda->nama_kegiatan }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </span>
                                    @else
                                        Belum Ada Kegiatan
                                    @endif
                                </td>
                                <td> <span>
                                        <form action="kegiatan/panitia/{{ $p->id }}/destroy" method="post"> @csrf
                                            @method('delete')
                                            <button onclick="return confirm('yakin ingin menghapus anggota?')"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                        </form>
                                    </span></td>
                            </tr>
                        @endif
                    @endforeach


                <tbody>
            </table>
        </div>
    </div>

@endsection

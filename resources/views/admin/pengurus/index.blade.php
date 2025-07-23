@extends('admin.layoutadmin.main')
@section('konten')
    <div class="container " style="padding-top: 70px">
        <h2>Daftar Anggota Aktif</h2>
     
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="table table-hovered table-bordered fl-table" id="anggotaTable">
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
                                                @if ($p['user']['status'] == 'aktif')
                                                    <tr>
                                                        @php($count++)
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $p['user']['name'] }}</td>
                                                        <td>{{ $p['user']['jabatan'] }}</td>
                                                        <td class="kegiatan">
                                                            @if (count($p['agendas']) != 0)
                                                                <span style="display: flex; justify-content: center">
                                                                <button class="btn btn-sm btn-primary show-agendas-btn" 
                            data-agendas='@json($p["agendas"])'>
                            {{ count($p["agendas"]) }}
                        </button>

                                    @else
                                        Belum Ada Kegiatan
                                    @endif
                                </td>
                                <td>
                                    <form action="kegiatan/panitia/{{ $p['user']['id'] }}/destroy" method="post">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('yakin ingin menghapus anggota?')">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach



                <tbody>
            </table>
                    </div>
                </div>
            </div>
            
        
    </div>

@endsection

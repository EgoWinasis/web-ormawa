@extends('superadmin.layoutsuper.main')
@section('konten')

<div class="container-absensi d-flex active">
    <h2>Total Anggota</h2>
    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>WhatsApp</th>
                    <th>Unit</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @php($count = 0)

                @foreach ($anggota as $p)
                    @if ($p->status == 'aktif')
                        <tr>
                            @php($count++)
                            <td>{{ $count }}</th>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->nomor }}</td>
                            <td>{{ $p->nama_organisasi }}</td>
                            <td>{{ $p->jabatan }}</td>
                        </tr>
                    @endif
                @endforeach



            <tbody>
        </table>
    </div>
</div>
    
@endsection
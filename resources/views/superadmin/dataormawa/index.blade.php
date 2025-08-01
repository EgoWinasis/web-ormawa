@extends('superadmin.layoutsuper.main')
@section('konten')

<div class="container-arsip d-flex active">

    <div class="container"  style="padding-top:7%">

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            Total Anggota
                        </h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-hover table-bordered align-middle fl-table" id="anggotaTable">
                            <thead class="table-light">
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
            </div>
        </div>
    </div>
</div>

@endsection

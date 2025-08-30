@extends('superadmin.layoutsuper.main')
@section('konten')

<div class="container py-4" style="margin-top: 2rem">


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
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" id="anggotaTable">
                            <thead class="table-primary">
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

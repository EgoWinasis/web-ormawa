@extends('user.layout.main')


@section('konten')
<div class="container py-4" style="margin-top: 2rem">
    <div class="row justify-content-center" style="padding-top: 7%;padding-bottom: 7%">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Histori Pendaftaran</h4>
                </div>
                <div class="card-body overflow-auto">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle" id="anggotaTable">
                            <thead class="table-primary">

                                <th>No</th>
                                <th>Nama</th>
                                <th>Organisasi Tujuan</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 0)
                                @forelse ($riwayat as $item)
                                <tr>
                                    @php($count++)
                                    <td>{{ $count }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $item->organisasi_tujuan }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Tidak ada data riwayat.</td>
                                </tr>
                                @endforelse
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    @if (session('swal_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Sukses!',
                text: '{{ session('swal_success') }}',
                confirmButtonColor: '#3085d6',
            });
        });
    </script>
@endif

    
@endsection
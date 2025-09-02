@extends('admin.layoutadmin.main')

@section('konten')
  <div class="container-arsip d-flex active">

<div class="container"  style="padding-top:7%">

    
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Jadwal Semua Kegiatan Unit Organisasi Mahasiswa (UKM)</h5>
                        <a href="{{ route('rutin.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </a>
                    </div>
                    <div class="card-body">
                         <table class="table table-hover table-bordered align-middle fl-table" id="anggotaTable">
                    <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Unit Ormawa</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rutin as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->hari }}</td>
                                        <td>{{ $p->unit }}</td>
                                        <td>{{ $p->tempat_kegiatan }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ url('admin/rutin/update/' . $p->id . '/view') }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('admin/rutin/destroy/' . $p->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus kegiatan?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- DataTables script --}}
    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#tabel-rutin').DataTable();
            });
        </script>
    @endpush

    {{-- DataTables styles --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    @endpush
@endsection

@extends('admin.layoutadmin.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">

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
            <div class="card shadow mb-4">
                <!-- Card Header with optional button -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Calon Anggota</h5>

                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">

                    
                    <table class="table table-hover table-bordered align-middle" id="anggotaTable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Whatsapp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php($count = 0)
                            @foreach ($anggota as $p)
                            @if ($p->status === 'calon')
                            @php($count++)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->nomor }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Edit button -->
                                        <form action="{{ url('admin/kegiatan/panitia/' . $p->user_id . '/view') }}"
                                            method="GET" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Edit">
                                                <span class="material-symbols-outlined align-middle">edit</span>
                                            </button>
                                        </form>

                                        <!-- Delete button -->
                                        <form action="{{ url('admin/kegiatan/panitia/' . $p->user_id . '/destroy') }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota?')"
                                            class="m-0">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <span class="material-symbols-outlined align-middle">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>
</div>
@endsection

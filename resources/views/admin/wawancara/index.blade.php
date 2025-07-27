@extends('admin.layoutadmin.main')

@section('konten')
<div class="container-arsip d-flex active">

    <div class="container"  style="padding-top:7%">

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-start align-items-center">
                        <h5 class="mb-0">Daftar Calon Anggota Lolos Ke Wawancara</h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-hover table-bordered align-middle fl-table" id="anggotaTable">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php($count = 0)
                                @foreach ($anggota as $p)
                                @if ($p->status === 'Lolos ke Wawancara')
                                @php($count++)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Edit button -->
                                            <form action="{{ url('kegiatan/panitia/' . $p->user_id . '/wawancara') }}"
                                                method="GET" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning" title="Edit">
                                                    <span class="material-symbols-outlined align-middle">edit</span>
                                                </button>
                                            </form>

                                            <!-- Delete button -->
                                            <form action="{{ url('kegiatan/panitia/' . $p->user_id . '/destroy') }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus anggota?')" class="m-0">
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
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</div>
@endsection

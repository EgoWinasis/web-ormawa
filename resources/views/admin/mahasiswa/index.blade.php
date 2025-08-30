@extends('superadmin.layoutsuper.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">


    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Mahasiswa</h5>
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Tambah
                    </a>
                </div>


                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle " id="anggotaTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Prodi</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>Jalur</th>
                                    <th>Semester</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 0)
                                @foreach ($mahasiswas as $index => $m)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $m->prodi }}</td>
                                    <td>{{ $m->nim }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ $m->jk }}</td>
                                    <td>{{ $m->jalur }}</td>
                                    <td>{{ $m->semester }}</td>
                                    <td>{{ $m->kelas }}</td>
                                    <td>
                                        <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
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
@endsection

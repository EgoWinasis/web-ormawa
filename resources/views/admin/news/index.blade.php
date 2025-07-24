@extends('admin.layoutadmin.main')

@section('konten')
<div class="container-arsip d-flex active">

<div class="container" style="padding-top: 70px">
    <h2 class="text-center">Berita Acara</h2>

    <div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center">
                <h5>Data</h5>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <table class="table table-hover table-bordered align-middle fl-table" id="anggotaTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Nama Kegiatan</th>
                            <th>Tempat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count = 0)
                        @foreach ($kegiatan as $k)
                            @isset($k->lpj)
                                @php($count++)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $k->tanggal_mulai }}</td>
                                    <td class="img">
                                        <img src="{{ asset('storage/' . $k->gambar) }}" alt="Gambar" width="60" height="60" style="object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>{{ $k->nama_kegiatan }}</td>
                                    <td>{{ $k->tempat_kegiatan }}</td>
                                    <td>
                                        <form action="{{ url('news/destroy/' . $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus news?')" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endisset
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

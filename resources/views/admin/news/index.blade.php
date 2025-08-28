@extends('admin.layoutadmin.main')

@section('konten')
<div class="container-arsip d-flex active">

<div class="container"  style="padding-top:7%">

    <div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center">
                <h5>Data Berita Acara</h5>
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
                                  <td class="text-center">
    <div class="d-inline-flex align-items-center gap-2">
        <!-- View Icon -->
        <a href="{{ asset('storage/' . $k->gambar) }}" target="_blank" title="Lihat Gambar">
            <i class="fas fa-eye fa-lg text-primary" style="cursor: pointer;"></i>
        </a>

        <!-- Download Icon -->
        <a href="{{ asset('storage/' . $k->gambar) }}" download title="Unduh Gambar">
            <i class="fas fa-download fa-lg text-success" style="cursor: pointer;"></i>
        </a>
    </div>
</td>


                                    
                                    <td>{{ $k->nama_kegiatan }}</td>
                                    <td>{{ $k->tempat_kegiatan }}</td>
                                    <td>
                                        <form action="{{ url('admin/news/destroy/' . $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus news?')" style="display: inline;">
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

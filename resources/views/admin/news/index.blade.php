@extends('admin.layoutadmin.main')

@section('konten')
    <div class="container-kegiatan d-flex active">
        <h2>BERITA ACARA</h2>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
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
                            <tr>
                                @php($count++)
                                <td>{{ $count }}</td>
                                <td>{{ $k->tanggal_mulai }}</td>
                                <td class="img"><img src="{{ asset('storage/' . $k->gambar) }}" alt="" width="60px"
                                        height="60px"></td>
                                <td>{{ $k->nama_kegiatan }}</td>
                                <td>{{ $k->tempat_kegiatan }}</td>
                                <td style="display: none">{{ $k->tempat_kegiatan }}</td>
                                <td>
                                    <form action="news/destroy/{{ $k->id }}" method="post">
                                        @csrf
                                        <button onclick="return confirm('yakin ingin menghapus news?')"><span
                                                class="material-symbols-outlined">delete</span></button>
                                    </form></span>
                                </td>
                            </tr>
                        @endisset
                    @endforeach


                <tbody>
            </table>
        </div>
    </div>
@endsection

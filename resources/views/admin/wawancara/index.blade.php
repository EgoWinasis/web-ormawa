@extends('admin.layoutadmin.main')
@section('konten')
    <div class="container-wawancara d-flex active">
        <h2>Daftar calon Anggota Lolos Ke Wawancara</h2>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @php($count = 0)
                    @foreach ($anggota as $p)
                        @if ($p->status == 'Lolos ke Wawancara')
                            <tr>
                                @php($count++)
                                <td>{{ $count }}</td>
                                <td>{{ $p->name }}</td>

                                <td style="display: flex; justify-content:center; gap:1rem">
                                    <form action="kegiatan/panitia/{{ $p->id }}/wawancara" method="get"> @csrf
                                        <button><span class="material-symbols-outlined">edit</span>
                                        </button>
                                    </form>
                                    <form action="kegiatan/panitia/{{ $p->id }}/destroy" method="post">
                                        @csrf @method('delete')
                                        <button onclick="return confirm('yakin ingin menghapus anggota?')"><span
                                                class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach


                <tbody>
            </table>
        </div>
    </div>
@endsection

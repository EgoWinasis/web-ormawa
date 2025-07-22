@extends('admin.layoutadmin.main')

@section('konten')
    <div class="container-rutinitas d-flex active">
        <h2>JADWAL SEMUA KEGIATAN UNIT ORGANISASI MAHASISWA UKM</h2>
        {{-- <div data-name="rutin" class="addButton"><span class="material-symbols-outlined">add</span>Tambah
    </div> --}}
        <div>
            <a href="{{ route('rutin.create') }}" id="tambahtambahan">
                <span style="margin-right: 8px; font-size: 1.2rem;">+</span>Tambah
            </a>
        </div>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Unit Ormawa</th>
                        <th>Tempat</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @php($count = 0)
                    @foreach ($rutin as $p)
                        <tr>
                            @php($count++)
                            <td>{{ $count }}</td>
                            <td>{{ $p->hari }}</td>
                            <td>{{ $p->unit }}</td>
                            <td>{{ $p->tempat_kegiatan }}</td>
                            <td style="display: flex; justify-content:center; gap:1rem">
                                <form action="rutin/update/{{ $p->id }}/view" method="get"> @csrf
                                    <button><span class="material-symbols-outlined">edit</span>
                                    </button>
                                </form>
                                <form action="rutin/destroy/{{ $p->id }}" method="post"> @csrf
                                    @method('delete')
                                    <button onclick="return confirm('yakin ingin menghapus kegiatan?')"><span
                                            class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                <tbody>
            </table>
        </div>
    </div>
@endsection

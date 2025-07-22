@extends('admin.layoutadmin.main')

@section('konten')
    <div class="container-arsip d-flex active">
        <h2>ARSIP KEGIATAN</h2>
        <div>
            <a href="{{ route('arsip.create') }}" id="tambahtambahan">
                <span style="margin-right: 8px; font-size: 1.2rem;">+</span>Tambah
            </a>
        </div>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tempat</th>
                    <th>Gambar</th>
                    <th>Proposal</th>
                    <th>LPJ</th>
                    <th>Panitia</th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 0)

                    @foreach ($kegiatan as $k)
                        <tr>
                            @php($count++)
                            <td>{{ $count }}</th>
                            <td>{{ $k->nama_kegiatan }}</td>
                            <td>{{ $k->tempat_kegiatan }}</td>
                            <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->gambar) }}"
                                    title="{{ $k->slug }}">
                                    <img src="{{ asset('storage/' . $k->gambar) }}" alt="Logo" width='60px'
                                        height="60px" style="object-fit: cover">
                                </a></td>
                            <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->proposal) }}"
                                    title="{{ $k->slug }}">Download Proposal</a></td>
                            @if ($k->lpj)
                                <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->lpj) }}"
                                        title="{{ $k->slug }}">Download LPJ</a></td>
                            @else
                                <td>Belum ada</td>
                            @endif
                            @if (!count($k->users) == '0')
                                <td><a href="/admin/kegiatan/{{ $k->id }}"
                                        style="color:blue">{{ count($k->users) }}</a></td>
                            @else
                                <td><a href="/admin/kegiatan/{{ $k->id }}" style="color:blue"> Belum Ada
                                        Panitia</a></td>
                            @endif
                            <td style="display: none"><a href="/admin/kegiatan/{{ $k->id }}"
                                    style="color:blue">Lihat
                                    Panitia</a></td>
                        </tr>
                    @endforeach


                <tbody>
            </table>
        </div>
    </div>
@endsection

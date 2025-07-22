@extends('superadmin.layoutsuper.main')
@section('konten')


    <div class="container-arsip d-flex active">
        <h2>ARSIP SEMUA UNIT ORMAWA</h2>
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
                            <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->gambar) }}}"
                                    title="{{ $k->slug }}"><img class="img" src="{{ asset('storage/' . $k->gambar) }}"
                                        alt="" width="60px"></a>
                            </td>
                            <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->proposal) }}"
                                    title="{{ $k->slug }}">{{ Str::limit($k->proposal, 20) }}</a></td>
                            @if ($k->lpj)
                                <td><a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->lpj) }}"
                                        title="{{ $k->slug }}">{{ Str::limit($k->lpj, 20) }}</a></td>
                            @else
                                <td>Belum ada</td>
                            @endif

                            <td class="kegiatan">
                                @if (count($k->users) != 0)
                                    <span style="display: flex; justify-content: center">
                                        <button style="width: 3rem;"
                                            onclick="toggleFlyout(event)">{{ count($k->users) }}</button>
                                        <div class="flyout" style="display: none;">
                                            {{-- Ganti konten berikut dengan apa yang ingin Anda tampilkan dalam flyout --}}
                                            @foreach ($k->users as $a)
                                                <li>{{ $a->name }}</li>
                                            @endforeach
                                        </div>
                                    </span>
                                @else
                                    Belum Ada Panitia
                                @endif
                            </td>

                            <td style="display: none"><a href="/kegiatan/{{ $k->id }}" style="color:blue">Lihat
                                    Panitia</a></td>
                        </tr>
                    @endforeach
                <tbody>
            </table>
        </div>
    </div>
@endsection

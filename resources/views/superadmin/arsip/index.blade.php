@extends('superadmin.layoutsuper.main')
@section('konten')


<div class="container-arsip d-flex active">

    <div class="container" style="padding-top: 70px">
        <h2 class="text-center">ARSIP SEMUA UNIT ORMAWA</h2>

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
        @php($count++)
        <tr>
            <td>{{ $count }}</td>
            <td>{{ $k->nama_kegiatan }}</td>
            <td>{{ $k->tempat_kegiatan }}</td>

            {{-- Gambar tetap pakai <img> --}}
            <td>
                <a download="{{ $k->slug }}" href="{{ asset('storage/' . $k->gambar) }}" title="Unduh Gambar">
                    <img class="img" src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->nama_kegiatan }}" width="60px">
                </a>
            </td>

            {{-- Proposal pakai icon saja --}}
            <td>
                <a download href="{{ asset('storage/' . $k->proposal) }}" title="Unduh Proposal">
                    <i class="fa-2x fa-solid fa-file-arrow-down"></i>
                </a>
            </td>

            {{-- LPJ pakai icon jika ada --}}
            <td>
                @if ($k->lpj)
                    <a download href="{{ asset('storage/' . $k->lpj) }}" title="Unduh LPJ">
                        <i class="fa-2x fa-solid fa-file-arrow-down"></i>
                    </a>
                @else
                    <i class="fa-2x fa-solid fa-circle-exclamation text-muted" title="Belum Ada LPJ"></i>
                @endif
            </td>

            {{-- Panitia tetap --}}
            <td class="kegiatan">
                @if (count($k->users) != 0)
                    <span style="display: flex; justify-content: center; align-items: center; gap: 0.3rem;">
                        <button class="btn btn-sm btn-outline-primary" onclick="toggleFlyout(event)">
                            {{ count($k->users) }}
                        </button>
                        <div class="flyout" style="display: none;">
                            <ul style="margin: 0; padding-left: 1rem;">
                                @foreach ($k->users as $a)
                                    <li>{{ $a->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </span>
                @else
                    Belum Ada Panitia
                @endif
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

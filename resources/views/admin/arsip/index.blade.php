@extends('admin.layoutadmin.main')

@section('konten')
<div class="container-arsip d-flex active">
    <div class="container " style="padding-top: 70px">
        <h2 class="text-center">ARSIP KEGIATAN</h2>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-end align-items-center ">
                        <a href="{{ route('arsip.create') }}" id="tambahtambahan"
                            class="btn btn-success btn-sm text-white">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </a>
                    </div>
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
                                    <td>
                                        <a href="{{ asset('storage/' . $k->gambar) }}" download="{{ $k->slug }}"
                                            title="Unduh Gambar">
                                            <img src="{{ asset('storage/' . $k->gambar) }}" alt="Gambar" width="60"
                                                height="60" style="object-fit: cover; border-radius: 5px;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $k->proposal) }}" download="{{ $k->slug }}"
                                            class="btn btn-sm btn-outline-primary" title="Download Proposal">
                                            <i class="fas fa-file-download"></i> Proposal
                                        </a>
                                    </td>
                                    <td>
                                        @if ($k->lpj)
                                        <a href="{{ asset('storage/' . $k->lpj) }}" download="{{ $k->slug }}"
                                            class="btn btn-sm btn-outline-success" title="Download LPJ">
                                            <i class="fas fa-file-download"></i> LPJ
                                        </a>
                                        @else
                                        <span class="text-muted">Belum ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/kegiatan/{{ $k->id }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-users"></i>
                                            @if (count($k->users) > 0)
                                            {{ count($k->users) }}
                                            @else
                                            Belum Ada Panitia
                                            @endif
                                        </a>
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
    @endsection

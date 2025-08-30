@extends('superadmin.layoutsuper.main')
@section('konten')


<div class="container-arsip d-flex active">

    <div class="container" style="padding-top:7%">
        <h2 class="text-center"></h2>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-start align-items-center">
                        <h5>ARSIP SEMUA UNIT ORMAWA</h5>
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
            <th>Keterangan</th> <!-- Tambahan -->
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

                <!-- Gambar -->
                <td class="text-center">
                    @if ($k->gambar)
                        <div class="d-inline-flex align-items-center gap-2">
                            <a href="{{ asset('storage/' . $k->gambar) }}" target="_blank" title="Lihat Gambar">
                                <i class="fas fa-eye fa-lg text-primary"></i>
                            </a>
                            <a href="{{ asset('storage/' . $k->gambar) }}" download title="Download Gambar">
                                <i class="fas fa-download fa-lg text-success"></i>
                            </a>
                        </div>
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                <!-- Proposal -->
                <td class="text-center">
                    @if ($k->proposal)
                        <div class="d-inline-flex align-items-center gap-2">
                            <a href="{{ asset('storage/' . $k->proposal) }}" target="_blank" title="Lihat Proposal">
                                <i class="fas fa-eye fa-lg text-primary"></i>
                            </a>
                            <a href="{{ asset('storage/' . $k->proposal) }}" download="{{ $k->slug ?? 'proposal' }}" title="Download Proposal">
                                <i class="fas fa-download fa-lg text-success"></i>
                            </a>
                        </div>
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                <!-- LPJ -->
                <td class="text-center">
                    @if ($k->lpj)
                        <div class="d-inline-flex align-items-center gap-2">
                            <a href="{{ asset('storage/' . $k->lpj) }}" target="_blank" title="Lihat LPJ">
                                <i class="fas fa-eye fa-lg text-primary"></i>
                            </a>
                            <a href="{{ asset('storage/' . $k->lpj) }}" download="{{ $k->slug ?? 'lpj' }}" title="Download LPJ">
                                <i class="fas fa-download fa-lg text-success"></i>
                            </a>
                        </div>
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                <!-- Keterangan -->
                <td class="text-center">
                    @php
                        $hasProposal = !empty($k->proposal);
                        $hasLPJ = !empty($k->lpj);
                    @endphp

                    @if ($hasProposal && $hasLPJ)
                        <span class="badge bg-success">Lengkap</span>
                    @elseif ($hasProposal || $hasLPJ)
                        <span class="badge bg-warning text-dark">Belum Lengkap</span>
                    @else
                        <span class="badge bg-secondary">Belum Ada File</span>
                    @endif
                </td>

                <!-- Panitia -->
                <td class="text-center">
                    @if ($k->users && count($k->users) > 0)
                        <button class="btn btn-sm btn-primary show-agendas-btn" data-anggota='@json($k->users)'>
                            {{ count($k->users) }}
                        </button>
                    @else
                        <span class="text-muted">Belum Ada Panitia</span>
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

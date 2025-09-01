@extends('superadmin.layoutsuper.main')
@section('konten')
<div class="container py-4" style="margin-top: 2rem">

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h5 class="text-center">OTORISASI ARSIP KEGIATAN</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle " id="anggotaTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tempat</th>
                                    <th>Proposal</th>
                                    <th>LPJ</th>
                                    <th>Aksi</th>
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

                                    <!-- Proposal -->
                                    <td class="text-center">
                                        @if ($k->proposal)
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <a href="{{ asset('storage/' . $k->proposal) }}" target="_blank"
                                                title="Lihat Proposal">
                                                <i class="fas fa-eye fa-lg text-primary"></i>
                                            </a>
                                            <a href="{{ asset('storage/' . $k->proposal) }}"
                                                download="{{ $k->slug ?? 'proposal' }}" title="Download Proposal">
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
                                            <a href="{{ asset('storage/' . $k->lpj) }}" target="_blank"
                                                title="Lihat LPJ">
                                                <i class="fas fa-eye fa-lg text-primary"></i>
                                            </a>
                                            <a href="{{ asset('storage/' . $k->lpj) }}"
                                                download="{{ $k->slug ?? 'lpj' }}" title="Download LPJ">
                                                <i class="fas fa-download fa-lg text-success"></i>
                                            </a>
                                        </div>
                                        @else
                                        <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>


                                    <!-- Aksi -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Ubah Status Proposal --}}
                                            @if ($k->proposal)
                                            <a href="javascript:void(0);" onclick="ubahStatus('proposal', {{ $k->id }})"
                                                title="Ubah Status Proposal">
                                                <i class="fas fa-edit text-warning"></i>
                                            </a>
                                            @endif

                                            {{-- Ubah Status LPJ --}}
                                            @if ($k->lpj)
                                            <a href="javascript:void(0);" onclick="ubahStatus('lpj', {{ $k->id }})"
                                                title="Ubah Status LPJ">
                                                <i class="fas fa-file-alt text-info"></i>
                                            </a>
                                            @endif
                                        </div>
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

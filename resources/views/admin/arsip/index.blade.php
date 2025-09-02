@extends('admin.layoutadmin.main')

@section('konten')

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif


<div class="container py-4" style="margin-top: 2rem">

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h5 class="text-center">ARSIP KEGIATAN</h5>

                    <a href="{{ route('arsip.create') }}" id="tambahtambahan" class="btn btn-success btn-sm text-white">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                    <table class="table table-hover table-bordered align-middle " id="anggotaTable">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Tempat</th>
                                <th>Gambar</th>
                                <th>Proposal</th>
                                <th>LPJ</th>
                                <th>Keterangan</th>
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
                                        <a href="{{ asset('storage/' . $k->gambar) }}" target="_blank"
                                            title="Lihat Gambar">
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
                                        <a href="{{ asset('storage/' . $k->proposal) }}" target="_blank"
                                            title="Lihat Proposal">
                                            <i class="fas fa-eye fa-lg text-primary"></i>
                                        </a>
                                        <a href="{{ asset('storage/' . $k->proposal) }}"
                                            download="{{ $k->slug ?? 'proposal' }}" title="Download Proposal">
                                            <i class="fas fa-download fa-lg text-success"></i>
                                        </a>

                                        {{-- status propsal --}}
                                       <a href="javascript:void(0);"
   onclick="showStatusInfo({{ $k->status_proposal }}, '{{ e($k->ket_proposal ?? 'Tidak ada keterangan') }}')"
   class="text-info"
   title="Info Status Proposal">
   <i class="fas fa-info-circle fa-lg 
       @if($k->status_proposal == 0) text-info
       @elseif($k->status_proposal == 1) text-success
       @elseif($k->status_proposal == 2) text-danger
       @else text-secondary
       @endif"></i>
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
                                        <a href="{{ asset('storage/' . $k->lpj) }}" download="{{ $k->slug ?? 'lpj' }}"
                                            title="Download LPJ">
                                            <i class="fas fa-download fa-lg text-success"></i>
                                        </a>
                                         {{-- Tombol Info Status --}}
                                            <a href="javascript:void(0);"
   onclick="showStatusInfo({{ $k->status_lpj }}, '{{ e($k->ket_lpj ?? 'Tidak ada keterangan') }}')"
   class="text-info"
   title="Info Status LPJ">
   <i class="fas fa-info-circle fa-lg 
       @if($k->status_lpj == 0) text-info
       @elseif($k->status_lpj == 1) text-success
       @elseif($k->status_lpj == 2) text-danger
       @else text-secondary
       @endif"></i>
</a>


                                    </div>
                                    @else
                                    <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>

                                <!-- Keterangan -->
                                <td class="text-center">


                                    @if (!empty($k->proposal) && !empty($k->lpj))
                                    <span class="badge bg-success">Lengkap</span>
                                    @elseif (!empty($k->proposal) || !empty($k->lpj))
                                    <span class="badge bg-warning text-dark">Belum Lengkap</span>
                                    @else
                                    <span class="badge bg-secondary">Belum Ada File</span>
                                    @endif
                                </td>

                                <!-- Panitia -->
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
</div>

@endsection

@extends('superadmin.layoutsuper.main')
@section('konten')


<div class="container-arsip d-flex active">

    <div class="container"  style="padding-top:7%">
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

          
            <!-- Kolom Gambar -->
<!-- Kolom Gambar -->
<td class="text-center">
    <div class="d-inline-flex align-items-center gap-4">
        <!-- Lihat Gambar -->
        <a href="{{ asset('storage/' . $k->gambar) }}" target="_blank" title="Lihat Gambar">
            <i class="fas fa-eye fa-lg text-primary" style="cursor: pointer;"></i>
        </a>

        <!-- Download Gambar -->
        <a href="{{ asset('storage/' . $k->gambar) }}" download title="Download Gambar">
            <i class="fas fa-download fa-lg text-success" style="cursor: pointer;"></i>
        </a>
    </div>
</td>

<!-- Kolom Proposal -->
<td class="text-center">
    <div class="d-inline-flex align-items-center gap-4">
        <!-- Lihat Proposal -->
        <a href="{{ asset('storage/' . $k->proposal) }}" target="_blank" title="Lihat Proposal">
            <i class="fas fa-eye fa-lg text-primary" style="cursor: pointer;"></i>
        </a>

        <!-- Download Proposal -->
        <a href="{{ asset('storage/' . $k->proposal) }}" download="{{ $k->slug }}" title="Download Proposal">
            <i class="fas fa-download fa-lg text-success" style="cursor: pointer;"></i>
        </a>
    </div>
</td>

<!-- Kolom LPJ -->
<td class="text-center">
    @if ($k->lpj)
        <div class="d-inline-flex align-items-center gap-4">
            <!-- Lihat LPJ -->
            <a href="{{ asset('storage/' . $k->lpj) }}" target="_blank" title="Lihat LPJ">
                <i class="fas fa-eye fa-lg text-primary" style="cursor: pointer;"></i>
            </a>

            <!-- Download LPJ -->
            <a href="{{ asset('storage/' . $k->lpj) }}" download="{{ $k->slug }}" title="Download LPJ">
                <i class="fas fa-download fa-lg text-success" style="cursor: pointer;"></i>
            </a>
        </div>
    @else
        <span class="text-muted">Belum ada</span>
    @endif
</td>

            
            <td class="kegiatan">
                @if (count($k->users) != 0)
                    <span style="display: flex; justify-content: center; align-items: center; gap: 0.3rem;">
                       
                         <button class="btn btn-sm btn-primary show-agendas-btn" data-anggota='@json($k->users)'>
                                                    {{ count($k->users) }}
                                                </button>
                       
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

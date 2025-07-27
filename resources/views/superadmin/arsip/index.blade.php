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

          
            <td class="text-center">
                <a href="{{ asset('storage/' . $k->gambar) }}" target="_blank" title="Lihat Gambar">
                    <i class="fas fa-eye fa-lg text-primary" style="cursor: pointer;"></i>
                </a>
            </td>

          
            <td>

                
                @if ($k->proposal)
                    <a download href="{{ asset('storage/' . $k->proposal) }}" title="Unduh Proposal"
                         class="btn btn-sm btn-outline-primary" title="Download Proposal">
                                            <i class="fas fa-file-download"></i> Proposal
                    </a>
                @else
                    <i class="fa-2x fa-solid fa-circle-exclamation text-muted" title="Belum Ada LPJ"></i>
                @endif
            </td>

            <td>
                @if ($k->lpj)
                    <a download href="{{ asset('storage/' . $k->lpj) }}" title="Unduh LPJ"
                         class="btn btn-sm btn-outline-success" title="Download LPJ">
                                            <i class="fas fa-file-download"></i> LPJ
                    </a>
                @else
                    <i class="fa-2x fa-solid fa-circle-exclamation text-muted" title="Belum Ada LPJ"></i>
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

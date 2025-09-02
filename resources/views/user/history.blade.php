@extends('user.layout.main')

@section('js')
    @if (session()->has('succes'))
    <script>
        alert('Berhasil Mendaftar');
    </script>
@endif
@endsection
@section('konten')
<div class="container py-4" style="margin-top: 2rem;">
    <div class="row justify-content-center" style="padding-top: 7%; padding-bottom: 7%;">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Pengumuman Pendaftaran</h4>
                </div>
                <div class="card-body overflow-auto">
                    <div id="history">
                        @if ($user->status == 'calon')
                            <div class="alert alert-info text-center">
                                <h5 class="mb-0">Sedang Diproses Tahap Administrasi...</h5>
                            </div>

                        @elseif ($user->status == 'Lolos ke Wawancara')
                            <div class="alert alert-success text-center">
                                <h5 class="text-decoration-underline">{{ $user->keterangan }}</h5>
                                <h5 class="fw-bold">Selamat {{ $user->name }}, Anda Lolos Tahap Administrasi!</h5>
                            </div>

                            <div class="mt-4">
                                <h6 class="fw-bold">Detail Wawancara:</h6>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Tempat:</strong> {{ $user->tempat_wawancara }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Hari, Tanggal:</strong>
                                        {{ \Carbon\Carbon::parse($user->tgl_wawancara)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Jam:</strong> {{ $user->jam_wawancara }}
                                    </li>
                                </ul>
                            </div>

                     @elseif($user->status == 'aktif')
    <div class="alert alert-success text-center">
        <h5 class="text-decoration-underline">{{ $user->keterangan }}</h5>
        <h5 class="fw-bold">Selamat {{ $user->name }}, Anda Lolos Tahap Wawancara!</h5>
        <h6>Anda sekarang adalah <strong>{{ $user->jabatan }} {{ $user->nama_organisasi }}</strong>.</h6>

        {{-- Total Nilai --}}
        <p class="mt-3">
            <strong>Total Nilai Wawancara:</strong>
            <span class="badge bg-primary">{{ $total_nilai }} / 100</span>
        </p>
    </div>


                        @elseif($user->status == 'gagal tahap administrasi' || $user->status == 'gagal tahap wawancara')
    <div class="alert alert-danger text-center">
        <h5 class="text-decoration-underline">{{ $user->keterangan }}</h5>
        <h5>Mohon Maaf {{ $user->name }}, Anda belum lolos menjadi anggota {{ $user->nama_organisasi }}.</h5>
        <p>Status: <strong>{{ $user->status }}</strong></p>

        {{-- Total Nilai --}}
        <p class="mt-3">
            <strong>Total Nilai Wawancara:</strong>
            <span class="badge bg-secondary">{{ $total_nilai ?? 0 }} / 100</span>
        </p>
    </div>


                        @else
                            <div class="alert alert-warning text-center">
                                <h5>Silakan lengkapi berkas terlebih dahulu.</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

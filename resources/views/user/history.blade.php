@extends('user.layout.main')


@section('konten')
<div class="container py-4" style="margin-top: 2rem">
    <div class="row justify-content-center" style="padding-top: 7%;padding-bottom: 7%">
        <div class="col-md-8">
            <div class="card shadow" >
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Pengumuman Pendaftaran</h4>
                </div>
                <div class="card-body overflow-auto">
                    <div id="history" class="container-history d-flex active">
                @if ($user->status == 'calon')
                    <h1>Sedang DiProses Tahap Administrasi..<h1>
                        @elseif ($user->status == 'Lolos ke Wawancara')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Selamat {{ $user->name }} Anda Lolos Tahap Administrasi</h3>

                            <h4 style="margin-bottom: 10px;">Selanjutnya anda akan dijadwalkan wawancara berikut
                                detailnya:</h4>
                            <h4><span>Tempat</span> <span
                                    style="display: inline-block; width: 10px; text-align: center;">:</span>
                                <span>{{ $user->tempat_wawancara }}</span>
                            </h4>
                            <h4><span>Hari, Tanggal</span> <span
                                    style="display: inline-block; width: 10px; text-align: center;">:</span>
                                <span>{{ \Carbon\Carbon::parse($user->tgl_wawancara)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                            </h4>
                            <h4><span>Jam</span> <span
                                    style="display: inline-block; width: 10px; text-align: center;">:</span>
                                <span>{{ $user->jam_wawancara }}</span>
                            </h4>
                        @elseif($user->status == 'aktif')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Selamat {{ $user->name }} Anda Lolos Tahap Wawancara </h3>
                            <h3>Sekarang anda Adalah {{ $user->jabatan }} {{ $user->nama_organisasi }}</h3>
                        @elseif($user->status == 'gagal tahap administrasi')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Mohon Maaf {{ $user->name }} kamu belum lolos menjadi anggota
                                {{ $user->nama_organisasi }} </h3>
                            <h3>kamu {{ $user->status }}</h3>
                        @elseif($user->status == 'gagal tahap wawancara')
                            <h1 style="text-decoration:underline">{{ $user->keterangan }}</h1>
                            <h3>Mohon Maaf {{ $user->name }} kamu belum lolos menjadi anggota
                                {{ $user->nama_organisasi }} </h3>
                            <h3>kamu {{ $user->status }}</h3>
                        @else
                            <h1>Silahkan Lengkapi Berkas...</h1>
                @endif

            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

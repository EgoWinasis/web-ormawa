@extends('admin.layoutadmin.main')

@section('konten')
<div class="container py-4" style="margin-top: 2rem">

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header d-flex justify-content-start align-items-center">
                    <h5 class="mb-0">Daftar Calon Anggota Lolos Ke Wawancara</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <h4>Form Penilaian Wawancara</h4>
    <form action="{{ url('admin/kegiatan/panitia/' . $user_id . '/penilaian') }}" method="POST">
        @csrf

        @php
            $pertanyaan = [
                "Apa motivasi kamu mendaftar di organisasi ini?",
                "Bagaimana kamu mengenal organisasi ini?",
                "Apa yang kamu harapkan setelah bergabung?",
                "Kesibukan apa saja yang sedang kamu jalani saat ini (kuliah, kerja, organisasi lain)?",
                "Bagaimana cara kamu mengatur waktu antara akademik dan organisasi?",
                "Ceritakan pengalamanmu bekerja dalam tim.",
                "Bagaimana cara kamu menghadapi konflik dengan anggota tim?",
                "Apa nilai atau prinsip hidup yang paling kamu pegang?",
                "Jika diberi tanggung jawab sebagai ketua divisi, apa langkah pertama yang akan kamu lakukan?",
                "Jika mendapat tugas mendadak, apa strategi kamu agar tetap bisa menyelesaikannya tepat waktu?"
            ];
        @endphp

        @foreach($pertanyaan as $index => $tanya)
        <div class="mb-3">
            <label class="form-label">{{ ($index + 1) . '. ' . $tanya }}</label>
            <textarea name="jawaban[{{ $index }}]" rows="3" class="form-control" required></textarea>
        </div>
        @endforeach

        <button type="submit" class="btn btn-success">Simpan Penilaian</button>
    </form>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>
</div>
@endsection

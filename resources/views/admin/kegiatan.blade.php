<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="../../css/root.css">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="../../css/admin.css">



    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>ADMIN</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div class="container-kegiatan-edit">

        {{-- update --}}
        <form method="post" enctype="multipart/form-data" action="/admin/kegiatan/{{ $kegiatan->id }}/edit">
            @csrf
            <div class="container-input">
                <div class="form-box">
                    <div class="input-box">
                        <label for="kegiatan-input">Nama Kegiatan: </label>
                        <input type="text" id="kegiatan-input" value="{{ $kegiatan->nama_kegiatan }}"
                            name="nama_kegiatan">
                        @error('nama_kegiatan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="date-end-input">Tanggal mulai: </label>
                        <input type="date" id="date-end-input" value="{{ $kegiatan->tanggal_mulai }}"
                            name="tanggal_mulai">
                        @error('tanggal_mulai')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label for="tempat_kegiatan">Tempat Kegiatan: </label>
                        <input type="text" id="tempat_kegiatan" value="{{ $kegiatan->tempat_kegiatan }}"
                            name="tempat_kegiatan">
                        @error('tempat_kegiatan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label for="keterangan">Keterangan: </label>
                        <input type="text" id="keterangan" value="{{ $kegiatan->keterangan }}" name="keterangan">
                        @error('keterangan')
                            <p class="ket error">*wajib di isi</p>
                        @enderror
                    </div>
                </div>
                <div class="form-box">
                    <div class="input-box">
                        <label for="img-input">Gambar: </label>
                        <input type="file" id="img-input" accept="image/*"value="{{ $kegiatan->gambar }}"
                            name="gambar">
                        <p
                            class="ket 
                            @error('gambar')  
                                error
                            @enderror ">
                            *JPG atau PNG. Max: 2MB</p>
                    </div>
                    <div class="input-box">
                        <label for="proposal">Proposal: </label>
                        <input type="file" id="proposal"
                            accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                            value="{{ $kegiatan->proposal }}" name="proposal">
                        <p
                            class="ket 
                            @error('proposal')  
                                error
                            @enderror ">
                            *Hanya File PDF</p>
                    </div>
                    <div class="input-box">
                        <label for="lpj">Laporan: </label>
                        <input type="file" id="lpj"
                            accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"
                            value="" name="lpj">
                        <p
                            class="ket 
                            @error('proposal')  
                                error
                            @enderror ">
                            *Hanya File PDF
                        </p>
                    </div>

                </div>
            </div>
            <div class="container-table">
                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php($count = 0)
                            @foreach ($panitia as $p)
                                @if ($p->status == 'aktif')
                                    <tr>
                                        @php($count++)
                                        <td>{{ $count }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->jabatan }}</td>
                                        <td style="height:2.5rem">
                                            <input input type="checkbox" name="panitia[]" value="{{ $p->id }}"
                                                {{ $kegiatan->users->contains($p->id) ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach


                        <tbody>
                    </table>
                </div>
                <input class="submitButton" type="submit" value="Simpan">
                <div style="text-align: center; margin-top: 0px;">
                    <a href="/admin/arsip" style="color: white; background-color: rgb(0, 173, 221); padding: 0px 196px; text-decoration: none; border-radius: 5px;">Kembali</a>
                </div>
            </div>
        </form>



    </div>

    {{-- <script>
     $(document).ready(function() {  
            $('#simpan').on('click', function(event) {  
                event.preventDefault();
                let anggota_id = [];

                $('.anggota_id').each(function() {
                    anggota_id.push($(this).val())
                })
                $.ajax({  
                    url: '{{$kegiatan->id}}/edit',  
                    type: 'post',  
                    data: { anggota_id: anggota_id,  },
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(response) {  
                        $('#response').html(response.message);  
                    },  
                    error: function(xhr) {  
                        $('#response').html('Error: ' + xhr.statusText);  
                    }  
                });  
            });  
        });  
   </script> --}}
    <script src="../../js/admin.js"></script>
</body>

</html>

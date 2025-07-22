<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link ke css root -->
    <link rel="stylesheet" href="{{ asset('css/root.css') }}">

    <!-- link ke css landing -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


    <!-- google icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>ADMIN BEM</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div style="margin-top: 5rem;" class="form-container">
        {{-- update --}}
        <form method="POST" enctype="multipart/form-data" action="{{ route('rutin.update', $rutin->id) }}">
            @csrf
            @method('POST')
            <div class="form-box">

                <div class="input-box">
                    <label for="hari">Hari: </label>
                    <input type="text" id="hari" name="hari" value="{{ $rutin->hari }}">
                    <p class="ket @error('hari') error @enderror">
                        *Tuli hari dengan format: senin-sabtu
                    </p>
                    @error('hari')
                        <p class="error-message">*Field ini wajib diisi dengan format yang benar</p>
                    @enderror
                </div>

                <div class="input-box">
                    <label for="tempat-input">Tempat Rutinitas: </label>
                    <input type="text" id="tempat-input" name="tempat_kegiatan"
                        value="{{ $rutin->tempat_kegiatan }}">
                    @error('tempat_kegiatan')
                        <p class="error-message">*Wajib diisi</p>
                    @enderror
                </div>
            </div>

            <div class="form-box">

                <div class="input-box">
                    <label for="unit">Unit Ormawa: </label>
                    <input type="text" id="unit" name="unit" value="{{ $rutin->unit }}">
                    @error('unit')
                        <p class="error-message">*Wajib diisi</p>
                    @enderror
                </div>

                <input style="margin-top: 5rem;" class="submitButton" type="submit" value="Update">
                <div style="text-align: center; margin-top: 20px;">
                    <a href="/admin/rutin" style="color: white; background-color: rgb(0, 173, 221); padding: 1px 3px; text-decoration: none; border-radius: 5px;">Kembali</a>
                </div>
            </div>



        </form>

    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>

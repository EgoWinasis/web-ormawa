@extends('admin.layoutadmin.main')
@section('konten')
    <div class="container-profile d-flex active">
        <div class="form-container">

            <form method="post" enctype="multipart/form-data" action="user/{{ $user->id }}/edit">
                @csrf

                <div class="form-box">
                    <div class="input-box">
                        <label for="organisai-input">Nama: </label>
                        <input type="text" id="organisai-input" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="input-box">
                        <label for="visi-input">Visi: </label>
                        <input type="text" id="visi-input" value="{{ $user->visi }}" name="visi">
                    </div>
                    <div class="input-box">
                        <label for="logo-input">Logo: </label>
                        <input type="file" id="logo-input" accept="image/*" value="" name="logo">
                        <p
                            class="ket 
                @error('gambar')  
                    error
                @enderror ">
                            Pastikan memasukan File berkestensi jpg atau png saja. Max: 2MB</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="input-box">
                        <label for="struktur-input">Email: </label>
                        <input type="email" id="struktur-input" value="{{ $user->email }}" name="email">
                    </div>
                    <div class="input-box">
                        <label for="misi-input">Misi: </label>
                        <input type="text" id="misi-input" value="{{ $user->visi }}" name="misi">
                    </div>
                    <div class="input-box">
                        <label for="password">password: </label>
                        <input type="password" id="password" name="password">
                        <p class="ket">kektuatan password: <span id="power-point">Maukan min 6
                                karakter</span></p>
                    </div>
                    <script>
                        // cek kekuatan password
                        let password = document.getElementById("password");
                        let power = document.getElementById("power-point");
                        password.oninput = function() {
                            let point = 0;
                            let value = password.value;
                            let widthPower = ["Sangat Lemah", "Lemah", "Cukup", "Kuat", "Sangat Kuat"];
                            let colorPower = ["#D73F40", "#DC6551", "#F2B84F", "#BDE952", "#3ba62f"];
            
                            if (value.length >= 6) {
                                let arrayTest = [/[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/];
                                arrayTest.forEach((item) => {
                                    if (item.test(value)) {
                                        point += 1;
                                    }
                                });
                            }
                            power.textContent = widthPower[point];
                            power.style.color = colorPower[point];
                        };
                    </script>
                    {{-- <div class="input-box">
                        <label for="tupoksi-input">Tugas Pokok: </label>
                        <input type="text" id="tupoksi-input" value="{{ $user->tupoksi }}" name="tupoksi">
                    </div> --}}
                    <div class="input-box">
                        <button style="color: white; width: 12rem; border-radius: 6px;" class="edit"><span
                                class="material-symbols-outlined">edit</span>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <p>Note: <span style="font-style: oblique">pertama kali masuk ubah password🙌</span></p>
    </div>
@endsection

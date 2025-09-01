@extends('admin.layoutadmin.main')
@section('konten')
<div class="container py-4" style="margin-top: 2rem ">


    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body overflow-auto">
                    <h4 class="card-title mb-4 text-center">Edit Profile</h4>

                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('user.update', $user->user_id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="organisai-input" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="organisai-input" name="name" value="{{ $user->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Visi -->
                                <div class="mb-3">
                                    <label for="visi-input" class="form-label">Visi</label>
                                    <textarea class="form-control @error('visi') is-invalid @enderror" id="visi-input"
                                        name="visi" rows="3">{{ $user->visi }}</textarea>
                                    @error('visi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Misi -->
                                <div class="mb-3">
                                    <label for="misi-input" class="form-label">Misi</label>
                                    <textarea class="form-control @error('misi') is-invalid @enderror" id="misi-input"
                                        name="misi" rows="3">{{ $user->misi }}</textarea>
                                    @error('misi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email-input" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email-input" name="email" value="{{ $user->email }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    <div class="form-text">
                                        Kekuatan password: <span id="power-point" class="fw-bold">Masukkan min 6
                                            karakter</span>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Logo -->
                                <div class="mb-3">
                                    <label for="logo-input" class="form-label">Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo-input" accept="image/*" name="logo">
                                    <div class="form-text">
                                        Pastikan file <strong>jpg</strong> atau <strong>png</strong>, Max: 2MB.
                                    </div>
                                    @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <span class="material-symbols-outlined">edit</span> Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <p class="text-muted mt-3 text-center">
                Note: <span class="fst-italic">pertama kali masuk ubah password 🙌</span>
            </p>
        </div>
    </div>
</div>

<script>
    // cek kekuatan password
    let password = document.getElementById("password");
    let power = document.getElementById("power-point");
    password.oninput = function () {
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
@endsection

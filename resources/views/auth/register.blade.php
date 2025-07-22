@extends('layouts.app')
@section('title', 'register')
@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-center align-items-center" style="height: 50%;">
            <div class="w-50 center border rounded px-3 py-3 mx-auto">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div style="display: flex; justify-content: center; align-items: center;"> 
                        <img src="storage/file-logo/login.png" alt="ilustrasi aplikasi Organisasi">
                        </div>
                    <div class="mb-3">
                        <h1 class="text-center">Daftar</h1>
                        <label for="name" class="form-label">Nama Lengkap <span style="color:red;">*</span></label>
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM<span style="color:red;">*</span></label>
                        <input type="text" maxlength="9" value="{{ old('nim') }}" name="nim"
                            class="form-control">
                        @if ($errors->has('nim'))
                            <div class="text-danger">
                                {{ $errors->first('nim') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span style="color:red;">*</span></label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control">
                        @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="nomor" class="form-label">WhatsApp<span style="color:red;">*</span></label>
                        <input type="text" maxlength="13" value="{{ old('nomor') }}" name="nomor"
                            class="form-control">
                        @if ($errors->has('nomor'))
                            <div class="text-danger">
                                {{ $errors->first('nomor') }}
                            </div>
                        @endif
                    </div>


                    <div class="mb-3">
                        <label class="form-label" for="prodi">Program Studi: <span style="color:red;">*</span></label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="DIV Akuntansi Sektor Publik">DIV Akuntansi Sektor Publik</option>
                            <option value="DIV Teknik Informatika">DIV Teknik Informatika</option>
                            <option value="DIII Akuntansi">DIII Akuntansi</option>
                            <option value="DIII Desain Komunikasi Visual">DIII Desain Komunikasi Visual</option>
                            <option value="DIII Farmasi">DIII Farmasi</option>
                            <option value="DIII Kebidanan">DIII Kebidanan</option>
                            <option value="DIII Keperawatan">DIII Keperawatan</option>
                            <option value="DIII Perhotelan">DIII Perhotelan</option>
                            <option value="DIII Teknik Elektronika">DIII Teknik Elektronika</option>
                            <option value="DIII Teknik Komputer">DIII Teknik Komputer</option>
                            <option value="DIII Teknik Mesin">DIII Teknik Mesin</option>
                        </select>
                        @if ($errors->has('prodi'))
                            <div class="text-danger">
                                {{ $errors->first('prodi') }}
                            </div>
                        @endif
                    </div>

                    {{-- <div class="mb-3">
                    <label for="semester" class="form-label">Semester<span style="color:red;">*</span></label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                    @if ($errors->has('semester'))
                        <div class="text-danger">
                            {{ $errors->first('semester') }}
                        </div>
                    @endif
                </div> --}}
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester<span style="color:red;">*</span></label>
                        <select name="semester" id="semester" class="form-control">
                            <!-- Semester options will be dynamically populated -->
                        </select>
                        @if ($errors->has('semester'))
                            <div class="text-danger">
                                {{ $errors->first('semester') }}
                            </div>
                        @endif
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const prodiSelect = document.getElementById('prodi');
                            const semesterSelect = document.getElementById('semester');

                            function updateSemesterOptions() {
                                const selectedProdi = prodiSelect.value;
                                const maxSemester = selectedProdi.startsWith('DIV') ? 6 : 4;

                                // Clear current options
                                semesterSelect.innerHTML = '';

                                // Populate new options
                                for (let i = 1; i <= maxSemester; i++) {
                                    const option = document.createElement('option');
                                    option.value = i;
                                    option.textContent = i;
                                    semesterSelect.appendChild(option);
                                }
                            }

                            // Initialize semester options on page load
                            updateSemesterOptions();

                            // Update semester options when prodi changes
                            prodiSelect.addEventListener('change', updateSemesterOptions);
                        });
                    </script>


                    <div class="mb-3">
                        <label for="password">password:<span style="color:red;">*</span></label>
                        <input type="password" id="password" name="password" class="form-control">
                        <p1 style="margin-top:4px" class="ket">kekuatan password: <span id="power-point">Masukan min 6
                                karakter</span></p1>
                        @if ($errors->has('password'))
                            <div class="text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm">Konfirmasi Password<span style="color:red;">*</span></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            autocomplete="new-password">
                    </div>
                    <div class="mb-3 d-grid">
                        <button name="submit" type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                    <p><span>Kembali ke <span> <a href="/login">Halaman Login</a></span></p>
                </form>
            </div>
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


        {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @endsection

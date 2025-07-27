@extends('layouts.app')
@section('title', 'Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="mb-0">Daftar Akun</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/file-logo/login.png') }}" 
                             alt="ilustrasi aplikasi Organisasi" 
                             class="img-fluid" style="max-height: 120px;">
                    </div>

                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <!-- NIM -->
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" maxlength="9" value="{{ old('nim') }}" 
                                       name="nim" id="nim" 
                                       class="form-control @error('nim') is-invalid @enderror">
                                <button type="button" class="btn btn-outline-primary" id="check-nim">Cek</button>
                            </div>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="nim-status" class="text-muted"></small>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('name') }}" 
                                   name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" readonly disabled>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" value="{{ old('email') }}" 
                                   name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror" disabled>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- WhatsApp -->
                        <div class="mb-3">
                            <label for="nomor" class="form-label">WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" maxlength="13" value="{{ old('nomor') }}" 
                                   name="nomor" id="nomor" 
                                   class="form-control @error('nomor') is-invalid @enderror" disabled>
                            @error('nomor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" disabled>
                            <small class="form-text">Kekuatan password: 
                                <span id="power-point" class="fw-bold text-muted">Masukan min 6 karakter</span>
                            </small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input id="password-confirm" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" autocomplete="new-password" disabled>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button name="submit" type="submit" class="btn btn-primary" disabled id="submit-btn">
                                Daftar
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <p>Kembali ke <a href="/login">Halaman Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fields = ['name', 'email', 'nomor', 'password', 'password-confirm', 'submit-btn'];
    const nimInput = document.getElementById('nim');
    const checkButton = document.getElementById('check-nim');
    const nimStatus = document.getElementById('nim-status');

    function disableFields(state) {
        fields.forEach(id => {
            document.getElementById(id).disabled = state;
        });
    }

    // Initially disable fields
    disableFields(true);

    // AJAX check for NIM
    checkButton.addEventListener('click', function() {
        const nim = nimInput.value.trim();
        if (!nim) {
            nimStatus.textContent = "Masukkan NIM terlebih dahulu.";
            nimStatus.classList.remove('text-success');
            nimStatus.classList.add('text-danger');
            return;
        }

        nimStatus.textContent = "Memeriksa...";
        nimStatus.classList.remove('text-danger');
        nimStatus.classList.add('text-muted');

        fetch("{{ route('check.nim') }}", {  
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ nim })
        })
        .then(response => response.json())
.then(data => {
    if (data.exists) {
        let tableHtml = `
            <table class="table table-bordered" style="width:100%; text-align:left;">
                <tr><th>NIM</th><td>${data.nim}</td></tr>
                <tr><th>Nama</th><td>${data.nama}</td></tr>
                <tr><th>Jenis Kelamin</th><td>${data.jk}</td></tr>
                <tr><th>Prodi</th><td>${data.prodi}</td></tr>
                <tr><th>Semester</th><td>${data.semester}</td></tr>
                <tr><th>Kelas</th><td>${data.kelas}</td></tr>
            </table>
        `;

        Swal.fire({
            icon: 'success',
            title: 'Data Mahasiswa Ditemukan',
            html: tableHtml,
            confirmButtonText: 'OK'
        });

        nimStatus.textContent = "NIM ditemukan. Silakan isi form.";
        nimStatus.classList.remove('text-danger');
        nimStatus.classList.add('text-success');
        disableFields(false);

        document.getElementById('name').readOnly = true;
        document.getElementById('name').value = data.nama?? '';
    } else {
        Swal.fire({
            icon: 'error',
            title: 'NIM tidak ditemukan',
            text: "Silakan periksa kembali NIM Anda",
            confirmButtonText: 'OK'
        });

        nimStatus.textContent = "NIM tidak ditemukan.Hubungi Administrator";
        nimStatus.classList.remove('text-success');
        nimStatus.classList.add('text-danger');
        disableFields(true);
    }
})
.catch(() => {
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: 'Tidak dapat memeriksa NIM. Coba lagi nanti.',
        confirmButtonText: 'OK'
    });

    nimStatus.textContent = "Terjadi kesalahan saat memeriksa.";
    nimStatus.classList.remove('text-success');
    nimStatus.classList.add('text-danger');
});

    });

    // Password strength
    const password = document.getElementById("password");
    const power = document.getElementById("power-point");
    password.oninput = function() {
        let point = 0;
        let value = password.value;
        let widthPower = ["Sangat Lemah", "Lemah", "Cukup", "Kuat", "Sangat Kuat"];
        let colorPower = ["#D73F40", "#DC6551", "#F2B84F", "#BDE952", "#3ba62f"];
        if (value.length >= 6) {
            let arrayTest = [/[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/];
            arrayTest.forEach((item) => { if (item.test(value)) point += 1; });
        }
        power.textContent = widthPower[point];
        power.style.color = colorPower[point];
    };
});
</script>
@endsection

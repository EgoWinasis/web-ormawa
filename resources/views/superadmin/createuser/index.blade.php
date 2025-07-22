@extends('superadmin.layoutsuper.main')
@section('konten')
    <div class="container-profile d-flex active">
        <div class="form-container">
            <form method="post" enctype="multipart/form-data" action="{{ route('tambahAdmin') }}">
                @csrf

                <div class="form-box">
                    <div class="input-box">
                        <label for="name-input">Nama: </label>
                        <input type="text" id="name-input" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="email-input">Email: </label>
                        <input type="email" id="email-input" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-box">
                    <div class="input-box">
                        <label for="organisasi-input">Unit: </label>
                        <input type="text" id="organisasi-input" name="nama_organisasi" value="{{ old('nama_organisasi') }}">
                        @error('nama_organisasi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <button style="color: white; width: 12rem; border-radius: 6px;" class="edit">
                            <span class="material-symbols-outlined">edit</span>Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <p style="font-style: italic">Note: Tolong double check untuk data yang di input🙌</p>
    </div>
@endsection

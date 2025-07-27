@extends('superadmin.layoutsuper.main')

@section('konten')
<div class="container-arsip d-flex active">

<div class="container"  style="padding-top:7%">
    <h2 class="text-center">Import Data Mahasiswa</h2>

    <div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">

    <div class="d-flex flex-wrap align-items-center gap-2">
        <input type="file" id="excelFile" class="form-control form-control-sm" accept=".xlsx, .xls" style="max-width: 200px;">

        <button type="button" id="importBtn" class="btn btn-success btn-sm">
            <i class="bi bi-upload"></i> Import
        </button>

        <button type="button" id="simpanBtn" class="btn btn-secondary btn-sm">
            <i class="bi bi-save"></i> Simpan
        </button>

       <a href="{{ asset('storage/template_mahasiswa.xlsx') }}" class="btn btn-info btn-sm" download>
    <i class="bi bi-download"></i> Download Template
</a>


     
    </div>
</div>




            <!-- Card Body -->
            <div class="card-body">
                <table class="table table-hover table-bordered align-middle fl-table" id="anggotaTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Prodi</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Jalur</th>
                            <th>Semester</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endsection

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- link ke css root -->
     <link rel="stylesheet" href="../../../../css/root.css">

     <!-- link ke css landing -->
     <link rel="stylesheet" href="../../../../css/admin.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">  

     <!-- google icons -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Data Calon</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
</head>
<body>
    <div class="container-calon d-flex">
        <h2>{{$panitia->name}}</h2>
        <img src="../../../../storage/{{$panitia->foto}}" alt="foto calon anggota" width="180px" height="240px">
        <div style="flex-direction: column;" class="container-both d-flex">
        <div>
            <P>Prodi: {{$panitia->prodi}}</P>
            <P>NIM: {{$panitia->nim}}</P>
            <P>Semester: {{$panitia->semester}}</P>
            <P>Nomor Wa: {{$panitia->nomor}}</P>
            
        </div>
        <div class="container-document d-flex" >
            
           <div style="gap: 1rem" class="d-flex"> 
            <form class="d-flex" id='dataForm' style="gap: 1rem" action="{{ route('admin.accept', ['id' => $panitia->id]) }}" method="post"> @csrf
                <button type="button" class="btn btn-primary" id="acceptButton">Terima</button>
            </form>
            <form class="d-flex" id="dataFormReject" style="gap: 1rem" action="{{ route('admin.rejectWawancara', ['id' => $panitia->id]) }}" method="post"> @csrf
                <button type="button" class="btn btn-danger" id="rejectButton">Gagal</button>
            </form>
        </div>
        <a style=" width: 100%; text-align:center;" href="/admin/dashboard"> Kembali</a>
            <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">  
                <div class="modal-dialog">  
                    <div class="modal-content">  
                        <div class="modal-header">  
                            <h5 class="modal-title" id="inputModalLabel">Masukan Keterangan Aksi</h5>  
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                        </div>  
                        <div class="modal-body">  
                            <input type="text" id="additionalData" class="form-control" placeholder="Masukan Alasan">  
                        </div>  
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>  
                            <button type="button" class="btn btn-primary" id="confirmButton">Kirim</button>  
                        </div>  
                    </div>  
                </div>  
            </div>  
           
        </div>
    </div>
    </div>
    <script src="../../js/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>  
    <script>  
        let aksi = '';
        
        document.getElementById('acceptButton').onclick = function() {  
            var myModal = new bootstrap.Modal(document.getElementById('inputModal')); 
            aksi = 'terima'; // Set aksi ke "terima"
            myModal.show();  
        };  
    
        document.getElementById('rejectButton').onclick = function() {  
            var myModal = new bootstrap.Modal(document.getElementById('inputModal'));  
            aksi = 'ditolak'; // Set aksi ke "ditolak"
            myModal.show();  
        };  
    
        document.getElementById('confirmButton').onclick = function() {  
            var additionalData = document.getElementById('additionalData').value;  
            
            // Validasi alasan tidak boleh kosong
            if (!additionalData) {
                alert('Alasan wajib diisi!');
                return; // Tidak melanjutkan jika alasan kosong
            }
    
            // Buat input tambahan untuk alasan
            var input = document.createElement('input');  
            input.type = 'hidden';  
            input.name = 'additional_data'; // Sesuaikan nama input sesuai backend Anda  
            input.value = additionalData;  
    
            if (aksi == 'terima') {
                document.getElementById('dataForm').appendChild(input);  
                // Submit form jika alasan sudah diisi
                document.getElementById('dataForm').submit();  
            } else {
                document.getElementById('dataFormReject').appendChild(input);  
                // Submit form untuk tolak jika alasan sudah diisi
                document.getElementById('dataFormReject').submit();    
            }
        };  
    </script>
    
</body>
</html>
<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\NullableType;

class AnggotaController extends Controller
{ // {{-- update --}}
    public function show($id)  
    {  
        // Ambil anggota berdasarkan ID dengan semua agendanya  
        $anggota = User::with('agendas')->findOrFail($id);  
        
        // Mengambil agenda unik  
        $uniqueAgendas = $anggota->agendas->unique('id'); // Pastikan 'id' adalah kolom unik pada table agendas  

        return view('anggota-show', compact('anggota', 'uniqueAgendas'));  
    }  

    public function panitiaKegiatan($id)
    {
      $panitia = User::find($id);
      $panitia->agenda_id = request()->agenda_id;
      $panitia->save();

      return redirect()->back();
    }

    public function panitiaDestroy($id) {
        User::destroy($id);
        return redirect()->back();
    }

    public function panitiaView($id) {
     
        $panitia = User::find($id);

        // return view ('kegiatan');
        return view('/admin/data_calon', [
            'panitia' => $panitia,

        ]);
    }
    
    public function wawancaraView($id) {
     
        $panitia = User::find($id);

        // return view ('kegiatan');
        return view('/admin/data_calon_wawancara', [
            'panitia' => $panitia,

        ]);
    }

    public function store($id,Request $request)
    {
		
    	$this->validate($request,[
    		'nama_organisasi' => 'required',
    		'ktm' => 'required',
    		'foto' => 'required|file|image|mimes:jpeg,png,jpg|max:2000',
    		'riwayat_studi' => 'required',
    		'sertif' => 'required',
    	]);
		$foto = request()->file('foto')->store('file-foto');
		$studi = request()->file('riwayat_studi')->store('file-studi');
		$ktm = request()->file('ktm')->store('file-ktm');
		$user = User::find($id);
		$sertif = request()->file('sertif')->store('file-sertif');
        User::updateOrCreate([
			'name' => $user->name,
		],
		[
    		'status' => 'calon',
    		'nama_organisasi' => $request->nama_organisasi,
    		'foto' => $foto,
    		'riwayat_studi' => $studi,
    		'ktm' => $ktm,
    		'sertif' => $sertif,
    		
    	]);
 
    	// $anggota = Anggota::all();
        // $users = User::all();
        // return view('/dashboard-pendaftaran', ['user'=> $user, 'users' => $users, 'anggota' => $anggota]);
		return redirect ()->back() -> with('succes','Berhasil Mendaftar');

    }

    

}
<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\NullableType;
use Illuminate\Support\Facades\DB;

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
        try {
            // Cek apakah user ada
            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan!');
            }
    
            // Hapus data anggota
            DB::table('anggota')->where('user_id', $id)->delete();
    
            // Hapus user
            $user->delete();
    
            return redirect()->back()->with('success', 'Data anggota berhasil dihapus!');
        } catch (\Exception $e) {
            // Tangkap error dan tampilkan pesan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
    
    

    public function panitiaView($id) {
     
        $panitia = DB::table('users')
        ->join('anggota', 'anggota.user_id', '=', 'users.id')
        ->select('users.*', 'anggota.*') 
        ->where('users.id', $id)
        ->first(); 

       

        // return view ('kegiatan');
        return view('/admin/data_calon', [
            'panitia' => $panitia,

        ]);
    }
    
    public function wawancaraView($id) {
     
        $panitia = DB::table('users')
        ->join('anggota', 'anggota.user_id', '=', 'users.id')
        ->select('users.*', 'anggota.*') 
        ->where('users.id', $id)
        ->first(); 
        
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
        $foto = request()->file('foto')->store('file-foto', 'public');
        $studi = request()->file('riwayat_studi')->store('file-studi', 'public');
        $ktm  = request()->file('ktm')->store('file-ktm', 'public');
        $sertif = request()->file('sertif')->store('file-sertif', 'public');
        
        
		$user = Anggota::find($id);
        Anggota::updateOrCreate(
            ['id' => $id],
		[
    		'status' => 'calon',
    		'nama_organisasi' => $request->nama_organisasi,
    		'riwayat_studi' => $studi,
    		'ktm' => $ktm,
    		'sertif' => $sertif,
    		
        ]);
        User::where('id', $user->user_id)->update([
            'foto' => $foto
        ]);
 
    
		return redirect ()->back() -> with('succes','Berhasil Mendaftar');

    }

    

}
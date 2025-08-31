<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Models\Rutin;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function landing()
    {
        $kegiatan = Agenda::all();
        $user =DB::table('users')
        ->join('admin', 'admin.user_id', '=', 'users.id')
        ->get();
        
        $rutin = Rutin::all();
        $thing = false;
        foreach ($kegiatan as $key => $value) {
            // push into array
            if (!$value->lpj == null) {
                $thing = true;
            }
        }
        // $dpm = User::where('nama_organisasi', 'dpm')->get();

        return view('landing', [
            'kegiatan' => $kegiatan,
            'user' => $user,
            'thing' => $thing,
            'rutin' => $rutin
        ]);
    }
    public function organisasi()
    {
      
        $user =DB::table('users')
        ->join('admin', 'admin.user_id', '=', 'users.id')
        ->get();
        

        return view('organisasi', [
            'user' => $user,
        ]);
    }
}

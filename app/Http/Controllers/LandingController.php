<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Models\Rutin;

class LandingController extends Controller
{
    public function landing()
    {
        $kegiatan = Agenda::all();
        $user = Admin::all();
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
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Rutin;
use App\Models\Riwayat;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = Admin::all();
        $user = Auth::user();
        return view('user.index', compact('user','admin'));
    }

    public function history()
    {
        $admin = Admin::all();
        $user = Auth::user();
        return view('user.history', compact('user','admin'));
    }

    public function riwayat()
    {
        $admin = Admin::all();
        $user = Auth::user();
        $riwayat = Riwayat::where('user_id', $user->id)->get();
        return view('user.riwayatdaftar', compact('user','admin','riwayat'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Rutin;
use App\Models\Riwayat;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Ensure the user is authenticated
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'user') {
                // Redirect if role is 'user'


                return redirect('/admin/dashboard'); // or '/home', etc.
            }

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = Admin::all();
        $userId = Auth::user()->id;

$user = DB::table('users')
    ->join('anggota', 'anggota.user_id', '=', 'users.id')
    ->select('users.*', 'anggota.*') 
    ->where('users.id', $userId)
    ->first(); 


$hasAktif = DB::table('riwayat')
    ->where('user_id', $userId)
    ->where('status', 'aktif')
    ->exists();


        if ($hasAktif) {
            // Redirect if active riwayat found
            return redirect('/riwayat')->with('swal_success', 'Anda sudah menjadi anggota aktif!');
        }
        return view('user.index', compact('user', 'admin'));
    }

    public function history()
    {
        $admin = Admin::all();
        $user = Auth::user();
        return view('user.history', compact('user', 'admin'));
    }

    public function riwayat()
    {
        $admin = Admin::all();
        $user = Auth::user();
        $riwayat = Riwayat::where('user_id', $user->id)->get();
        return view('user.riwayatdaftar', compact('user', 'admin', 'riwayat'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Rutin;
use App\Models\Agenda;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AcceptedNotification;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        return view('admin.login');

    }

    // public function login(Request $request)
    // {
    //     // Validasi kredensial
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('admin')->attempt($credentials)) {
    //         // Regenerasi session
    //         $request->session()->regenerate();

    //         // Redirect ke dashboard admin
    //         return redirect()->route('adminView'); // Pastikan ini menggunakan nama rute yang benar
    //     }


    //     return back()->withErrors([
    //         'email' => 'Email tidak terdaftar',
    //     ]);
    // }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'password.required' => 'Password Harus di isi',
            'email.required' => 'Email Harus di isi',
        ]);

        // Kredensial
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email tidak terdaftar']);
    }


    // public function logout(Request $request)
    // {
    //     Auth::guard('admin')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return view('landing');

    //     $kegiatan = Agenda::all();
    //     $user = Admin::all();
    //     $rutin = Rutin::all();
    //     $thing = false;
    //     foreach ($kegiatan as $key => $value) {
    //         if ($value->lpj != null) {
    //             $thing = true;
    //         }
    //     }
    //     return view('landing', [
    //         'kegiatan' => $kegiatan,
    //         'user' => $user,
    //         'thing' => $thing,
    //         'rutin' => $rutin,
    //     ]);
    // }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman '/'
        return redirect('/');
    }


    // percobaan input
    public function tambahAdmin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'nama_organisasi' => 'required|max:100'
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nama_organisasi.required' => 'Unit wajib diisi.'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('123456'),
            'nama_organisasi' => $request->nama_organisasi,
            'role' => 'admin',

        ]);

        return redirect()->back()->with('success', 'Berhasil Tambah Admin!');
    }


    public function userUpdate($id, Request $request)
    {
        $user = Admin::find($id);
        if ($request->logo) {
            $logo = request()->file('logo')->store('file-logo');
        } else {
            $logo = $user->logo;
        }
        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }
        ;
        Admin::find($id)->update([
            'name' => $request->name,
            'password' => $password,
            'email' => $request->email,
            'visi' => $request->visi,
            'tupoksi' => $request->tupoksi,
            'logo' => $logo,
            'misi' => $request->misi,
        ]);

        return redirect()->back()->with('success', 'Berhasil Edit Profile!');

    }

    // public function accept($id, Request $request)
    // {
    //     $additionalData = $request->input('additional_data');
    //     $calon = User::find($id)->update([
    //         'status' => 'aktif',
    //         'keterangan' => $additionalData,
    //     ]);

    //     return redirect('/admin/dashboard')->with('success', 'Anggota berhasil diterima!');
    // }
    // public function nextSession($id, Request $request)
    // {
    //     $additionalData = $request->input('additional_data');
    //     $calon = User::find($id)->update([
    //         'status' => 'Lolos ke Wawancara',
    //         'keterangan' => $additionalData,
    //     ]);

    //     return redirect('/admin/dashboard')->with('success', 'Anggota berhasil diterima!');
    // }
    // public function reject($id, Request $request)
    // {
    //     $additionalData = $request->input('additional_data');
    //     $calon = User::find($id)->update([
    //         'status' => 'ditolak',
    //         'keterangan' => $additionalData,
    //     ]);

    //     return redirect('/admin/dashboard')->with('success', 'Anggota Di Tolak!');
    // }

    public function accept($id, Request $request)
    {
        $additionalData = $request->input('additional_data');
        $tempatWawancara = $request->input('tempat_wawancara');
        $tglWawancara = $request->input('tgl_wawancara');
        $jamWawancara = $request->input('jam_wawancara');

        // Temukan user berdasarkan id
        $calon = User::find($id);

        if (!$calon) {
            // Jika calon tidak ditemukan, redirect dengan pesan error
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Update status dan keterangan calon
        $calon->update([
            'status' => 'aktif',
            'keterangan' => $additionalData,
            'tempat_wawancara' => $tempatWawancara,
            'tgl_wawancara' => $tglWawancara,
            'jam_wawancara' => $jamWawancara
        ]);

         // Simpan riwayat
         Riwayat::create([
            'user_id' => $calon->id,
            'organisasi_tujuan' => $calon->nama_organisasi,
            'status' => 'aktif',
            'keterangan' => $additionalData,
            'created_at' => now()
        ]);

        // Tentukan URL website untuk notifikasi
        $websiteUrl = url('/home');

        // Kirim notifikasi kepada calon
        $calon->notify(new AcceptedNotification($calon, $websiteUrl));

        // Redirect dengan pesan sukses
        return redirect('/admin/wawancara')->with('success', 'Anggota berhasil diterima!');
    }


    public function nextSession($id, Request $request)
    {
        $additionalData = $request->input('additional_data');
        $tempatWawancara = $request->input('tempat_wawancara');
        $tglWawancara = $request->input('tgl_wawancara');
        $jamWawancara = $request->input('jam_wawancara');

        // Temukan user berdasarkan id
        $calon = User::find($id);

        if (!$calon) {
            // Jika calon tidak ditemukan, redirect dengan pesan error
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Update status dan keterangan calon
        $calon->update([
            'status' => 'Lolos ke Wawancara',
            'keterangan' => $additionalData,
            'tempat_wawancara' => $tempatWawancara,
            'tgl_wawancara' => $tglWawancara,
            'jam_wawancara' => $jamWawancara
        ]);

         // Simpan riwayat
         Riwayat::create([
            'user_id' => $calon->id,
            'organisasi_tujuan' => $calon->nama_organisasi,
            'status' => 'Lolos Ke Wawancara',
            'keterangan' => $additionalData,
            'created_at' => now()
        ]);

        // Tentukan URL website untuk notifikasi
        $websiteUrl = url('/home');

        // Kirim notifikasi kepada calon
        $calon->notify(new AcceptedNotification($calon, $websiteUrl));

        // Redirect dengan pesan sukses
        return redirect('/admin/calon')->with('success', 'Anggota lolos ke wawancara!');
    }

    public function reject($id, Request $request)
    {
        $additionalData = $request->input('additional_data');
        $tempatWawancara = $request->input('tempat_wawancara');
        $tglWawancara = $request->input('tgl_wawancara');
        $jamWawancara = $request->input('jam_wawancara');

        // Temukan user berdasarkan id
        $calon = User::find($id);

        if (!$calon) {
            // Jika calon tidak ditemukan, redirect dengan pesan error
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Update status dan keterangan calon
        $calon->update([
            'status' => 'gagal tahap administrasi',
            'keterangan' => $additionalData,
            'tempat_wawancara' => $tempatWawancara,
            'tgl_wawancara' => $tglWawancara,
            'jam_wawancara' => $jamWawancara
        ]);

        // Simpan riwayat
        Riwayat::create([
            'user_id' => $calon->id,
            'organisasi_tujuan' => $calon->nama_organisasi,
            'status' => 'gagal tahap administrasi',
            'keterangan' => $additionalData,
            'created_at' => now()
        ]);

        // Tentukan URL website untuk notifikasi
        $websiteUrl = url('/home');

        // Kirim notifikasi kepada calon
        $calon->notify(new AcceptedNotification($calon, $websiteUrl));

        // Redirect dengan pesan sukses
        return redirect('/admin/calon')->with('success', 'Anggota Ditolak!');
    }

    public function rejectWawancara($id, Request $request)
    {
        $additionalData = $request->input('additional_data');
        $tempatWawancara = $request->input('tempat_wawancara');
        $tglWawancara = $request->input('tgl_wawancara');
        $jamWawancara = $request->input('jam_wawancara');

        // Temukan user berdasarkan id
        $calon = User::find($id);

        if (!$calon) {
            // Jika calon tidak ditemukan, redirect dengan pesan error
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Update status dan keterangan calon
        $calon->update([
            'status' => 'gagal tahap wawancara',
            'keterangan' => $additionalData,
            'tempat_wawancara' => $tempatWawancara,
            'tgl_wawancara' => $tglWawancara,
            'jam_wawancara' => $jamWawancara
        ]);

        // Simpan riwayat
        Riwayat::create([
            'user_id' => $calon->id,
            'organisasi_tujuan' => $calon->nama_organisasi,
            'status' => 'gagal tahap wawancara',
            'keterangan' => $additionalData,
            'created_at' => now()
        ]);

        // Tentukan URL website untuk notifikasi
        $websiteUrl = url('/home');

        // Kirim notifikasi kepada calon
        $calon->notify(new AcceptedNotification($calon, $websiteUrl));

        // Redirect dengan pesan sukses
        return redirect('/admin/wawancara')->with('success', 'Anggota Ditolak!');
    }



    function adminView()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.dashboard.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.dashboard.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    function tambahAdminView()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.dashboard.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.createuser.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }


    public function news()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.news.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.news.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function arsip()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.arsip.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.arsip.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function absensi()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.pengurus.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.dataormawa.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function calon()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.calon.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.dashboard.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function wawancara()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.wawancara.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.dashboard.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function profile()
    {
        if (Auth::user()->role == 'admin') {
            $org = Auth::user()->nama_organisasi;
            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = User::where('nama_organisasi', $org)->get();
            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = Admin::find(Auth::user()->id);
            return view('admin.profile.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get(); 
            $user = User::find(Auth::user()->id);
            return view('superadmin.dashboard.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

}

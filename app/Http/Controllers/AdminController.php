<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Rutin;
use App\Models\Agenda;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AcceptedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Penilaian;

class AdminController extends Controller
{
    public function __construct()
    {
        // Ensure the user is authenticated
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role === 'user') {
                // Redirect if role is 'user'
                return redirect('/home'); // or '/home', etc.
            }

            return $next($request);
        });
    }


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
        ], [
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
            'email' => 'required|email|unique:users,email',
            'nama_organisasi' => 'required|max:100'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nama_organisasi.required' => 'Unit wajib diisi.'
        ]);

        DB::beginTransaction(); // Mulai transaksi

        try {
            $now = Carbon::now();

            // Insert ke tabel users
            $userId = DB::table('users')->insertGetId([
                'name' => $request->nama_organisasi,
                'email' => $request->email,
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Insert ke tabel admin
            DB::table('admin')->insert([
                'user_id' => $userId,
                'nama_organisasi' => $request->nama_organisasi,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Tambah Admin!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika error
            return redirect()->back()->with('error', 'Gagal Tambah Admin! Pesan: ' . $e->getMessage());
        }
    }


    public function userUpdate($id, Request $request)
    {

        $user = User::findOrFail($id);
        $admin = Admin::where('user_id', $id)->first();


        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('file-logo', 'public');
        } else {

            $logo = $user->foto;
        }


        $password = $request->filled('password') ? bcrypt($request->password) : $user->password;


        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $password,
            'foto'     => $logo,
        ]);

        if ($admin) {
            $admin->update([
                'visi'    => $request->visi,
                'misi'    => $request->misi,
                'tupoksi' => $request->tupoksi,
            ]);
        }


        return redirect()->back()->with('success', 'Berhasil Edit Profile!');

    }



    public function accept($id, Request $request)
    {
        $additionalData   = $request->input('additional_data');
        $tempatWawancara  = $request->input('tempat_wawancara');
        $tglWawancara     = $request->input('tgl_wawancara');
        $jamWawancara     = $request->input('jam_wawancara');

        // Ambil user dengan Eloquent
        $user = User::find($id);

        if (!$user) {
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Ambil data anggota
        $anggota = DB::table('anggota')->where('user_id', $id)->first();
        if (!$anggota) {
            return redirect('/admin/dashboard')->with('error', 'Data anggota tidak ditemukan!');
        }

        // Update status anggota
        DB::table('anggota')
            ->where('user_id', $id)
            ->update([
                'status'           => 'aktif',
                'keterangan'       => $additionalData,
                'tempat_wawancara' => $tempatWawancara,
                'tgl_wawancara'    => $tglWawancara,
                'jam_wawancara'    => $jamWawancara
            ]);

        // Simpan riwayat (update or create)
        Riwayat::updateOrCreate(
            [
                'user_id' => $user->id,
                'status'  => 'aktif'
            ],
            [
                'organisasi_tujuan' => $anggota->nama_organisasi,
                'keterangan'        => $additionalData,
                'created_at'        => now()
            ]
        );

        // URL website untuk notifikasi
        $websiteUrl = url('/history');

        // Kirim notifikasi
        $user->notify(new AcceptedNotification($user, $websiteUrl));

        return redirect('/admin/wawancara')->with('success', 'Anggota berhasil diterima!');
    }


    public function nextSession($id, Request $request)
    {
        $additionalData = $request->input('additional_data');
        $tempatWawancara = $request->input('tempat_wawancara');
        $tglWawancara = $request->input('tgl_wawancara');
        $jamWawancara = $request->input('jam_wawancara');

        // Ambil user dengan Eloquent
        $user = User::find($id);

        if (!$user) {
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }


        $anggota = DB::table('anggota')->where('user_id', $id)->first();
        if (!$anggota) {
            return redirect('/admin/dashboard')->with('error', 'Data anggota tidak ditemukan!');
        }

        DB::table('anggota')
            ->where('user_id', $id)
            ->update([
                'status' => 'Lolos ke Wawancara',
                'keterangan' => $additionalData,
                'tempat_wawancara' => $tempatWawancara,
                'tgl_wawancara' => $tglWawancara,
                'jam_wawancara' => $jamWawancara
            ]);


        Riwayat::updateOrCreate(
            [
                'user_id' => $user->id, // Kondisi unik
                'status' => 'Lolos Ke Wawancara'
            ],
            [
                'organisasi_tujuan' => $anggota->nama_organisasi,
                'keterangan' => $additionalData,
                'created_at' => now()
            ]
        );


        $websiteUrl = url('/history');

        $user->notify(new AcceptedNotification($user, $websiteUrl));

        return redirect('/admin/calon')->with('success', 'Anggota lolos ke wawancara!');
    }



    public function reject($id, Request $request)
    {
        $additionalData   = $request->input('additional_data');
        $tempatWawancara  = $request->input('tempat_wawancara');
        $tglWawancara     = $request->input('tgl_wawancara');
        $jamWawancara     = $request->input('jam_wawancara');

        // Ambil user dengan Eloquent
        $user = User::find($id);

        if (!$user) {
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Ambil data anggota
        $anggota = DB::table('anggota')->where('user_id', $id)->first();
        if (!$anggota) {
            return redirect('/admin/dashboard')->with('error', 'Data anggota tidak ditemukan!');
        }

        // Update status anggota
        DB::table('anggota')
            ->where('user_id', $id)
            ->update([
                'status'          => 'Gagal Tahap Administrasi',
                'keterangan'      => $additionalData,
                'tempat_wawancara' => $tempatWawancara,
                'tgl_wawancara'   => $tglWawancara,
                'jam_wawancara'   => $jamWawancara
            ]);

        // Simpan riwayat (create or update)
        Riwayat::updateOrCreate(
            [
                'user_id' => $user->id,
                'status'  => 'Gagal Tahap Administrasi'
            ],
            [
                'organisasi_tujuan' => $anggota->nama_organisasi,
                'keterangan'        => $additionalData,
                'created_at'        => now()
            ]
        );

        // URL website untuk notifikasi
        $websiteUrl = url('/home');

        // Kirim notifikasi (gunakan User model)
        $user->notify(new AcceptedNotification($user, $websiteUrl));

        return redirect('/admin/calon')->with('success', 'Anggota ditolak!');
    }


    public function rejectWawancara($id, Request $request)
    {
        $additionalData   = $request->input('additional_data');
        $tempatWawancara  = $request->input('tempat_wawancara');
        $tglWawancara     = $request->input('tgl_wawancara');
        $jamWawancara     = $request->input('jam_wawancara');

        // Ambil user dengan Eloquent
        $user = User::find($id);

        if (!$user) {
            return redirect('/admin/dashboard')->with('error', 'User tidak ditemukan!');
        }

        // Ambil data anggota
        $anggota = DB::table('anggota')->where('user_id', $id)->first();
        if (!$anggota) {
            return redirect('/admin/dashboard')->with('error', 'Data anggota tidak ditemukan!');
        }

        // Update status anggota
        DB::table('anggota')
            ->where('user_id', $id)
            ->update([
                'status'           => 'Gagal Tahap Wawancara',
                'keterangan'       => $additionalData,
                'tempat_wawancara' => $tempatWawancara,
                'tgl_wawancara'    => $tglWawancara,
                'jam_wawancara'    => $jamWawancara
            ]);

        // Simpan riwayat (update or create)
        Riwayat::updateOrCreate(
            [
                'user_id' => $user->id,
                'status'  => 'Gagal Tahap Wawancara'
            ],
            [
                'organisasi_tujuan' => $anggota->nama_organisasi,
                'keterangan'        => $additionalData,
                'created_at'        => now()
            ]
        );

        // Tentukan URL website untuk notifikasi
        $websiteUrl = url('/home');

        // Kirim notifikasi kepada calon
        $user->notify(new AcceptedNotification($user, $websiteUrl));

        return redirect('/admin/wawancara')->with('success', 'Anggota ditolak!');
    }



    public function adminView()
    {

        if (Auth::user()->role == 'admin') {
            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');

            // === Anggota per tahun ===
            $anggota = DB::table('users')
                ->join('anggota', 'anggota.user_id', '=', 'users.id')
                ->where('anggota.nama_organisasi', $org)
                ->select(DB::raw('YEAR(anggota.created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            // === Kegiatan per tahun ===
            $kegiatan = Agenda::where('nama_organisasi', $org)
                ->select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            // === News (LPJ) per tahun ===
            $news = Agenda::where('nama_organisasi', $org)
                ->whereNotNull('lpj')
                ->select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            $rutin = Rutin::all();

            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();

            return view('admin.dashboard.index', compact('user', 'rutin', 'anggota', 'kegiatan', 'news'));

        } elseif (Auth::user()->role == 'super_admin') {

            // Semua organisasi
            $anggota = Anggota::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            $userTotal = Admin::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            $kegiatan = Agenda::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            $news = Agenda::whereNotNull('lpj')
                ->select(DB::raw('YEAR(created_at) as tahun'), DB::raw('COUNT(*) as total'))
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();

            $admin = Admin::all();
            $user = User::find(Auth::user()->id);

            return view('superadmin.dashboard.index', compact('user', 'userTotal', 'anggota', 'kegiatan', 'news', 'admin'));
        }

    }

    public function tambahAdminView()
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

            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');


            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $anggota = DB::table('users')
                     ->join('anggota', 'anggota.user_id', '=', 'users.id')
                     ->where('anggota.nama_organisasi', $org)
                     ->select('users.*', 'anggota.*')  // select fields from both tables as needed
                     ->get();


            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get();
            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();





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

            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');



            $anggota = DB::table('users')
                     ->join('anggota', 'anggota.user_id', '=', 'users.id')
                     ->where('anggota.nama_organisasi', $org)
                     ->select('users.*', 'anggota.*')  // select fields from both tables as needed
                     ->get();


            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get();
            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();


            $kegiatan = Agenda::where('nama_organisasi', $org)->get();

            $rutin = Rutin::all();

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

            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');


            $kegiatan = Agenda::where('nama_organisasi', $org)->get();
            $results = DB::table('users')
            ->join('anggota', 'anggota.user_id', '=', 'users.id')
            ->leftJoin('anggota_agenda', 'anggota_agenda.user_id', '=', 'users.id')
            ->leftJoin('agendas', 'agendas.id', '=', 'anggota_agenda.agenda_id')
            ->where('anggota.nama_organisasi', $org)
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email',
                'anggota.nama_organisasi',
                'anggota.jabatan',
                'anggota.status',
                'agendas.id as agenda_id',
                'agendas.nama_kegiatan',
                'agendas.tanggal_mulai',
                'agendas.tempat_kegiatan',
                'agendas.gambar',
                'agendas.proposal',
                'agendas.lpj'
            )
            ->get();



            $grouped = $results->groupBy('user_id')->map(function ($items) {
                $first = $items->first();

                return [
                    'user' => [
                        'id' => $first->user_id,
                        'name' => $first->user_name,
                        'email' => $first->email,
                        'jabatan' => $first->jabatan,
                        'status' => $first->status,
                        'nama_organisasi' => $first->nama_organisasi,
                    ],
                    'agendas' => $items->filter(function ($item) {
                        return $item->agenda_id !== null; // Hanya ambil agenda jika ada
                    })->map(function ($item) {
                        return [
                            'id' => $item->agenda_id,
                            'nama_kegiatan' => $item->nama_kegiatan,
                            'tanggal_mulai' => $item->tanggal_mulai,
                            'tempat_kegiatan' => $item->tempat_kegiatan,
                            'gambar' => $item->gambar,
                            'proposal' => $item->proposal,
                            'lpj' => $item->lpj,
                        ];
                    })->values()
                ];
            })->values();






            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get();
            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();


            return view('admin.pengurus.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $grouped, 'kegiatan' => $kegiatan]);
        } elseif (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::all();
            $anggota = DB::table('users')
                    ->join('anggota', 'anggota.user_id', '=', 'users.id')
                    ->get();
            $admin = Admin::all();
            // $anggota = User::orderBy('name')->get();
            $user = User::find(Auth::user()->id);
            return view('superadmin.dataormawa.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function calon()
    {
        if (Auth::user()->role == 'admin') {
            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');



            $anggota = DB::table('users')
                     ->join('anggota', 'anggota.user_id', '=', 'users.id')
                     ->where('anggota.nama_organisasi', $org)
                     ->select('users.*', 'anggota.*')  // select fields from both tables as needed
                     ->get();


            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get();
            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();


            $kegiatan = Agenda::where('nama_organisasi', $org)->get();

            $rutin = Rutin::all();
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
            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');



            $anggota = DB::table('users')
                     ->join('anggota', 'anggota.user_id', '=', 'users.id')
                     ->where('anggota.nama_organisasi', $org)
                     ->select('users.*', 'anggota.*')  // select fields from both tables as needed
                     ->get();


            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get();
            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();


            $kegiatan = Agenda::where('nama_organisasi', $org)->get();

            $rutin = Rutin::all();


            // nilai

            foreach ($anggota as $a) {
                $a->total_nilai = Penilaian::where('user_id', $a->user_id)->sum('nilai');
            }



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

            $userId = Auth::id();

            $org = DB::table('users')
                ->join('admin', 'admin.user_id', '=', 'users.id')
                ->where('users.id', $userId)
                ->value('admin.nama_organisasi');



            $anggota = DB::table('users')
                     ->join('anggota', 'anggota.user_id', '=', 'users.id')
                     ->where('anggota.nama_organisasi', $org)
                     ->select('users.*', 'anggota.*')  // select fields from both tables as needed
                     ->get();


            $rutin = Rutin::all();
            // $anggota = User::orderBy('name')->get();
            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();


            $kegiatan = Agenda::where('nama_organisasi', $org)->get();

            $rutin = Rutin::all();


            return view('admin.profile.index', ['user' => $user, 'rutin' => $rutin, 'anggota' => $anggota, 'kegiatan' => $kegiatan]);

        } elseif (Auth::user()->role == 'super_admin') {

            $userId = Auth::id();

            $kegiatan = Agenda::all();
            $anggota = User::all();
            $admin = Admin::all();

            $user = DB::table('users')
               ->join('admin', 'admin.user_id', '=', 'users.id')
               ->where('users.id', $userId)
               ->first();


            return view('superadmin.profile.index', ['user' => $user, 'anggota' => $anggota, 'kegiatan' => $kegiatan, 'admin' => $admin]);
        }
    }

    public function updateJabatan(Request $request, $userId)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
        ]);

        // Update jabatan in anggota table where user_id = $userId
        $updated = DB::table('anggota')
    ->where('user_id', $userId)
    ->update([
         'jabatan' => strtolower($request->jabatan)
    ]);


        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal update jabatan.']);
        }
    }



    // otorisasi arsip
    public function otor()
    {
        if (Auth::user()->role == 'super_admin') {
            $kegiatan = Agenda::where(function ($query) {
                $query->where(function ($q) {
                    $q->whereIn('status_proposal', [0, 2])
                      ->whereNotNull('proposal');
                })->orWhere(function ($q) {
                    $q->whereIn('status_lpj', [0, 2])
                      ->whereNotNull('lpj');
                });
            })->get();

            $anggota = User::all();
            $admin = Admin::all();
            $user = Auth::user(); // lebih simpel daripada find()

            return view('superadmin.otor.index', [
                'user' => $user,
                'anggota' => $anggota,
                'kegiatan' => $kegiatan,
                'admin' => $admin
            ]);
        }

        // Jika bukan super admin
        return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
    }


    public function ubahStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:agendas,id',
            'tipe' => 'required|in:proposal,lpj',
            'status' => 'required|in:1,2',
            'catatan' => 'required|string'
        ]);

        $updateData = [];

        if ($request->tipe === 'proposal') {
            $updateData['status_proposal'] = $request->status;
            $updateData['ket_proposal'] = $request->catatan;
        } else {
            $updateData['status_lpj'] = $request->status;
            $updateData['ket_lpj'] = $request->catatan;
        }

        DB::table('agendas')->where('id', $request->id)->update($updateData);

        return response()->json([
            'message' => ucfirst($request->tipe) . ' berhasil diperbarui!'
        ]);
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MahasiswaImport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        // Ensure the user is authenticated
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'super_admin') {
                // Redirect if role is 'user'
                return redirect('/admin/dashboard'); // or '/home', etc.
            }

            return $next($request);
        });
    }

    public function index()
    {
        $mahasiswas = MahasiswaImport::all();
        // $mahasiswas = array(); // Initialize an empty array
        $user = User::find(Auth::user()->id);
        return view('admin.mahasiswa.index', compact('user', 'mahasiswas'));
    }
    public function create()
    {

        $user = User::find(Auth::user()->id);
        return view('admin.mahasiswa.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
            'data.*.nim' => 'required|string',
            'data.*.nama' => 'required|string',
        ]);

        foreach ($request->input('data') as $item) {
            MahasiswaImport::updateOrCreate(
                ['nim' => $item['nim']],
                [
                    'prodi'    => $item['prodi'] ?? null,
                    'nama'     => $item['nama'] ?? null,
                    'jk'       => $item['jk'] ?? null,
                    'jalur'    => $item['jalur'] ?? null,
                    'semester' => $item['semester'] ?? null,
                    'kelas'    => $item['kelas'] ?? null,
                ]
            );
        }

        return response()->json(['message' => 'Data mahasiswa berhasil disimpan.']);
    }

    public function destroy($id)
    {
        $mahasiswa = MahasiswaImport::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');
    }

}

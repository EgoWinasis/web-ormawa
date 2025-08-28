<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\MahasiswaImport;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nim' => ['required', 'string', 'max:20', 'unique:anggota'],
            'nomor' => ['required', 'string', 'regex:/^(\+62|0)[0-9]{9,13}$/'], // Validasi nomor telepon
        ], [
            // Custom error messages
            'nim.required' => 'Nim harus di isi.',
            'nim.unique' => 'Nim sudah digunakan.',
            'nomor.required' => 'Nomor telepon harus di isi.',
            'nomor.regex' => 'Format nomor telepon tidak valid.',
            'name.required' => 'Nama harus di isi',
            'email.required' => 'Email harus di isi',
            'password.required' => 'Password wajib di isi',
            'password-confirm.required' => 'Konfirmasi password wajib di isi',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Create User
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // 2. Get Mahasiswa data by NIM
            $mahasiswa = DB::table('mahasiswas')->where('nim', $data['nim'])->first();

            // 3. Insert to Anggota
            if ($mahasiswa) {
                $anggotaInserted = DB::table('anggota')->insert([
                    'user_id'  => $user->id,
                    'nim'      => $mahasiswa->nim,
                    'prodi'    => $mahasiswa->prodi,
                    'semester' => $mahasiswa->semester,
                    'nomor'    => $data['nomor']
                ]);

                if (! $anggotaInserted) {
                    // Throw exception to rollback transaction
                    throw new \Exception('Failed to insert into anggota.');
                }
            } else {
                // Mahasiswa not found, rollback
                throw new \Exception('Mahasiswa not found for NIM: ' . $data['nim']);
            }

            return $user;
        });
    }

    //     public function checkNim(Request $request)
    // {
    //     $nim = $request->nim;

    //     // Find MahasiswaImport record by NIM
    //     $user = MahasiswaImport::where('nim', $nim)->first();

    //     if (!$user) {
    //         return response()->json([
    //             'exists' => false,
    //             'message' => 'NIM tidak ditemukan.'
    //         ]);
    //     }

    //     return response()->json([
    //         'exists'   => true,
    //         'message'  => 'NIM ditemukan.',
    //         'nama'     => $user->nama,
    //         'nim'      => $user->nim,
    //         'prodi'    => $user->prodi,
    //         'semester' => $user->semester,
    //         'kelas'    => $user->kelas,
    //         'jk'       => $user->jk,
    //     ]);
    // }

    public function checkNim(Request $request)
    {
        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/mahasiswa', [
            'key' => '53jd4f6e-fl0b-4316-8k52-8361khf56a03',
            'tahun_ajaran' => $request->tahun_angkatan,
            'nim' => $request->nim
        ]);

        return $response->json(); // kirim balik ke frontend
    }
}

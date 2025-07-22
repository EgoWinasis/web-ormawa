<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        'nim' => ['required', 'string', 'max:20', 'unique:users,nim'], // NIM wajib unik
        'prodi' => ['required', 'string', 'max:100'], // Program studi
        'semester' => ['required', 'integer', 'min:1', 'max:14'], // Semester minimal 1 dan maksimal 14
        'nomor' => ['required', 'string', 'regex:/^(\+62|0)[0-9]{9,13}$/'], // Validasi nomor telepon
    ], [
        // Custom error messages
        'nim.required' => 'Nim harus di isi.',
        'nim.unique' => 'Nim sudah digunakan.',
        'prodi.required' => 'Program studi harus di isi.',
        'semester.required' => 'Semester harus di isi.',
        'semester.integer' => 'Semester harus berupa angka.',
        'semester.min' => 'Semester tidak boleh kurang dari 1.',
        'semester.max' => 'Semester tidak boleh lebih dari 14.',
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
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];
    
        // Cek dan masukkan data yang ada (jika tidak null)
        if (isset($data['nim'])) {
            $userData['nim'] = $data['nim'];
        }
        if (isset($data['prodi'])) {
            $userData['prodi'] = $data['prodi'];
        }
        if (isset($data['semester'])) {
            $userData['semester'] = $data['semester'];
        }
        if (isset($data['nomor'])) {
            $userData['nomor'] = $data['nomor'];
        }
    
        return User::create($userData);
    }
}

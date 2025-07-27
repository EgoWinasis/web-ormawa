<?php

use App\Http\Controllers\LandingController;
use App\Models\Admin;
use App\Models\Rutin;
use App\Models\Agenda;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RutinController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('landing');
// });



Route::get('/', [LandingController::class, 'landing'])->name('landing')->middleware('guest');

Auth::routes(['verify' => true]);

//ini adalah route untuk daftar anggota
Route::post('/anggota/store/{userId}', [AnggotaController::class, 'store'])->name('anggota.store');


//ini adalah route untuk dashboard user atau halaman home dari user
Route::get('/home', [HomeController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/history', [HomeController::class, 'history'])->name('user.history')->middleware('auth');
Route::get('/riwayat', [HomeController::class, 'riwayat'])->name('user.riwayat')->middleware('auth');
Route::post('/check-nim', [RegisterController::class, 'checkNim'])->name('check.nim');



// //route untuk Admin disini
// Route::get('/login-admin', [AdminController::class, 'loginAdmin'])->name('admin.login');
// Route::post('/login/admin', [AdminController::class, 'login'])->name('admin.login.post');

// // Pastikan Anda sudah mengamankan dashboard admin dengan middleware auth
// Route::get('/admin', [AdminController::class, 'adminView'])->middleware('auth')->name('adminView');
// Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginAdmin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'adminView'])->name('admin.dashboard');
    Route::get('/news', [AdminController::class, 'news'])->name('admin.news');
    Route::get('/arsip', [AdminController::class, 'arsip'])->name('admin.arsip');
    Route::get('/rutinitas', [AdminController::class, 'rutinitas'])->name('admin.rutinitas');
    Route::get('/pengurus', [AdminController::class, 'absensi'])->name('admin.absensi');
    Route::get('/calon', [AdminController::class, 'calon'])->name('admin.calon');
    Route::get('/wawancara', [AdminController::class, 'wawancara'])->name('admin.wawancara');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    // setting
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::post('/setting/update-brand-image', [SettingController::class, 'updateBrandImage'])->name('admin.setting.updateBrandImage');

    Route::get('/tambahAdminView', [AdminController::class, 'tambahAdminView'])->name('admin.tambahAdminView');
    Route::post('/kegiatan/panitia/{user}/update-jabatan', [AdminController::class, 'updateJabatan']);

    // import data
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/import', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // agenda Routes
    Route::get('/kegiatan/{id}', [AgendaController::class, 'detail'])->middleware('auth:admin');
    // Route::post('/tambah/kegiatan', [AgendaController::class, 'storeKegiatan'])->middleware('auth');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/arsip/create', [AgendaController::class, 'arsipCreate'])->name('arsip.create');
        // Route::get('/arsip', [AgendaController::class, 'arsipIndex'])->name('arsip.index');
    });
    Route::post('/arsip/store', [AgendaController::class, 'arsipStore'])->name('arsip.store');
    Route::post('/kegiatan/{id}/edit', [AgendaController::class, 'arsipUpdate']);
    Route::post('/news/destroy/{id}', [AgendaController::class, 'newsDestroy']);


    // panitia Routes
    Route::post('kegiatan/panitia/{id}', [AnggotaController::class, 'panitiaKegiatan']);
    // {{-- update --}} route satu do bawah, jangan lupa cek bagian view ditambahkan anggota-show.blade.php
    Route::get('total-kegiatan/{id}', [AnggotaController::class, 'show']);
    Route::post('/anggota/store/{id}', [AnggotaController::class, 'tambahAnggota']);
    Route::delete('kegiatan/panitia/{id}/destroy', [AnggotaController::class, 'panitiaDestroy']);
    Route::get('kegiatan/panitia/{id}/view', [AnggotaController::class, 'panitiaView']);
    Route::get('kegiatan/panitia/{id}/wawancara', [AnggotaController::class, 'wawancaraView']);

    // users
    Route::post('user/{id}/edit', [AdminController::class, 'userUpdate'])->name('user.update');
    Route::post('nextSession/{id}', [AdminController::class, 'nextSession'])->name('admin.nextSession');
    Route::post('accept/{id}', [AdminController::class, 'accept'])->name('admin.accept');
    Route::post('reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
    Route::post('rejectWawancara/{id}', [AdminController::class, 'rejectWawancara'])->name('admin.rejectWawancara');
    Route::post('tambah/user', [AdminController::class, 'tambahAdmin'])->name('tambahAdmin');


    // rutinitas
    Route::middleware('auth:admin')->group(function () {
        Route::get('/rutin/create', [RutinController::class, 'rutinCreate'])->name('rutin.create');
        Route::get('/rutin', [RutinController::class, 'rutinIndex'])->name('rutin.index');
    });
    Route::post('rutin/store', [RutinController::class, 'store'])->name('rutin.store');
    Route::get('rutin/update/{id}/view', [RutinController::class, 'edit']);
    Route::post('rutin/update/{id}', [RutinController::class, 'update'])->name('rutin.update');
    Route::delete('rutin/destroy/{id}', [RutinController::class, 'destroy']);
});

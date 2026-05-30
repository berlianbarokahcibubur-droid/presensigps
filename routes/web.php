<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;

/*
|--------------------------------------------------------------------------
| LOGIN KARYAWAN
|--------------------------------------------------------------------------
*/

Route::middleware(['guest:karyawan'])->group(function () {
Route::get('/', function () {
        return view('auth.login');
    })->name('login');

Route::post('/proseslogin', [AuthController::class,'proseslogin']);
});

/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/panel', function () {
    // JIKA ADMIN SUDAH LOGIN
    if (Auth::guard('user')->check()) {
        return redirect('/panel/dashboardadmin');
    }

    // JIKA BELUM LOGIN
    return view('auth.loginadmin');
})->name('loginadmin');

Route::post('/prosesloginadmin', [AuthController::class,'prosesloginadmin']);

/*
|--------------------------------------------------------------------------
| KARYAWAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:karyawan'])->group(function(){
Route::get('/dashboard', [DashboardController::class,'index']);
Route::get('/proseslogout', [AuthController::class,'proseslogout'])->name('proseslogout');
Route::get('/presensi/create', [PresensiController::class,'create']);
Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
Route::get('/presensi/editprofile', [PresensiController::class,'editprofile']);
Route::post('/presensi/{nik}/updateprofile', [PresensiController::class,'updateprofile'])->name('updateprofile');
Route::get('/presensi/histori', [PresensiController::class,'histori']);
Route::post('/gethistori', [PresensiController::class,'gethistori']);
Route::get('/presensi/izin', [PresensiController::class,'izin']);
Route::get('/presensi/buatizin', [PresensiController::class,'buatizin']);
Route::post('/presensi/storeizin', [PresensiController::class,'storeizin']);
        
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:user'])->group(function(){
Route::get('/panel/dashboardadmin', [DashboardController::class,'dashboardadmin']);
Route::get('/proseslogoutadmin', [AuthController::class,'proseslogoutadmin'])->name('proseslogoutadmin');
});

//karyawan
Route::get('/karyawan', [KaryawanController::class,'index']);
Route::POST('/karyawan/store', [KaryawanController::class,'store']);
Route::POST('/karyawan/edit', [KaryawanController::class,'edit']);
Route::POST('/karyawan/{nik}/update', [KaryawanController::class,'update']);
Route::POST('/karyawan/{nik}/delete', [KaryawanController::class,'delete']);

//Departemen
Route::get('/departemen',[DepartemenController::class, 'index']);
Route::post('/departemen/store',[DepartemenController::class, 'store']);
Route::post('/departemen/edit',[DepartemenController::class, 'edit']);
Route::post('/departemen/{kode_dept}/update',[DepartemenController::class, 'update']);
Route::post('/departemen/{kode_dept}/delete',[DepartemenController::class, 'delete']);

//Presensi
Route::get('/presensi/monitoring',[PresensiController::class, 'monitoring']);
Route::post('/getpresensi',[PresensiController::class, 'getpresensi']);
Route::post('/tampilkanpeta',[PresensiController::class, 'tampilkanpeta']);
Route::get('/presensi/laporan',[PresensiController::class, 'laporan']);
Route::post('/presensi/cetaklaporan',[PresensiController::class, 'cetaklaporan']);
Route::get('/presensi/rekap',[PresensiController::class, 'rekap']);
Route::post('/presensi/cetakrekap',[PresensiController::class, 'cetakrekap']);
Route::get('/presensi/izinsakit',[PresensiController::class, 'izinsakit']);
Route::post('/presensi/approveizinsakit',[PresensiController::class, 'approveizinsakit']);
Route::post('/presensi/{id}/batalkanizinsakit',[PresensiController::class, 'batalkanizinsakit']);
Route::post('/presensi/cekpengajuanizin',[PresensiController::class, 'cekpengajuanizin']);

//Konfigurasi
Route::get('/konfigurasi/lokasikantor',[KonfigurasiController::class, 'lokasikantor']);
Route::post('/konfigurasi/updatelokasikantor',[KonfigurasiController::class, 'updatelokasikantor']);


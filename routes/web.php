<?php

use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenyewaanAlatController;
use App\Http\Controllers\PenyewaanController;

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

Route::get('/', [PenyewaanAlatController::class, 'main']);

Route::group(['middleware' => 'cekrole:Pelanggan'], function() {
    Route::get('/profile', [RegisterController::class, 'index']);
    Route::get('/sewa-alat', [PenyewaanAlatController::class, 'index']);
    Route::get('/sewa-alat/{id}', [PenyewaanAlatController::class, 'edit']);
    Route::post('/sewa-alat', [PenyewaanAlatController::class, 'store']);
    Route::get('/batalkan-sewa-alat/{id}', [PenyewaanAlatController::class, 'cancel_sewa']);
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'edit']);
    Route::put('/upload-bukti-pembayaran/{id}', [PembayaranController::class, 'update']);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::group(['middleware' => 'cekrole:Admin'], function() {
    Route::resource('/data-staff', StaffController::class)->names('data-staff');
    Route::resource('/data-karyawan', KaryawanController::class)->names('data-karyawan');
    Route::resource('/data-alat', AlatController::class)->names('data-alat');
    Route::put('/update-status/{id}', [PembayaranController::class, 'update_status']);
    Route::resource('/data-pengembalian', PengembalianController::class)->names('data-pengembalian');
    Route::resource('/denda', DendaController::class)->names('denda');
});

Route::group(['middleware' => 'cekrole:Bendahara'], function() {
     Route::resource('/data-penyewaan', PenyewaanController::class)->names('data-penyewaan');
});

Route::group(['middleware' => 'cekrole:Admin,Bendahara'], function() {
    Route::get('/dashboard', [LoginController::class, 'dashboard']);
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanBarangController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Halaman Autentikasi
|--------------------------------------------------------------------------
*/

Route::get('/login', fn() => view('login'));
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::post('/register', [UserController::class, 'register'])->name('register');

/*
|--------------------------------------------------------------------------
| Halaman Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->get('/', [BarangController::class, 'home'])->name('home');
Route::middleware(['auth', 'role:kepala'])->get('/kepala', fn() => view('kepala'))->name('kepala');
Route::middleware(['auth', 'role:admin'])->get('/homeadmin', function () {
    return view('homeadmin')->with('users', User::all());
})->name('homeadmin');

Route::post('/barangjadi/{kode_barang}/tambah-stok', [BarangController::class, 'tambahStok'])->name('barangjadi.tambahstok');
Route::post('/barangjadi', [BarangController::class, 'inventory'])->name('barangjadi.inventory');

// daftarbarang //
Route::get('/daftarbarang', [BarangController::class, 'daftarbarang'])->name('daftarbarang');
Route::get('/daftarbarangbuat', [BarangController::class, 'daftarbarangbuat'])->name('daftarbarangbuat');
Route::get('/daftarbarang/create', [BarangController::class, 'create'])->name('barang.create');
Route::delete('/daftarbarang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::delete('/histori/{id}', [BarangController::class, 'destroyHistori'])->name('histori.destroy');
/*
|--------------------------------------------------------------------------
| Home Barang Jadi
|--------------------------------------------------------------------------
*/
Route::get('/homebarangjadi', [BarangController::class, 'tampilkanbarang'])->name('homebarangjadi');
Route::post('/homebarangjadi/tambah', [BarangController::class, 'tambahbarang'])->name('homebarangjadi.tambah');
Route::get('/homebarangjadi/{kode_barang}/hapus', [BarangController::class, 'hapus'])->name('homebarangjadi.hapus');
Route::get('/jadi', [BarangController::class, 'tampilkanbarangsearch'])->name('jadi');
Route::put('/homebarangjadi/updateStok', [BarangController::class, 'updateBarangJadi'])->name('homebarangjadi.updateStok');
// Route::post('/barangjadi/tambah', [BarangController::class, 'tambahBarangJadi'])->name('barangjadi.tambah');
// Route::put('/barangjadi/{kode_barang}', [BarangController::class, 'update'])->name('barangjadi.update');

/*
|--------------------------------------------------------------------------
| Barang Mentah & Jadi
|--------------------------------------------------------------------------
*/
Route::get('/barang-mentah', [BarangController::class, 'barangmentah'])->name('barang.mentah');
Route::get('/tambahbarang', fn() => view('tambahbarang'))->name('tambahbarang');

Route::delete('/barangjadi/{id}', [BarangController::class, 'destroy'])->name('barangjadi.destroy');
/*
|--------------------------------------------------------------------------
| Laporan Barang
|--------------------------------------------------------------------------
*/
Route::get('/laporanbarang', fn() => view('laporanbarang'))->name('laporanbarang');
Route::get('/laporan-barang', [LaporanBarangController::class, 'datepicker'])->name('laporanbarang.datepicker');

// API routes (commented out)
// Route::get('/api/barang', [BarangController::class, 'apiGetAllBarang']);
// Route::get('/api/barang/{kode_barang}', [BarangController::class, 'apiGetBarangByKode']);
// Route::put('/api/barang/{kode_barang}/stok', [BarangController::class, 'apiUpdateStok']);

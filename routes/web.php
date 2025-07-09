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

// stokbarang //
Route::get('/stokbarang', [BarangController::class, 'stokbarang'])->name('stokbarang');
Route::get('/stokbarang/create', [BarangController::class, 'create'])->name('barang.create');
Route::get('/stokbarang/{id}/edit', [BarangController::class, 'editNamaBarang'])->name('barang.updateNama');
Route::put('/stokbarang/{id}', [BarangController::class, 'updateNamaBarang'])->name('stokbarang.update');
Route::delete('/histori/{id}', [BarangController::class, 'destroyHistori'])->name('histori.destroy');

Route::get('/stokopname', [BarangController::class, 'stokopname'])->name('stokopname');
Route::post('/stokopname/tambah', [BarangController::class, 'tambahStokOpname'])->name('stokopname.tambah');
Route::put('/stokopname/{id}/update', [BarangController::class, 'updateStokOpname'])->name('stokopname.update');
Route::get('/stokopname/{id}/hapus', [BarangController::class, 'hapusStokOpname'])->name('stokopname.hapus');

// Master Barang
Route::get('/masterbarang', [BarangController::class, 'masterbarang'])->name('masterbarang');
Route::post('/masterbarang/tambahbaru', [BarangController::class, 'tambahbarang'])->name('masterbarang.tambahbaru');
Route::post('/masterbarang/store', [BarangController::class, 'storeMaster'])->name('masterbarang.store');
Route::get('/masterbarang/{id}/edit', [BarangController::class, 'editMaster'])->name('masterbarang.edit');
Route::put('/masterbarang/{id}', [BarangController::class, 'updateMaster'])->name('masterbarang.update');
Route::delete('/masterbarang/{id}', [BarangController::class, 'destroyMaster'])->name('masterbarang.destroy');
/*
|--------------------------------------------------------------------------
| Home Barang Masuk
|--------------------------------------------------------------------------
*/
Route::get('/homebarangmasuk', [BarangController::class, 'tampilkanbarang'])->name('homebarangmasuk');
Route::post('/homebarangmasuk/tambah', [BarangController::class, 'tambahbarang'])->name('homebarangmasuk.tambah');
Route::get('/homebarangmasuk/{kode_barang}/hapus', [BarangController::class, 'hapus'])->name('homebarangmasuk.hapus');
Route::get('/jadi', [BarangController::class, 'tampilkanbarangsearch'])->name('jadi');
Route::put('/homebarangmasuk/updateStok', [BarangController::class, 'updateBarangJadi'])->name('homebarangmasuk.updateStok');
// Route::post('/barangjadi/tambah', [BarangController::class, 'tambahBarangJadi'])->name('barangjadi.tambah');
// Route::put('/barangjadi/{kode_barang}', [BarangController::class, 'update'])->name('barangjadi.update');

/*
|--------------------------------------------------------------------------
| Home Barang Keluar
|--------------------------------------------------------------------------
*/
Route::get('/homebarangkeluar', [BarangController::class, 'homebarangkeluar'])->name('homebarangkeluar');
Route::post('/homebarangkeluar/tambah', [BarangController::class, 'tambahBarangKeluar'])->name('homebarangkeluar.tambah');
Route::delete('/homebarangkeluar/{id}/hapus', [BarangController::class, 'hapusBarangKeluar'])->name('homebarangkeluar.hapus');

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

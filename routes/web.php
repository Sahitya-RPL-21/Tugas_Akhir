<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Models\User;
use App\Http\Controllers\LaporanBarangController;

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
Route::post('/homebarangmasuk/tambah', [BarangController::class, 'tambahBarangMasuk'])->name('homebarangmasuk.tambah');
Route::get('/homebarangmasuk/{kode_barang}/hapus', [BarangController::class, 'hapus'])->name('homebarangmasuk.hapus');
Route::get('/jadi', [BarangController::class, 'tampilkanbarangsearch'])->name('jadi');
Route::put('/homebarangmasuk/updateStok', [BarangController::class, 'updateBarangJadi'])->name('homebarangmasuk.updateStok');


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
Route::get('/barangmentahmasuk', [BarangController::class, 'barangmentahmasuk'])->name('barangmentahmasuk');
Route::get('/barangmentah/tambah', [BarangController::class, 'barangMentahTambah'])->name('barangmentah.tambahmasuk');
Route::post('/barangmentah/tambah', [BarangController::class, 'tambahBarangMentah'])->name('barangmentah.tambah');

Route::get('/barangmentahkeluar', [BarangController::class, 'barangmentahkeluar'])->name('barangmentahkeluar');
Route::post('/barangmentahkeluar/tambah', [BarangController::class, 'tambahBarangMentahKeluar'])->name('barangmentah.tambahkeluar');

Route::delete('/barangjadi/{id}', [BarangController::class, 'destroy'])->name('barangjadi.destroy');
/*
|--------------------------------------------------------------------------
| Laporan Barang
|--------------------------------------------------------------------------
*/
Route::get('/laporanbarang', [LaporanBarangController::class, 'laporanBarang'])->name('laporanbarang');
Route::get('/laporan-barang', [LaporanBarangController::class, 'datepicker'])->name('laporanbarang.datepicker');
Route::get('/laporan-barang/cetak', [LaporanBarangController::class, 'cetak'])->name('laporanbarang.cetak');

/*route halaman stok barang kepala*/
Route::get('/stokbarangkepala', [BarangController::class, 'stokBarangKepala'])->name('stokbarangkepala');


Route::post('/tambahpengguna', [UserController::class, 'tambahpenggunamodal'])->name('tambahpenggunamodal');
Route::put('/users/{id}', [UserController::class, 'updateAkunPengguna'])->name('user.update');
Route::delete('/users/{id}', [UserController::class, 'hapusAkunPengguna'])->name('user.destroy');

// // API routes (commented out)
// Route::get('/api/barang', [BarangController::class, 'apiGetAllBarang']);
// Route::get('/api/barang/{kode_barang}', [BarangController::class, 'apiGetBarangByKode']);
// Route::put('/api/barang/{kode_barang}/stok', [BarangController::class, 'apiUpdateStok']);

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
| Rute untuk login, logout, dan register. Dapat diakses oleh semua.
*/

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::post('/register', [UserController::class, 'register'])->name('register');


/*
|--------------------------------------------------------------------------
| Rute yang Membutuhkan Autentikasi
|--------------------------------------------------------------------------
| Grup rute ini hanya bisa diakses setelah pengguna login.
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Halaman Dashboard Utama Berdasarkan Peran (Role)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:user')->get('/', [BarangController::class, 'home'])->name('home');
    Route::middleware('role:kepala')->get('/kepala', fn() => view('kepala'))->name('kepala');
    Route::middleware('role:admin')->get('/homeadmin', function () {
        return view('homeadmin')->with('users', User::all());
    })->name('homeadmin');


    /*
    |--------------------------------------------------------------------------
    | Pengelolaan Master & Stok Barang
    |--------------------------------------------------------------------------
    */
    // Master Barang
    Route::get('/masterbarang', [BarangController::class, 'masterbarang'])->name('masterbarang');
    Route::post('/masterbarang/store', [BarangController::class, 'tambahbarang'])->name('masterbarang.store');
    Route::get('/masterbarang/{id}/edit', [BarangController::class, 'editMaster'])->name('masterbarang.edit');
    Route::put('/masterbarang/{id}', [BarangController::class, 'updateMaster'])->name('masterbarang.update');
    Route::delete('/masterbarang/{id}', [BarangController::class, 'destroyMaster'])->name('masterbarang.destroy');

    // Stok Barang & Stok Opname
    Route::get('/stokbarang', [BarangController::class, 'stokbarang'])->name('stokbarang');
    Route::put('/stokbarang/{id}', [BarangController::class, 'updateNamaBarang'])->name('stokbarang.update');
    Route::get('/stokopname', [BarangController::class, 'stokopname'])->name('stokopname');
    Route::post('/stokopname/tambah', [BarangController::class, 'tambahStokOpname'])->name('stokopname.tambah');
    Route::put('/stokopname/{id}/update', [BarangController::class, 'updateStokOpname'])->name('stokopname.update');
    Route::get('/stokopname/{id}/hapus', [BarangController::class, 'hapusStokOpname'])->name('stokopname.hapus');


    /*
    |--------------------------------------------------------------------------
    | Transaksi Barang Mentah
    |--------------------------------------------------------------------------
    */
    // Barang Mentah Masuk
    Route::get('/barangmentahmasuk', [BarangController::class, 'barangmentahmasuk'])->name('barangmentahmasuk');
    Route::post('/barangmentah/tambah', [BarangController::class, 'tambahBarangMentah'])->name('barangmentah.tambah');
    Route::delete('/histori/{id}', [BarangController::class, 'destroyHistori'])->name('histori.destroy'); // Hapus histori barang MASUK

    // Barang Mentah Keluar
    Route::get('/barangmentahkeluar', [BarangController::class, 'barangmentahkeluar'])->name('barangmentahkeluar');
    Route::post('/barangmentahkeluar/tambah', [BarangController::class, 'tambahBarangMentahKeluar'])->name('barangmentah.tambahkeluar');
    Route::delete('/barangmentahkeluar/{id}', [BarangController::class, 'destroyBarangKeluar'])->name('barangmentahkeluar.destroy'); // <-- ROUTE BARU UNTUK HAPUS BARANG KELUAR


    /*
    |--------------------------------------------------------------------------
    | Transaksi Barang Jadi (Home)
    |--------------------------------------------------------------------------
    */
    // Barang Jadi Masuk
    Route::get('/jadi', [BarangController::class, 'tampilkanbarangsearch'])->name('jadi');
    Route::get('/homebarangmasuk', [BarangController::class, 'tampilkanbarang'])->name('homebarangmasuk');
    Route::post('/homebarangmasuk/tambah', [BarangController::class, 'tambahBarangMasuk'])->name('homebarangmasuk.tambah');
    Route::put('/homebarangmasuk/updateStok', [BarangController::class, 'updateBarangJadi'])->name('homebarangmasuk.updateStok');
    Route::get('/homebarangmasuk/{kode_barang}/hapus', [BarangController::class, 'hapus'])->name('homebarangmasuk.hapus');

    // Barang Jadi Keluar
    Route::get('/homebarangkeluar', [BarangController::class, 'homebarangkeluar'])->name('homebarangkeluar');
    Route::post('/homebarangkeluar/tambah', [BarangController::class, 'tambahBarangKeluar'])->name('homebarangkeluar.tambah');
    Route::delete('/homebarangkeluar/{id}/hapus', [BarangController::class, 'hapusBarangKeluar'])->name('homebarangkeluar.hapus');


    /*
    |--------------------------------------------------------------------------
    | Laporan & Halaman Khusus Kepala
    |--------------------------------------------------------------------------
    */
    Route::get('/laporanbarang', [LaporanBarangController::class, 'laporanBarang'])->name('laporanbarang');
    Route::get('/laporan-barang/cetak', [LaporanBarangController::class, 'cetak'])->name('laporanbarang.cetak');
    Route::get('/stokbarangkepala', [BarangController::class, 'stokBarangKepala'])->name('stokbarangkepala');


    /*
    |--------------------------------------------------------------------------
    | Pengelolaan Pengguna (Khusus Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::post('/tambahpengguna', [UserController::class, 'tambahpenggunamodal'])->name('tambahpenggunamodal');
        Route::put('/users/{id}', [UserController::class, 'updateAkunPengguna'])->name('user.update');
        Route::delete('/users/{id}', [UserController::class, 'hapusAkunPengguna'])->name('user.destroy');
    });
});

// Rute-rute lama yang mungkin tidak terpakai atau duplikat.
// Sebaiknya diperiksa kembali dan dihapus jika tidak diperlukan.
// Route::post('/masterbarang/tambahbaru', [BarangController::class, 'tambahbarang'])->name('masterbarang.tambahbaru');
// Route::get('/stokbarang/create', [BarangController::class, 'create'])->name('barang.create');
// Route::get('/stokbarang/{id}/edit', [BarangController::class, 'editNamaBarang'])->name('barang.updateNama');
// Route::get('/laporan-barang', [LaporanBarangController::class, 'datepicker'])->name('laporanbarang.datepicker');

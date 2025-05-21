<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CommentController;
use App\Models\Comment;

/*
|--------------------------------------------------------------------------
| Halaman Autentikasi
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Halaman Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
});
Route::get('/homeadmin', function () {
    return view('homeadmin');
})->name('homeadmin');
Route::get('/kepala', function () {
    return view('kepala');
})->name('kepala');




// Daftar Barang
Route::get('/daftarbarang', [BarangController::class, 'tampilkanbarang'])->name('daftarbarang');
Route::post('/daftarbarang/tambah', [BarangController::class, 'tambahbarang'])->name('daftarbarang.tambah');
Route::get('/daftarbarang/{kode_barang}/hapus', [BarangController::class, 'hapus'])->name('daftarbarang.hapus');


// Barang Mentah & Jadi
Route::get('/barang-mentah', [BarangController::class, 'barangmentah'])->name('barang.mentah');
Route::get('/barangjadi', function () {
    return view('barangjadi');
})->name('barangjadi');
Route::get('/tambahbarang', function () {
    return view('tambahbarang');
})->name('tambahbarang');
/*
|--------------------------------------------------------------------------


/*laporan barang*/
Route::get('/laporanbarang', function () {
    return view('laporanbarang');
})->name('laporanbarang');
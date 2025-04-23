<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/', function () {
    return view('home');
});

Route::get('/tambahbarang', function () {
    return view('tambahbarang');
})->name('tambahbarang');

Route::get('/daftarbarang', function () {
    return view('daftarbarang');
})->name('daftarbarang');

Route::post('/daftarbarang/tambah', [UserController::class, 'tambahBarang'])->name('daftarbarang.tambah');

Route::get('/laporanbarang', function () {
    return view('laporanbarang');
})->name('laporanbarang');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/barang', [BarangController::class, 'apiGetAllBarang']);
Route::get('/barang/mentah', [BarangController::class, 'apiGetBarangMentah']);
Route::get('/barang-masuk', [BarangController::class, 'getBarangMasukApi']);
// Route::get('/barang-masuk-dummy', [BarangController::class, 'getBarangMasukDummy']);
Route::get('/barang/{kode_barang}', [BarangController::class, 'apiGetBarangByKode']);
Route::put('/barang/{kode_barang}/stok', [BarangController::class, 'apiUpdateStok']);

// Route untuk pengajuan pengadaan barang mentah
Route::get('/pengajuanbarangmentah', [BarangController::class, 'apipengajuanBarangMentah']);

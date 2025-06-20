<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/barang', [BarangController::class, 'apiGetAllBarang']);
Route::get('/barang/{kode_barang}', [BarangController::class, 'apiGetBarangByKode']);
Route::put('/barang/{kode_barang}/stok', [BarangController::class, 'apiUpdateStok']);

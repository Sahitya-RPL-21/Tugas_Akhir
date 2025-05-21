<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekBarangController extends Controller
{
    public function cekStok()
    {
        return view('daftarbarang');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // menambah data barang
    public function tambahbarang(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'stok_barang' => 'required|integer',
            'status_barang' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        BarangModel::create($request->all());

        return redirect()->route('daftarbarang')->with('success', 'Barang berhasil ditambahkan');
    }

    // menampilkan data barang
    public function tampilkanbarang()
    {
        // $halaman = session('halaman', 15);
        $databarang = BarangModel::paginate(15);
        return view('daftarbarang', ['barang' => $databarang]);
    }


    public function hapus($kode_barang)
    {
        $barang = BarangModel::findOrFail($kode_barang);
        $barang->delete();

        return redirect()->route('daftarbarang')->with('success', 'Barang berhasil dihapus');
    }

    function barangmentah()
    {
        $databarang = BarangModel::paginate(15);
        return view('daftarbarang', ['tipe' => 'mentah', 'barang' => $databarang]);
    }
}

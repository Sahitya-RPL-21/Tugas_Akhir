<?php

use App\Models\BarangModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import the PDF facade
use Illuminate\Routing\Controller as BaseController;

class LaporanBarangController extends BaseController
{
    public function laporanBarang(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $jenis_transaksi = $request->input('jenis_transaksi');

        $barang = BarangModel::query();

        if ($start && $end) {
            $barang->whereBetween('created_at', [$start, $end]);
        }

        if ($jenis_transaksi) {
            if ($jenis_transaksi == 'masuk') {
                $barang->where('jenis_transaksi', 'masuk');
            } elseif ($jenis_transaksi == 'keluar') {
                $barang->where('jenis_transaksi', 'keluar');
            }
        }

        $barang = $barang->get();

        return view('laporanbarang', compact('barang'));
    }

    public function cetak(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $jenis_transaksi = $request->input('jenis_transaksi');

        $barang = BarangModel::query();

        if ($start && $end) {
            $barang->whereBetween('created_at', [$start, $end]);
        }

        if ($jenis_transaksi) {
            if ($jenis_transaksi == 'masuk') {
                $barang->where('jenis_transaksi', 'masuk');
            } elseif ($jenis_transaksi == 'keluar') {
                $barang->where('jenis_transaksi', 'keluar');
            }
        }

        $barang = $barang->get();

        $pdf = Pdf::loadView('cetak', compact('barang', 'start', 'end', 'jenis_transaksi'));

        return $pdf->download('laporan_barang.pdf');
    }
}

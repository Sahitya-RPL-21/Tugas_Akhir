<?php

namespace App\Http\Controllers;

use App\Models\Masuk;
use App\Models\Keluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class LaporanBarangController extends BaseController
{
    /**
     * Menampilkan halaman laporan dan memfilter data transaksi.
     */
    public function laporanBarang(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $jenis_transaksi = $request->input('jenis_transaksi');

        // Query dasar untuk barang masuk dengan join ke tabel master barang
        $masukQuery = Masuk::query()
            ->join('barang', 'masuk.barang_id', '=', 'barang.id')
            ->select(
                'barang.kode_barang',
                'barang.nama_barang',
                'barang.stok_barang',      // <-- MENAMBAHKAN STOK
                'barang.unit_barang',      // <-- MENAMBAHKAN UNIT
                'masuk.jumlah_masuk as jumlah',
                DB::raw("'masuk' as jenis_transaksi"),
                'masuk.created_at'
            );

        // Query dasar untuk barang keluar yang akan digabung (union)
        $query = Keluar::query()
            ->join('barang', 'keluar.barang_id', '=', 'barang.id')
            ->select(
                'barang.kode_barang',
                'barang.nama_barang',
                'barang.stok_barang',      // <-- MENAMBAHKAN STOK
                'barang.unit_barang',      // <-- MENAMBAHKAN UNIT
                'keluar.jumlah_keluar as jumlah',
                DB::raw("'keluar' as jenis_transaksi"),
                'keluar.created_at'
            )
            ->unionAll($masukQuery);

        // Buat subquery dari hasil union untuk bisa di-filter dan di-order
        $subQuery = DB::query()->fromSub($query, 'transactions');

        if ($start && $end) {
            $endDate = date('Y-m-d', strtotime($end . ' +1 day'));
            $subQuery->whereBetween('created_at', [$start, $endDate]);
        }

        if ($jenis_transaksi) {
            $subQuery->where('jenis_transaksi', $jenis_transaksi);
        }

        $barang = $subQuery->orderBy('created_at', 'asc')->get();

        return view('laporanbarang', compact('barang'));
    }

    /**
     * Membuat dan mengunduh laporan dalam format PDF.
     */
    public function cetak(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $jenis_transaksi = $request->input('jenis_transaksi');

        // Query yang sama persis dengan di atas untuk konsistensi data
        $masukQuery = Masuk::query()
            ->join('barang', 'masuk.barang_id', '=', 'barang.id')
            ->select(
                'barang.kode_barang',
                'barang.nama_barang',
                'barang.stok_barang',      // <-- MENAMBAHKAN STOK
                'barang.unit_barang',      // <-- MENAMBAHKAN UNIT
                'masuk.jumlah_masuk as jumlah',
                DB::raw("'masuk' as jenis_transaksi"),
                'masuk.created_at'
            );

        $query = Keluar::query()
            ->join('barang', 'keluar.barang_id', '=', 'barang.id')
            ->select(
                'barang.kode_barang',
                'barang.nama_barang',
                'barang.stok_barang',      // <-- MENAMBAHKAN STOK
                'barang.unit_barang',      // <-- MENAMBAHKAN UNIT
                'keluar.jumlah_keluar as jumlah',
                DB::raw("'keluar' as jenis_transaksi"),
                'keluar.created_at'
            )
            ->unionAll($masukQuery);

        $subQuery = DB::query()->fromSub($query, 'transactions');

        if ($start && $end) {
            $endDate = date('Y-m-d', strtotime($end . ' +1 day'));
            $subQuery->whereBetween('created_at', [$start, $endDate]);
        }

        if ($jenis_transaksi) {
            $subQuery->where('jenis_transaksi', $jenis_transaksi);
        }

        $barang = $subQuery->orderBy('created_at', 'asc')->get();

        // Pastikan view 'laporanbarangcetak' ada
        $pdf = Pdf::loadView('laporanbarangcetak', compact('barang', 'start', 'end', 'jenis_transaksi'));

        return $pdf->download('laporan_barang.pdf');
    }

    /**
     * Metode untuk route datepicker, mengarah ke fungsi utama.
     */
    public function datepicker(Request $request)
    {
        return $this->laporanBarang($request);
    }
}

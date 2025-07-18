<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokOpname;
use App\Models\Masuk;
use App\Models\Keluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function home()
    {
        return view('home', ['barang' => BarangModel::all()]);
    }

    // Menampilkan halaman daftar barang
    public function stokbarang()
    {
        $barang = BarangModel::all();
        return view('stokbarang', compact('barang'));
    }

    public function editNamaBarang($id)
    {
        $barang = BarangModel::findOrFail($id);
        return view('stokbarang', compact('barang'));
    }


    public function tampilkanbarangsearch(Request $request)
    {
        $query = \App\Models\BarangModel::query();

        // Jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        $barang = $query->paginate(15);

        return view('homebarangmasuk', compact('barang'));
    }

    public function inventory(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok_barang' => 'required|integer|min:0',
        ]);

        // Cari barang berdasarkan kode_barang
        $barang = BarangModel::where('nama_barang', $request->nama_barang)->first();

        if ($barang) {
            // Jika barang sudah ada, update stok
            $barang->stok_barang += $request->stok_barang;
            $barang->save();
            return redirect()->route('homebarangmasuk')->with('success', 'Stok barang berhasil ditambahkan!');
        } else {
            // Jika barang belum ada, tampilkan error
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
    }

    public function barangjadi()
    {
        $barang = BarangModel::where('tipe', 'jadi')->get();
        return view('barangjadi', compact('barang'));
    }

    // menambah data barang baru
    public function tambahbarang(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stok_barang' => 'required|integer|min:0',
            'kategori_barang' => 'required',
            'unit_barang' => 'required',
        ]);

        // Cek apakah barang sudah ada
        $barang = BarangModel::where('kode_barang', $request->kode_barang)->first();

        if ($barang) {
            // Jika barang sudah ada, update stok dan catat histori masuk
            $barang->stok_barang += $request->stok_barang;
            $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barang->save();
            Masuk::create([
                'barang_id' => $barang->kode_barang,
                'jumlah_masuk' => $request->stok_barang,
            ]);
            return redirect()->route('homebarangmasuk')->with('success', 'Stok barang berhasil ditambahkan!');
        } else {
            // Jika barang belum ada, buat baru lalu catat histori masuk
            $data = $request->all();
            $data['tipe'] = 'mentah';
            $data['status_barang'] = $request->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barangBaru = BarangModel::create($data);
            Masuk::create([
                'barang_id' => $barangBaru->kode_barang,
                'jumlah_masuk' => $request->stok_barang,
            ]);
            return redirect()->route('homebarangmasuk')->with('success', 'Barang berhasil ditambahkan');
        }
    }

    // Controller untuk menambah barang jadi
    public function tambahBarangJadi(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'unit_barang' => 'required',
            'stok_barang' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['tipe'] = 'jadi';  // Set tipe sebagai barang jadi
        $data['status_barang'] = $request->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';

        BarangModel::create($data);

        return redirect()->route('homebarangmasuk')->with('success', 'Barang jadi berhasil ditambahkan');
    }

    public function updateBarangJadi(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|exists:barang,kode_barang',
            'stok_barang' => 'required|integer|min:0',
        ]);

        // Update stok barang jadi
        $barangJadi = BarangModel::where('kode_barang', $request->input('kode_barang'))
            ->where('tipe', 'jadi')
            ->first();

        if ($barangJadi) {
            $barangJadi->stok_barang += $request->input('stok_barang');
            $barangJadi->status_barang = $barangJadi->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barangJadi->save();
        }

        return redirect()->route('homebarangmasuk')->with('success', 'Stok barang jadi & mentah berhasil diperbarui.');
    }


    public function update(Request $request, $kode_barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_barang' => 'required|string|max:255',
            'unit_barang' => 'required|string|max:255',
        ]);

        $barang = BarangModel::where('kode_barang', $kode_barang)->firstOrFail();

        $barang->nama_barang = $request->input('nama_barang');
        $barang->kategori_barang = $request->input('kategori_barang');
        $barang->unit_barang = $request->input('unit_barang');
        // Jika ada kolom lain yang ingin diedit, tambahkan di sini
        $barang->save();

        return redirect()->route('homebarangmasuk')->with('success', 'Informasi barang berhasil diperbarui!');
    }

    public function tampilkantambahbarangjadi()
    {
        $barang = BarangModel::select('nama_barang', 'stok_barang')->get();
        return view('homebarangmasuk', compact('barang'));
    }

    // menampilkan data barang
    public function tampilkanbarang(Request $request = null)
    {
        // $halaman = session('halaman', 15);
        $databarang = BarangModel::paginate(15);
        $histori = \App\Models\Masuk::with('barang')->orderBy('created_at', 'desc')->get();
        return view('homebarangmasuk', ['barang' => $databarang, 'histori' => $histori]);
    }

    public function hapus($kode_barang)
    {
        $barang = BarangModel::findOrFail($kode_barang);
        $barang->delete();

        return redirect()->route('homebarangmasuk')->with('success', 'Barang berhasil dihapus');
    }

    public function destroy($kode_barang)
    {
        $barang = BarangModel::findOrFail($kode_barang);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }


    // Menampilkan halaman stok opname
    public function stokopname(Request $request = null)
    {
        // Ambil data stok opname, join ke barang jika perlu
        $stokopname = StokOpname::with('barang')->paginate(15);
        $barang = BarangModel::all();
        return view('stokopname', ['stokopname' => $stokopname, 'barang' => $barang]);
    }

    // Proses update stok dari stok opname
    public function updatestokopname(Request $request)
    {
        $request->validate([
            'stok_fisik' => 'required|array',
            'stok.*' => 'required|integer|min:0',
        ]);

        foreach ($request->stok as $kode_barang => $stok_baru) {
            $barang = BarangModel::where('kode_barang', $kode_barang)->first();
            if ($barang) {
                $barang->stok_barang = $stok_baru;
                $barang->status_barang = $stok_baru > 0 ? 'Tersedia' : 'Tidak Tersedia';
                $barang->save();
            }
        }

        return redirect()->route('stokopname')->with('success', 'Stok opname berhasil diperbarui.');
    }

    public function tambahStokOpname(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barang,kode_barang',
            'stok_fisik' => 'required|integer|min:0',
            'keterangan' => 'required'
        ]);

        $barang = BarangModel::where('kode_barang', $request->kode_barang)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Simpan data stok opname
        StokOpname::create([
            'kode_barang' => $barang->kode_barang,
            'stok_awal' => $barang->stok_barang,
            'stok_fisik' => $request->stok_fisik,
            'selisih_barang' => $request->stok_fisik - $barang->stok_barang,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id,
        ]);

        $barang->stok_barang = $request->stok_fisik;
        $barang->save();

        return redirect()->route('stokopname')->with('success', 'Stok opname berhasil ditambahkan dan stok barang diperbarui.');
    }

    public function masterbarang()
    {
        $barang = \App\Models\BarangModel::all();
        return view('masterbarang', compact('barang'));
    }

    public function homebarangmasuk(Request $request = null)
    {
        // Ambil histori barang masuk terbaru
        $databarang = BarangModel::paginate(15);
        $histori = Masuk::with('barang')->orderBy('created_at', 'desc')->get();
        return view('homebarangmasuk', ['barang' => $databarang, 'histori' => $histori]);
    }

    public function destroyHistori($id)
    {
        $histori = Masuk::findOrFail($id);
        // Kurangi stok barang sesuai histori yang dihapus
        $barang = \App\Models\BarangModel::where('kode_barang', $histori->barang_id)->first();
        if ($barang) {
            $barang->stok_barang -= $histori->jumlah_masuk;
            if ($barang->stok_barang < 0) {
                $barang->stok_barang = 0;
            }
            $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barang->save();
        }
        $histori->delete();
        return redirect()->route('homebarangmasuk')->with('success', 'Histori barang masuk berhasil dihapus dan stok barang diperbarui.');
    }

    public function apiGetAllBarang()
    {
        $barang = BarangModel::all();
        return response()->json([
            'status' => 'success',
            'data' => $barang
        ]);
    }

    // API untuk menampilkan data barang berdasarkan kode
    public function apiGetBarangByKode($kode_barang)
    {
        $barang = BarangModel::find($kode_barang);

        if (!$barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $barang
        ]);
    }

    public function homebarangkeluar(Request $request = null)
    {
        $databarang = BarangModel::paginate(15);
        // Jika ada histori barang keluar, ambil di sini (misal model Keluar)
        $histori = Keluar::with('barang')->orderBy('created_at', 'desc')->get();
        return view('homebarangkeluar', ['barang' => $databarang, 'historiKeluar' => $histori]);
    }
    public function tambahBarangKeluar(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|exists:barang,kode_barang',
            'jumlah_keluar' => 'required|integer|min:1',
        ]);

        // Cari barang berdasarkan kode_barang
        $barang = BarangModel::where('kode_barang', $request->kode_barang)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        if ($barang->stok_barang < $request->jumlah_keluar) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Catat histori barang keluar
        Keluar::create([
            'barang_id' => $request->kode_barang,
            'jumlah_keluar' => (int) $request->jumlah_keluar, // pastikan integer dan tidak null
        ]);

        // Kurangi stok barang
        $barang->stok_barang -= $request->jumlah_keluar;
        $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $barang->save();

        return redirect()->route('homebarangkeluar')->with('success', 'Barang keluar berhasil dicatat dan stok diperbarui.');
    }

    public function hapusBarangKeluar($id)
    {
        $histori = Keluar::findOrFail($id);
        // Kembalikan stok barang jika histori dihapus
        $barang = BarangModel::where('kode_barang', $histori->barang_id)->first();
        if ($barang) {
            $barang->stok_barang += $histori->jumlah_keluar;
            $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barang->save();
        }
        $histori->delete();
        return redirect()->route('homebarangkeluar')->with('success', 'Histori barang keluar berhasil dihapus dan stok barang dikembalikan.');
    }



    // API untuk update stok barang
    public function apiUpdateStok(Request $request, $kode_barang)
    {
        $request->validate([
            'qty' => 'required|integer|min:0',
            'operation' => 'required|in:tambah,kurangi'
        ]);

        $barang = BarangModel::find($kode_barang);

        if (!$barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        if ($request->operation === 'kurangi') {
            $barang->stok_barang = max(0, $barang->stok_barang - $request->qty);
        } else if ($request->operation === 'tambah') {
            $barang->stok_barang += $request->qty;
        }

        $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $barang->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Stok barang berhasil diupdate',
            'data' => $barang
        ]);
    }
}

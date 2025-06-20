<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\Masuk;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function home()
    {
        return view('home', ['barang' => BarangModel::all()]);
    }

    // Menampilkan halaman daftar barang
    public function daftarbarang()
    {
        $barang = BarangModel::all();
        return view('daftarbarang', compact('barang'));
    }

    public function daftarbarangbuat()
    {
        return view('daftarbarangbuat');
    }

    public function tampilkanbarangsearch(Request $request)
    {
        $query = \App\Models\BarangModel::query();

        // Hanya barang jadi
        $query->where('tipe', 'jadi');

        // Jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
            });
        }

        $barang = $query->paginate(15);

        return view('homebarangjadi', compact('barang'));
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
            return redirect()->route('homebarangjadi')->with('success', 'Stok barang berhasil ditambahkan!');
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
        ]);

        // Catat histori barang masuk
        Masuk::create([
            'barang_id' => $request->kode_barang,
            'jumlah_masuk' => $request->stok_barang,
        ]);

        // Cari barang berdasarkan kode_barang
        $barang = BarangModel::where('kode_barang', $request->kode_barang)->first();

        if ($barang) {
            // Jika barang sudah ada, update stok
            $barang->stok_barang += $request->stok_barang;
            $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barang->save();
            return redirect()->route('homebarangjadi')->with('success', 'Stok barang berhasil ditambahkan!');
        } else {
            // Jika barang belum ada, buat baru (wajib input kategori & unit jika ingin tambah barang baru)
            $request->validate([
                'kategori_barang' => 'required',
                'unit_barang' => 'required',
            ]);
            $data = $request->all();
            $data['tipe'] = 'mentah';
            $data['status_barang'] = $request->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            BarangModel::create($data);
            return redirect()->route('homebarangjadi')->with('success', 'Barang berhasil ditambahkan');
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

        return redirect()->route('homebarangjadi')->with('success', 'Barang jadi berhasil ditambahkan');
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

        // Update stok barang mentah
        $barangMentah = BarangModel::where('kode_barang', $request->input('kode_barang'))
            ->where('tipe', 'mentah')
            ->first();

        if ($barangMentah) {
            $barangMentah->stok_barang += $request->input('stok_barang');
            $barangMentah->status_barang = $barangMentah->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barangMentah->save();
        }

        return redirect()->route('homebarangjadi')->with('success', 'Stok barang jadi & mentah berhasil diperbarui.');
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

        return redirect()->route('homebarangjadi')->with('success', 'Informasi barang berhasil diperbarui!');
    }


    public function tampilkantambahbarangjadi()
    {
        $barang = BarangModel::select('nama_barang', 'stok_barang')->get();
        return view('homebarangjadi', compact('barang'));
    }

    // menampilkan data barang
    public function tampilkanbarang(Request $request = null)
    {
        // $halaman = session('halaman', 15);
        $databarang = BarangModel::paginate(15);
        $histori = \App\Models\Masuk::with('barang')->orderBy('created_at', 'desc')->get();
        return view('homebarangjadi', ['barang' => $databarang, 'histori' => $histori]);
    }



    public function hapus($kode_barang)
    {
        $barang = BarangModel::findOrFail($kode_barang);
        $barang->delete();

        return redirect()->route('homebarangjadi')->with('success', 'Barang berhasil dihapus');
    }

    function barangmentah()
    {
        $databarang = BarangModel::paginate(15);
        return view('homebarangjadi', ['tipe' => 'mentah', 'barang' => $databarang]);
    }

    public function destroy($kode_barang)
    {
        $barang = BarangModel::findOrFail($kode_barang);
        $barang->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }

    // API untuk menampilkan semua data barang
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

    public function homebarangjadi(Request $request = null)
    {
        // Ambil histori barang masuk terbaru
        $databarang = BarangModel::paginate(15);
        $histori = Masuk::with('barang')->orderBy('created_at', 'desc')->get();
        return view('homebarangjadi', ['barang' => $databarang, 'histori' => $histori]);
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
        return redirect()->route('homebarangjadi')->with('success', 'Histori barang masuk berhasil dihapus dan stok barang diperbarui.');
    }
}

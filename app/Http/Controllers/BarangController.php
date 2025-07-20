<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\StokOpname;
use App\Models\Masuk;
use App\Models\Keluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasukMentah;



class BarangController extends Controller
{
    public function home()
    {
        return view('home', ['barang' => BarangModel::all()]);
    }

    // Menampilkan halaman stok barang
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

    public function updateNamaBarang(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
        ]);

        $barang = BarangModel::findOrFail($id);
        $barang->nama_barang = $request->input('nama_barang');
        $barang->save();

        return redirect()->route('stokbarang')->with('success', 'Nama barang berhasil diperbarui!');
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

            'kategori_barang' => 'required',
            'jenis_barang' => 'required',
            'unit_barang' => 'required',
        ]);

        // Cek apakah barang sudah ada
        $barang = BarangModel::where('kode_barang', $request->kode_barang)->first();


        // Jika barang belum ada, buat baru lalu catat histori masuk
        $data = $request->all();
        $data['status_barang'] = $request->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $data['user_id'] = Auth::user()->id;
        $data['stok_barang'] = 0;
        BarangModel::create($data);
        return redirect()->route('masterbarang')->with('success', 'Barang berhasil ditambahkan');
    }

    public function tambahBarangMasuk(Request $request)
    {
        $dat = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // dd($dat);


        // Cari barang berdasarkan kode_barang
        $barang = BarangModel::where('id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Tambah stok barang
        $barang->stok_barang += $request->jumlah_masuk;
        $barang->status_barang = $barang->jumlah_masuk > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $barang->save();

        // Catat histori masuk
        Masuk::create([
            'barang_id' => $barang->id,  // gunakan id, bukan kode_barang
            'jumlah_masuk' => $request->jumlah_masuk,
            'user_id' => Auth::user()->id,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('homebarangmasuk')->with('success', 'Barang berhasil ditambahkan');
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
        $databarang = BarangModel::where('jenis_barang', 'jadi')->paginate(15);
        $histori = \App\Models\Masuk::whereHas('barang', function ($query) {
            $query->where('jenis_barang', 'jadi');
        })->with('barang')->orderBy('created_at', 'desc')->get();
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

    public function destroyBarangKeluar($id)
    {
        // 1. Cari data di tabel 'keluar' berdasarkan ID. Jika tidak ketemu, tampilkan error.
        $keluar = \App\Models\Keluar::findOrFail($id);

        // 2. Cari barang master yang terkait dengan transaksi ini.
        $barang = \App\Models\BarangModel::find($keluar->barang_id);

        // 3. Jika barang masternya ada, tambahkan kembali stok yang sebelumnya keluar.
        if ($barang) {
            $barang->stok_barang += $keluar->jumlah_keluar;
            $barang->save();
        }

        // 4. Hapus data transaksi dari tabel 'keluar'.
        $keluar->delete();

        // 5. Kembali ke halaman barang mentah keluar dengan pesan sukses.
        return redirect()->route('barangmentahkeluar')->with('success', 'Histori barang keluar berhasil dihapus.');
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
            'barang_id' => 'required|exists:barang,id',
            'stok_fisik' => 'required|integer|min:0',
            'keterangan' => 'required'
        ]);

        $barang = BarangModel::where('id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Simpan data stok opname
        StokOpname::create([
            'barang_id' => $barang->id,
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
        return redirect()->route('barangmentahmasuk')->with('success', 'Histori barang masuk berhasil dihapus dan stok barang diperbarui.');
    }

    public function apiGetAllBarang()
    {
        $barang = BarangModel::all();
        return response()->json([
            'status' => 'success',
            'data' => $barang
        ]);
    }

    /*stokbarang kepala*/
    public function stokBarangKepala()
    {
        $barang = BarangModel::all();
        return view('stokbarangkepala', compact('barang'));
    }
    public function laporanBarangKepala()
    {
        $barang = BarangModel::all();
        return view('laporanbarangkepala', compact('barang'));
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
        $databarang = BarangModel::where('jenis_barang', 'jadi')->paginate(15);
        // Jika ada histori barang keluar, ambil di sini (misal model Keluar)
        $histori = Keluar::whereHas('barang', function ($query) {
            $query->where('jenis_barang', 'jadi');
        })->with('barang')->orderBy('created_at', 'desc')->get();
        return view('homebarangkeluar', ['barang' => $databarang, 'historiKeluar' => $histori]);
    }
    public function tambahBarangKeluar(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // Cari barang berdasarkan barang_id
        $barang = BarangModel::where('id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        if ($barang->stok_barang < $request->jumlah_keluar) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Catat histori barang keluar
        Keluar::create([
            'barang_id' => $request->barang_id, // gunakan id, bukan kode_barang
            'jumlah_keluar' => (int) $request->jumlah_keluar, // pastikan integer dan tidak null
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id, // Simpan user yang mencatat
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

    //barangmentahmasuk
    public function barangMentahMasuk()
    {
        $databarang = BarangModel::where('jenis_barang', 'mentah')->paginate(15);
        $histori = Masuk::whereHas('barang', function ($sahit) {
            $sahit->where('jenis_barang', 'mentah');
        })->with('barang')->orderBy('created_at', 'desc')->get();
        return view('barangmentahmasuk', ['barang' => $databarang, 'histori' => $histori]);
    }

    public function tambahBarangMentah(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);

        // Cari barang berdasarkan barang_id
        $barang = BarangModel::where('id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Catat histori barang masuk
        Masuk::create([
            'barang_id' => $request->barang_id,
            'jumlah_masuk' => (int) $request->jumlah_masuk,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id,
        ]);

        // Tambah stok barang
        $barang->stok_barang += $request->jumlah_masuk;
        $barang->status_barang = 'Tersedia';
        $barang->save();

        return redirect()->route('barangmentahmasuk')->with('success', 'Barang masuk berhasil dicatat dan stok diperbarui.');
    }

    //barangmentahkeluar    
    public function barangMentahKeluar()
    {
        $databarang = BarangModel::where('jenis_barang', 'mentah')->paginate(15);
        $histori = Keluar::whereHas('barang', function ($query) {
            $query->where('jenis_barang', 'mentah');
        })->with('barang')->orderBy('created_at', 'desc')->get();
        return view('barangmentahkeluar', ['barangMentah' => $databarang, 'histori' => $histori]);
    }

    //public function tambahBarangMentahKeluar(Request $request)
    public function tambahBarangMentahKeluar(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255'
        ]);
        // Cari barang berdasarkan barang_id
        $barang = BarangModel::where('id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        if ($barang->stok_barang < $request->jumlah_keluar) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Catat histori barang keluar
        Keluar::create([
            'barang_id' => $request->barang_id,
            'jumlah_keluar' => (int) $request->jumlah_keluar,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id, // Simpan user yang mencatat
        ]);
        // Kurangi stok barang
        $barang->stok_barang -= $request->jumlah_keluar;
        $barang->status_barang = $barang->stok_barang > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $barang->save();

        return redirect()->route('barangmentahkeluar')->with('success', 'Barang keluar berhasil dicatat dan stok diperbarui.');
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

    public function apiGetBarangMentah()
    {
        // Mengambil data barang dimana 'jenis_barang' adalah 'mentah',
        // dengan menghapus spasi di awal/akhir kolom untuk memastikan kecocokan.
        $barangMentah = \App\Models\BarangModel::whereRaw('TRIM(jenis_barang) = ?', ['mentah'])->get();

        // Jika tidak ada data yang ditemukan, kembalikan pesan yang sesuai.
        if ($barangMentah->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data barang mentah tidak ditemukan.',
                'data' => []
            ]);
        }

        // Mengembalikan data dalam format JSON jika ditemukan.
        return response()->json([
            'status' => 'success',
            'data' => $barangMentah
        ]);
    }
}

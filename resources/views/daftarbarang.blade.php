@extends('newwelcome')

@section('content')

<div class="space-y-6 px-4">
    <h1 class=" text-2xl font-bold">Daftar Barang</h1>
    <div class="flex justify-center items-center gap-4 mb-6">
        <div class="relative w-full sm:w-80">
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.31685 13.4583C13.2046 13.4583 16.3564 10.7627 16.3564 7.43751C16.3564 4.11231 13.2046 1.41667 9.31685 1.41667C5.42905 1.41667 2.27734 4.11231 2.27734 7.43751C2.27734 10.7627 5.42905 13.4583 9.31685 13.4583Z" stroke="#123524" stroke-width="1.41667" stroke-linejoin="round" />
                    <path d="M11.6595 5.07985C11.06 4.56712 10.2318 4.25 9.31703 4.25C8.40226 4.25 7.57409 4.56712 6.97461 5.07985" stroke="#123524" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.3777 11.766L17.8914 14.7712" stroke="#123524" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <input
                type="text"
                name="keyword"
                placeholder="Cari barang..."
                class="w-full pr-10 pl-4 py-2 border border-green-700 rounded-lg focus:outline-none focus:ring-1 focus:ring-green-700" />
        </div>
        <button onclick="document.getElementById('authentication-modal').classList.remove('hidden')"
            class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-lg">
            Tambah Barang
        </button>
    </div>

    <!-- Modal content -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md">
            <div class="bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Tambahkan Barang</h3>
                    <button type="button" onclick="document.getElementById('authentication-modal').classList.add('hidden')"
                        class="text-gray-400 hover:text-red-600">
                        ✕
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('daftarbarang.tambah') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    <div>
                        <label for="nomorbarang" class="block mb-1 text-sm font-medium">Nomor Barang</label>
                        <input type="text" name="nomorbarang" id="nomorbarang" required class="w-full border border-gray-300 p-2 rounded" />
                    </div>
                    <div>
                        <label for="namabarang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                        <input type="text" name="namabarang" id="namabarang" required class="w-full border border-gray-300 p-2 rounded" />
                    </div>
                    <div>
                        <label for="kategori_barang" class="block mb-1 text-sm font-medium">Kategori Barang</label>
                        <select name="kategori_barang" id="kategori_barang" required class="w-full border border-gray-300 p-2 rounded">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="BedUnit">BED UNIT</option>
                            <option value="Benang500Y">Benang 500Y</option>
                            <option value="Benang5000Y">Benang 5000Y</option>
                            <option value="BenangBordir">Benang Bordir</option>
                            <option value="Polyster">Polyster</option>
                            <option value="Resleting17">Resleting 17CM</option>
                            <option value="BenangNeci">Benang Neci</option>
                            <option value="KancingLubang2">Kancing 2 Lubang</option>
                            <option value="KancingLubang4">Kancing 4 Lubang</option>
                            <option value="RendaSilang">Renda Silang</option>
                            <option value="Pita">Pita 1/4</option>
                        </select>
                    </div>
                    <div>
                        <label for="jumlahbarang" class="block mb-1 text-sm font-medium">Jumlah Barang</label>
                        <input type="number" name="jumlahbarang" id="jumlahbarang" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                    </div>
                    <div>
                        <label for="satuan_barang" class="block mb-1 text-sm font-medium">Satuan Barang</label>
                        <select name="satuan_barang" id="satuan_barang" required class="w-full border border-gray-300 p-2 rounded">
                            <option value="" disabled selected>Pilih Satuan</option>
                            <option value="pcs">PCS</option>
                            <option value="meter">Meter</option>
                            <option value="cm">CM</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-green-700 text-white p-2 rounded hover:bg-green-800">
                        Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>
    <table class="min-w-full border border-gray-300 text-center bg-white shadow rounded">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="py-2 px-4 border">No</th>
                <th class="py-2 px-4 border">Kode Barang</th>
                <th class="py-2 px-4 border">Nama Barang</th>
                <th class="py-2 px-4 border">Kategori</th>
                <th class="py-2 px-4 border">Barang Masuk</th>
                <th class="py-2 px-4 border">Barang Keluar</th>
                <th class="py-2 px-4 border">Stok</th>
                <th class="py-2 px-4 border">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border">1</td>
                <td class="py-2 px-4 border">KODE1</td>
                <td class="py-2 px-4 border">Nama Barang</td>
                <td class="py-2 px-4 border">Kategori</td>
                <td class="py-2 px-4 border">10</td>
                <td class="py-2 px-4 border">5</td>
                <td class="py-2 px-4 border">5</td>
                <td class="py-2 px-4 border">Aktif</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
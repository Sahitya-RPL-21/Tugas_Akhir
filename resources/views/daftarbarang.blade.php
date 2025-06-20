@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Daftar Barang</h1>
        <div class="mb-6 w-full max-w-7xl mx-auto px-4">
            <form method="GET" action="" class="flex items-center justify-between gap-4 w-full">
                <div class="flex flex-grow gap-4">
                    <div class="relative" style="min-width: 280px; max-width: 400px;">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari barang..."
                            class="h-12 border border-green-700 rounded-lg pl-10 pr-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition w-[280px] md:w-[350px] lg:w-[400px]" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg width="20" height="20" fill="none" stroke="#123524" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                            </svg>
                        </div>
                    </div>
                    <div class="w-48">
                        <select name="kategori" class="h-12 w-full border border-green-700 rounded-lg px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700">
                            <option disabled selected>Pilih Kategori</option>
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
                </div>
                <button type="button"
                    class="h-12 flex items-center gap-2 bg-green-900 hover:bg-green-700 text-white font-medium px-5 rounded-lg shadow"
                    onclick="document.getElementById('modaltambahbarang').classList.remove('hidden')">
                    <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang
                </button>

            </form>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase">Unit</th>
                        <th class="p-4 text-center text-sm uppercase">Stok</th>
                        <th class="p-4 text-center text-sm uppercase">Status</th>
                        <th class="p-4 text-center text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $item)
                    <tr class="border-b hover:bg-green-50 transition">
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center">{{$item->kode_barang }}</td>
                        <td class="p-4 text-center">{{$item->nama_barang}}</td>
                        <td class="p-4 text-center">{{$item->kategori_barang}}</td>
                        <td class="p-4 text-center">{{$item->unit_barang}}</td>
                        <td class="p-4 text-center">{{$item->stok_barang}}</td>
                        <td class="p-4 text-center font-semibold {{ $item->stok_barang == 0 ? 'text-red-600' : 'text-green-600' }}">
                            {{ $item->stok_barang == 0 ? 'Tidak Tersedia' : 'Tersedia' }}
                        </td>
                        <td class="p-4 text-center">
                            <a href="#" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                            <form action="#" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">Tidak ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Tambah Barang -->
    <div id="modaltambahbarang" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-4xl">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Tambah Barang</h3>
                    <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('homebarangjadi.tambah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label for="kode_barang" class="block mb-1 text-sm font-medium">Kode Barang</label>
                        <input type="text" name="kode_barang" id="kode_barang" required class="w-full border border-gray-300 p-2 rounded" />
                    </div>
                    <div>
                        <label for="nama_barang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" required class="w-full border border-gray-300 p-2 rounded" />
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
                        <label for="unit_barang" class="block mb-1 text-sm font-medium">Unit</label>
                        <select name="unit_barang" id="unit_barang" required class="w-full border border-gray-300 p-2 rounded">
                            <option value="" disabled selected>Pilih Unit</option>
                            <option value="pcs">Pcs</option>
                            <option value="roll">Roll</option>
                            <option value="pak">Pak</option>
                            <option value="lusin">Lusin</option>
                            <option value="meter">Meter</option>
                            <option value="set">Set</option>
                            <option value="box">Box</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="stok_barang" class="block mb-1 text-sm font-medium">Jumlah Barang</label>
                        <input type="number" name="stok_barang" id="stok_barang" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                    </div>
                    <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                        <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                            Tambah
                        </button>
                        <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
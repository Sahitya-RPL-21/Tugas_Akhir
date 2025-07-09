@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Daftar Barang Keluar</h1>

        <!-- Search and Filter Section -->
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
                    onclick="document.getElementById('modaltambahkeluar').classList.remove('hidden')">
                    <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang Keluar
                </button>
            </form>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Tanggal</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase">Unit</th>
                        <th class="p-4 text-center text-sm uppercase">Jumlah Keluar</th>
                        <th class="p-4 text-center text-sm uppercase">User</th>
                        <th class="p-4 text-center text-sm uppercase">Keterangan</th>
                        <th class="p-4 text-center text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historiKeluar as $item)
                    <tr class="border-b hover:bg-green-50 transition">
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td class="p-4 text-center">{{ $item->barang_id }}</td>
                        <td class="p-4 text-center">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->kategori_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->unit_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->jumlah_keluar }}</td>
                        <td class="p-4 text-center">{{ $item->user->name ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->keterangan ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('homebarangkeluar.hapus', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus histori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.25 0C4.2875 0 3.5 0.7875 3.5 1.75H1.75C0.7875 1.75 0 2.5375 0 3.5H12.25C12.25 2.5375 11.4625 1.75 10.5 1.75H8.75C8.75 0.7875 7.9625 0 7 0H5.25ZM1.75 5.25V13.6675C1.75 13.86 1.89 14 2.0825 14H10.185C10.3775 14 10.5175 13.86 10.5175 13.6675V5.25H8.7675V11.375C8.7675 11.865 8.3825 12.25 7.8925 12.25C7.4025 12.25 7.0175 11.865 7.0175 11.375V5.25H5.2675V11.375C5.2675 11.865 4.8825 12.25 4.3925 12.25C3.9025 12.25 3.5175 11.865 3.5175 11.375V5.25H1.7675H1.75Z" fill="#123524" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah Barang Keluar -->
        <div id="modaltambahkeluar" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Barang Keluar</h3>
                        <button type="button" onclick="document.getElementById('modaltambahkeluar').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('homebarangkeluar.tambah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="kode_barang" class="block mb-1 text-sm font-medium">Pilih Barang</label>
                            <select name="kode_barang" id="kode_barang" required class="w-full border border-gray-300 p-2 rounded" onchange="updateNamaBarangKeluar()">
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach($barang as $item)
                                <option value="{{ $item->kode_barang }}" data-nama="{{ $item->nama_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="nama_barang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang_keluar" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                        </div>
                        <div class="md:col-span-2">
                            <label for="stok_barang" class="block mb-1 text-sm font-medium">Jumlah Barang Keluar</label>
                            <input type="number" name="jumlah_keluar" id="jumlah_keluar" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div class="md:col-span-2">
                            <label for="user" class="block mb-1 text-sm font-medium">User</label>
                            <input type="text" name="user" id="user" value="{{ auth()->user()->name }}" class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                        </div>
                        <div class="md:col-span-2">
                            <label for="keterangan" class="block mb-1 text-sm font-medium">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                                Tambah
                            </button>
                            <button type="button" onclick="document.getElementById('modaltambahkeluar').classList.add('hidden')" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function updateNamaBarangKeluar() {
                var select = document.getElementById('kode_barang');
                var nama = select.options[select.selectedIndex]?.getAttribute('data-nama') || '';
                document.getElementById('nama_barang_keluar').value = nama;
            }
        </script>
    </div>
</div>
@endsection
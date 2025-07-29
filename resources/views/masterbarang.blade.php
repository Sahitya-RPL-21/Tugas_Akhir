@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="mb-4 text-4xl font-bold text-gray-800">Master Barang</h2>
        <p class="mb-8 text-gray-600">Kelola data barang yang tersedia di sistem.</p>
        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-2">
                <button type="button"
                    class="w-full sm:w-auto h-12 flex items-center justify-center gap-2 bg-green-900 hover:bg-green-800 text-white font-semibold px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105"
                    onclick="document.getElementById('modaltambahbarang').classList.remove('hidden')">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang Baru
                </button>
                <form method="GET" action="{{ route('masterbarang.search') }}"
                    class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                    <div class="w-full sm:w-64">
                        <label for="search" class="sr-only">Cari</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Cari Kode/Nama Barang..."
                            class="h-12 w-full border border-gray-300 rounded-lg px-3 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition" />
                    </div>
                </form>

                <form method="GET" action="{{ route('masterbarang.searchjenis') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                    <div class="w-full sm:w-48">
                        <label for="jenis_barang_filter" class="sr-only">Pilih Jenis Barang</label>
                        <select name="jenis_barang_filter" id="jenis_barang_filter"
                            class="h-12 w-full border border-gray-300 rounded-lg px-3 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition">
                            <option value="">Semua Jenis</option>
                            <option value="jadi" @if(request('jenis_barang_filter')=='jadi' ) selected @endif>Barang Jadi</option>
                            <option value="mentah" @if(request('jenis_barang_filter')=='mentah' ) selected @endif>Barang Mentah</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="h-12 w-full sm:w-auto px-5 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition-colors">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase font-semibold">No</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Jenis</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Unit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($barang as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 text-center text-gray-500">{{ $index + 1 }}</td>
                        <td class="p-4 text-left font-mono">{{ $item->kode_barang }}</td>
                        <td class="p-4 text-left font-medium">{{ $item->nama_barang }}</td>
                        <td class="p-4 text-center">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $item->kategori_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if($item->jenis_barang == 'jadi')
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Jadi
                            </span>
                            @else
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Mentah
                            </span>
                            @endif
                        </td>
                        <td class="p-4 text-center">{{ $item->unit_barang }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4M4 7v10l8 4" />
                                </svg>
                                <h4 class="text-xl font-semibold mb-1">Belum Ada Data Barang</h4>
                                <p>Silakan klik tombol "Tambah Barang Baru" untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal Tambah Barang -->
    <div id="modaltambahbarang" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50 transition-opacity duration-300 ease-out">
        <div class="relative p-4 w-full max-w-2xl">
            <div class="bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between p-5 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-900">Tambah Barang Baru</h3>
                    <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Form Action Diperbaiki di sini -->
                <form action="{{ route('masterbarang.store') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div>
                        <label for="kode_barang" class="block mb-2 text-sm font-medium text-gray-700">Kode Barang</label>
                        <input type="text" name="kode_barang" id="kode_barang"
                            class="w-full border border-green-700 p-3 rounded-lg shadow-sm bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out" />
                    </div>

                    <div>
                        <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-700">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" required pattern=".*[a-zA-Z]+.*"
                            title="Nama barang tidak boleh hanya menggunakan angka"
                            class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out" />
                        <span id="error-nama" class="text-red-600 text-sm mt-1 hidden"></span>
                    </div>

                    <div class="md:col-span-2">
                        <label for="jenis_barang" class="block mb-2 text-sm font-medium text-gray-700">Jenis Barang</label>
                        <select name="jenis_barang" id="jenis_barang" required
                            class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out">
                            <option value="" disabled selected>Pilih Jenis Barang</option>
                            <option value="jadi">Jadi</option>
                            <option value="mentah">Mentah</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="unit_barang" class="block mb-2 text-sm font-medium text-gray-700">Unit</label>
                        <select name="unit_barang" id="unit_barang" required
                            class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out">
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
                        <label for="kategori_barang" class="block mb-2 text-sm font-medium text-gray-700">Kategori Barang</label>
                        <select name="kategori_barang" id="kategori_barang" required
                            onchange="generateKodeBarang()" class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="BED UNIT">BED UNIT</option>
                            <option value="Benang 500Y">Benang 500Y</option>
                            <option value="Benang 5000Y">Benang 5000Y</option>
                            <option value="Benang Bordir">Benang Bordir</option>
                            <option value="Polyster">Polyster</option>
                            <option value="Resleting 17CM">Resleting 17CM</option>
                            <option value="Benang Neci">Benang Neci</option>
                            <option value="Kancing 2 Lubang">Kancing 2 Lubang</option>
                            <option value="Kancing 4 Lubang">Kancing 4 Lubang</option>
                            <option value="Renda Silang">Renda Silang</option>
                            <option value="Pita 1/4">Pita 1/4</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                        <button type="submit"
                            class="px-6 py-3 text-white bg-green-900 rounded-lg hover:bg-green-700 shadow-md transition-colors duration-200">
                            Tambah Barang
                        </button>
                        <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('nama_barang').addEventListener('submit', function(e) {
            const namaInput = document.getElementById('nama_barang');
            const errorMsg = document.getElementById('error-nama');

            const onlyNumbers = /^[0-9]+$/;

            if (onlyNumbers.test(namaInput.value)) {
                e.preventDefault(); // Stop form submission
                errorMsg.textContent = "Nama barang tidak boleh hanya angka.";
                errorMsg.classList.remove("hidden");
                namaInput.classList.add("border-red-600");
            } else {
                errorMsg.classList.add("hidden");
                namaInput.classList.remove("border-red-600");
            }
        });

        function generateKodeBarang() {
            const kategori = document.getElementById('kategori_barang').value;
            const kodeField = document.getElementById('kode_barang');

            if (kategori) {
                const initials = kategori
                    .split(' ') // Pisahkan per kata
                    .map(word => word[0]) // Ambil huruf pertama tiap kata
                    .join('')
                    .toUpperCase()
                    .substring(0, 2); // Ambil 2 huruf pertama

                const randomNumber = Math.floor(1000 + Math.random() * 9000); // 4 digit acak
                kodeField.value = `${initials}-${randomNumber}`;
            }
        }
    </script>


    @endsection
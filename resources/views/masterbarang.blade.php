@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="mb-8 text-4xl font-bold text-gray-800">Master Barang</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 mb-8">
                <button type="button"
                    class="w-full sm:w-auto h-12 flex items-center justify-center gap-2 bg-green-900 hover:bg-green-800 text-white font-semibold px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105"
                    onclick="document.getElementById('modaltambahbarang').classList.remove('hidden')">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang Baru
                </button>

                <div x-data="{ showFilters: true }"
                    x-show="showFilters"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="w-full sm:w-auto">
                    <form method="GET" action="{{ route('masterbarang') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full">
                        <div class="w-full sm:w-48">
                            <label for="jenis_barang_filter" class="sr-only">Pilih Jenis Barang</label>
                            <select name="jenis_barang_filter" id="jenis_barang_filter"
                                class="h-12 w-full border border-gray-300 rounded-lg px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition duration-200 ease-in-out">
                                <option value="">Semua Jenis</option>
                                <option value="jadi" {{ request('jenis_barang_filter') == 'jadi' ? 'selected' : '' }}>Jadi</option>
                                <option value="mentah" {{ request('jenis_barang_filter') == 'mentah' ? 'selected' : '' }}>Mentah</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="h-12 w-full sm:w-auto px-6 bg-green-900 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors duration-200">
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </div>


            <div class="overflow-x-auto">
                <table class="min-w-full w-full text-gray-700">
                    <thead class="bg-[#173720] text-white">
                        <tr>
                            <th class="p-4 text-center text-sm uppercase font-semibold rounded-tl-lg">No</th>
                            <th class="p-4 text-center text-sm uppercase font-semibold">Kode Barang</th>
                            <th class="p-4 text-center text-sm uppercase font-semibold">Nama Barang</th>
                            <th class="p-4 text-center text-sm uppercase font-semibold">Kategori Barang</th>
                            <th class="p-4 text-center text-sm uppercase font-semibold">Jenis Barang</th>
                            <th class="p-4 text-center text-sm uppercase font-semibold rounded-tr-lg">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang as $index => $item)
                        <tr class="border-b border-gray-200 hover:bg-green-50 transition-colors duration-150">
                            <td class="p-4 text-center">{{ $index + 1 }}</td>
                            <td class="p-4 text-center">{{ $item->kode_barang }}</td>
                            <td class="p-4 text-center">{{ $item->nama_barang }}</td>
                            <td class="p-4 text-center">{{ $item->kategori_barang }}</td>
                            <td class="p-4 text-center">{{ $item->jenis_barang }}</td>
                            <td class="p-4 text-center">{{ $item->unit_barang }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500 italic">Tidak ada data barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modaltambahbarang" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50 transition-opacity duration-300 ease-out">
    <div class="relative p-4 w-full max-w-2xl transform transition-transform duration-300 ease-out scale-95 opacity-0"
        x-data="{ showModal: false }" x-init="setTimeout(() => { showModal = true; $el.classList.add('scale-100', 'opacity-100'); }, 50)"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
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
            <form action="{{ route('masterbarang.tambahbaru') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <div>
                    <label for="kode_barang" class="block mb-2 text-sm font-medium text-gray-700">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" required
                        class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out" />
                </div>
                <div>
                    <label for="nama_barang" class="block mb-2 text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" required
                        class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out" />
                </div>
                <!-- jenis barang -->
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
                <!-- kategori barang dan stok -->
                <div class="md:col-span-2">
                    <label for="kategori_barang" class="block mb-2 text-sm font-medium text-gray-700">Kategori Barang</label>
                    <select name="kategori_barang" id="kategori_barang" required
                        class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out">
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

{{-- Script for Alpine.js to handle modal transitions if you choose to use it --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

@endsection
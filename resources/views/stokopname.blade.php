@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div x-data="stockOpnameData()" class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">Stok Opname</h1>
            <p class="mt-1 text-md text-gray-600">Catat dan kelola hasil perhitungan fisik stok barang.</p>
        </div>

        {{-- Pesan Error / Sukses --}}
        @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
            <p class="font-bold">Terjadi Kesalahan</p>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('stokopname') }}" class="flex-grow w-full md:w-auto">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari berdasarkan kode atau nama barang..."
                            class="h-12 w-full border border-gray-300 rounded-lg pl-10 pr-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 transition" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                            </svg>
                        </div>
                    </div>
                </form>

                {{-- Tombol Tambah Stok Opname --}}
                <button type="button" onclick="document.getElementById('modaltambahopname').classList.remove('hidden')"
                    class="h-12 flex items-center gap-2 bg-green-900 hover:bg-green-700 text-white font-medium px-5 rounded-lg shadow-md transition-colors duration-200 w-full md:w-auto justify-center flex-shrink-0">
                    <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Stok Opname
                </button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase font-semibold rounded-tl-xl">No</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Stok Sistem</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Stok Fisik</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Selisih</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">User</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold rounded-tr-xl">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($stokopname as $index => $item)
                    <tr class="hover:bg-green-50 transition-colors duration-150">
                        <td class="p-4 text-center text-gray-500">{{ $index + $stokopname->firstItem() }}</td>
                        <td class="p-4 text-left font-mono">{{ $item->barang->kode_barang }}</td>
                        <td class="p-4 text-left font-medium text-gray-900">{{ $item->barang->nama_barang }}</td>
                        <td class="p-4 text-center text-gray-600">{{ $item->stok_awal }}</td>
                        <td class="p-4 text-center font-semibold text-blue-600">{{ $item->stok_fisik }}</td>
                        <td class="p-4 text-center">
                            @php $selisih = $item->stok_fisik - $item->stok_awal; @endphp
                            @if($selisih > 0)
                            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                +{{ $selisih }}
                            </span>
                            @elseif($selisih < 0)
                                <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                {{ $selisih }}
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $selisih }}
                                </span>
                                @endif
                        </td>
                        <td class="p-4 text-left text-gray-600">{{ $item->user->username ?? 'N/A' }}</td>
                        <td class="p-4 text-left text-gray-600">{{ $item->keterangan ?: '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-16 h-16 text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h4 class="text-xl font-semibold mb-1">Data Stok Opname Kosong</h4>
                                <p>Silakan klik tombol "Tambah Opname" untuk mencatat data baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination Links --}}
        <div class="mt-6">
            {{ $stokopname->links() }}
        </div>
        <!-- modal tambah opname -->
        <div id="modaltambahopname" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Tambah Stok Opname</h3>
                        <button type="button" onclick="document.getElementById('modaltambahopname').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('stokopname.tambah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="barang_id" class="block mb-1 text-sm font-medium">Pilih Barang</label>
                            <select name="barang_id" id="barang_id" required class="w-full border border-gray-300 p-2 rounded" onchange="updateNamaBarangKeluar()">
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach($barang as $item)
                                <option value="{{ $item->id }}" data-nama="{{ $item->nama_barang }}" data-stok-awal="{{ $item->stok_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="nama_barang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                        </div>
                        <div class="md:col-span-2">
                            <label for="stok_barang" class="block mb-1 text-sm font-medium">Stok Sistem</label>
                            <input type="number" name="stok_barang" id="stok_barang" min="1" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                        </div>
                        <div class="md:col-span-2">
                            <label for="stok_fisik" class="block mb-1 text-sm font-medium">Stok Fisik</label>
                            <input type="number" name="stok_fisik" id="stok_fisik" min="0" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div class="md:col-span-2">
                            <label for="keterangan" class="block mb-1 text-sm font-medium">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
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
                var select = document.getElementById('barang_id');
                var nama = select.options[select.selectedIndex]?.getAttribute('data-nama') || '';
                var stok_barang = select.options[select.selectedIndex]?.getAttribute('data-stok-awal') || '';
                document.getElementById('nama_barang').value = nama;
                document.getElementById('stok_barang').value = stok_barang;
            }
        </script>

        {{-- Include Alpine.js for modal transitions (optional, but recommended for smooth UX) --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        @endsection
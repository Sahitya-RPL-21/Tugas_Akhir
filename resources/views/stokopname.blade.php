@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        {{-- Page Header --}}
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Stok Opname</h1>

        {{-- Error Message Display --}}
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Search Form and Add Stock Opname Button --}}
        <div class="mb-6 w-full flex flex-col md:flex-row md:items-end gap-4">
            <form method="GET" action="{{ route('stokopname') }}" class="flex items-center gap-4 w-full md:flex-grow">
                <div class="relative flex-grow">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama barang..."
                        class="h-12 border border-green-700 rounded-lg pl-10 pr-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition w-full" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg width="20" height="20" fill="none" stroke="#123524" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                        </svg>
                    </div>
                </div>
                <button type="submit" class="h-12 bg-green-900 hover:bg-green-700 text-white font-medium px-6 rounded-lg shadow-md transition-colors duration-200 flex-shrink-0">Cari</button>
            </form>

            <button type="button" onclick="document.getElementById('modaltambahopname').classList.remove('hidden')"
                class="h-12 flex items-center gap-2 bg-green-900 hover:bg-green-700 text-white font-medium px-5 rounded-lg shadow-md transition-colors duration-200 w-full md:w-auto justify-center flex-shrink-0">
                <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Stok Opname
            </button>
        </div>

        {{-- Data Table --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase font-semibold rounded-tl-lg">No</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Stok Awal</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Stok Fisik</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Selisih</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">User</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokopname as $index => $item)
                    <tr class="border-b border-gray-200 hover:bg-green-50 transition-colors duration-150">
                        <td class="p-4 text-center">{{ $index + $stokopname->firstItem() }}</td>
                        <td class="p-4 text-center">{{ $item->barang->nama_barang }}</td>
                        <td class="p-4 text-center">{{ $item->kode_barang }}</td>
                        <td class="p-4 text-center">{{ $item->stok_awal }}</td>
                        <td class="p-4 text-center">
                            {{ $item->stok_fisik}}
                        </td>
                        <td class="p-4 text-center font-semibold {{ ($item->stok_fisik - $item->stok_awal) < 0 ? 'text-red-600' : 'text-gray-800' }}">
                            {{ $item->stok_fisik - $item->stok_awal }}
                        </td>
                        <td class="p-4 text-center">{{ $item->user->name ?? '-' }}</td>
                        <td class="p-4 text-center">
                            {{ $item->keterangan }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-6 text-center text-gray-500 italic">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 p-4">
                {{ $stokopname->links() }}
            </div>
        </div>
    </div>
</div>

<div id="modaltambahopname" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
    {{-- Ini adalah div yang membungkus konten modal (kotak putih) --}}
    {{-- Perhatikan class `z-50` di parent div di atas. Z-index ini harus lebih rendah atau sama dengan konten modal. --}}
    <div class="relative p-4 w-full max-w-2xl bg-white rounded-lg shadow-xl"
        x-data="{ showModal: false }"
        x-init="setTimeout(() => { showModal = true; $el.classList.add('scale-100', 'opacity-100'); }, 50)"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="flex items-center justify-between p-5 border-b border-gray-200">
            <h3 class="text-2xl font-semibold text-gray-900">Tambah Stok Opname</h3>
            <button type="button" onclick="document.getElementById('modaltambahopname').classList.add('hidden')"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form action="{{ route('stokopname.tambah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div class="md:col-span-2">
                <label for="modal_kode_barang" class="block mb-2 text-sm font-medium text-gray-700">Pilih Barang</label>
                <select name="kode_barang" id="modal_kode_barang" required
                    class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-700 transition duration-150 ease-in-out">
                    <option value="" disabled selected>Pilih Barang</option>
                    @foreach($barang as $item)
                    <option value="{{ $item->kode_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="modal_stok_fisik" class="block mb-2 text-sm font-medium text-gray-700">Stok Fisik</label>
                <input type="number" name="stok_fisik" id="modal_stok_fisik" min="0" required
                    class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out" />
            </div>
            <div class="md:col-span-2">
                <label for="modal_keterangan" class="block mb-2 text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" id="modal_keterangan"
                    class="w-full border border-green-700 p-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-700 transition duration-150 ease-in-out" />
            </div>
            <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                <button type="submit"
                    class="px-6 py-3 text-white bg-green-900 rounded-lg hover:bg-green-700 shadow-md transition-colors duration-200">
                    Tambah
                </button>
                <button type="button" onclick="document.getElementById('modaltambahopname').classList.add('hidden')"
                    class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('modaltambahopname').classList.remove('hidden');
    });
</script>
@endif

{{-- Include Alpine.js for modal transitions (optional, but recommended for smooth UX) --}}
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection
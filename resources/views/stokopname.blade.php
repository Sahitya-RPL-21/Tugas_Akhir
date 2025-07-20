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
                        <th class="p-4 text-center text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Nama Barang</th>
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
                        <td class="p-4 text-center">{{ $item->barang->kode_barang }}</td>
                        <td class="p-4 text-center">{{ $item->barang->nama_barang }}</td>
                        <td class="p-4 text-center">{{ $item->stok_awal }}</td>
                        <td class="p-4 text-center">
                            {{ $item->stok_fisik}}
                        </td>
                        <td class="p-4 text-center font-semibold {{ ($item->stok_fisik - $item->stok_awal) < 0 ? 'text-red-600' : 'text-gray-800' }}">
                            {{ $item->stok_fisik - $item->stok_awal }}
                        </td>
                        <td class="p-4 text-center">{{ $item->user->username ?? '-' }}</td>
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
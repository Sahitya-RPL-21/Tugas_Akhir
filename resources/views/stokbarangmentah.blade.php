@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Stok Barang Mentah</h1>
                <p class="mt-1 text-md text-gray-600">Halaman persediaan barang mentah nda di sini.</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <form method="GET" action="{{ route('stokbarang.search') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div class="md:col-span-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="#123524" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="Masukkan kode atau nama barang..."
                                class="h-12 w-full border border-gray-300 rounded-lg pl-10 pr-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 transition" />
                        </div>
                    </div>

                    <div>
                        <select id="kategori" name="kategori" class="h-12 w-full border border-gray-300 rounded-lg px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600">
                            <option value="" class="text-gray-400">Semua Kategori</option>
                            <option value="BedUnit" @if(request('kategori')=='BedUnit' ) selected @endif>BED UNIT</option>
                            <option value="Benang500Y" @if(request('kategori')=='Benang500Y' ) selected @endif>Benang 500Y</option>
                            <option value="Benang5000Y" @if(request('kategori')=='Benang5000Y' ) selected @endif>Benang 5000Y</option>
                            <option value="AtasanSMPLaki-Laki" @if(request('kategori')=='AtasanSMPLaki-Laki' ) selected @endif>Atasan SMP Laki-Laki</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="submit" class="w-full h-12 inline-flex items-center justify-center px-4 py-2 bg-green-900 text-white rounded-lg hover:bg-green-800 transition-colors">
                            Cari Kategori
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangMentah as $item)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center">{{ $item->kode_barang }}</td>
                        <td class="p-4 text-center">{{ $item->nama_barang }}</td>
                        <td class="p-4 text-center">{{ $item->stok_barang }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            Tidak ada data barang mentah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
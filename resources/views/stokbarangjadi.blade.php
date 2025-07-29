@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Stok Barang Jadi</h1>
                <p class="mt-1 text-md text-gray-600">Halaman persediaan barang jadi anda di sini.</p>
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
                            <option value="Bed Unit" @if(request('kategori')=='Bed Unit' ) selected @endif>BED UNIT</option>
                            <option value="Benang 500Y" @if(request('kategori')=='Benang 500Y' ) selected @endif>Benang 500Y</option>
                            <option value="Benang 5000Y" @if(request('kategori')=='Benang 5000Y' ) selected @endif>Benang 5000Y</option>
                            <option value="Atasan SMP Laki-Laki" @if(request('kategori')=='Atasan SMP Laki-Laki' ) selected @endif>Atasan SMP Laki-Laki</option>
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

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase font-semibold rounded-tl-xl">No</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Unit</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Stok</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">User</th>
                        @if(auth()->user()->role === 'user')
                        <th class="p-4 text-center text-sm uppercase font-semibold rounded-tr-xl">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($barang as $item)
                    <tr class="hover:bg-green-50 transition-colors duration-150">
                        <td class="p-4 text-center text-gray-500">{{ $loop->iteration }}</td>
                        <td class="p-4 text-left font-mono text-gray-800">{{ $item->kode_barang }}</td>
                        <td class="p-4 text-left font-medium text-gray-900">{{ $item->nama_barang }}</td>
                        <td class="p-4 text-center">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $item->kategori_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $item->unit_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="font-bold text-xl {{ $item->stok_barang <= 50 ? 'text-red-600 animate-pulse' : 'text-green-700' }}">
                                {{ $item->stok_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-left text-gray-600">
                            @if($item->user)
                            {{ $item->user->username }}
                            @else
                            <span class="text-gray-400 italic">N/A</span>
                            @endif
                        </td>
                        @if(auth()->user()->role === 'user')
                        <td class="p-4 text-center" x-data="{ open: false }">
                            <button @click="open = true"
                                class="p-2 rounded-full text-gray-500 hover:bg-green-100 hover:text-green-700 transition-colors"
                                title="Edit Barang">
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </td>
                    @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'user' ? '8' : '7' }}" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-16 h-16 text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <h4 class="text-xl font-semibold mb-1">Data Tidak Ditemukan</h4>
                                <p>Tidak ada data barang yang sesuai dengan kriteria pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Stok Barang</h1>
                <p class="mt-1 text-md text-gray-600">Halaman persediaan barang Anda di sini.</p>
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
                            {{-- Opsi kategori Anda --}}
                            <option value="BedUnit" @if(request('kategori')=='BedUnit' ) selected @endif>BED UNIT</option>
                            <option value="Benang500Y" @if(request('kategori')=='Benang500Y' ) selected @endif>Benang 500Y</option>
                            <option value="Benang5000Y" @if(request('kategori')=='Benang5000Y' ) selected @endif>Benang 5000Y</option>
                            {{-- Tambahkan sisa opsi Anda di sini dengan pola yang sama --}}
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

                            <div x-show="open" @keydown.escape.window="open = false"
                                class="fixed inset-0 z-50 overflow-y-auto"
                                aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 bg-gray-800 bg-opacity-75 transition-opacity" @click="open = false" aria-hidden="true"></div>

                                    {{-- Konten Modal --}}
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <form method="POST" action="{{ route('stokbarang.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                            Edit Nama Barang
                                                        </h3>
                                                        <div class="mt-4">
                                                            <label for="nama_barang_{{ $item->id }}" class="sr-only">Nama Barang</label>
                                                            <input type="text" name="nama_barang" id="nama_barang_{{ $item->id }}"
                                                                value="{{ $item->nama_barang }}"
                                                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-900 text-base font-medium text-white hover:bg-green-800 sm:w-auto sm:text-sm">
                                                    Simpan Perubahan
                                                </button>
                                                <button type="button" @click="open = false" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
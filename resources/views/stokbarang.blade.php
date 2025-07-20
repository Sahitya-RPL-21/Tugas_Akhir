@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Stok Barang</h1>
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
                            <option value="AtasanSMPLaki-Laki">Atasan SMP Laki-Laki</option>
                            <option value="AtasanSMPPerempuan">Atasan SMP Perempuan</option>
                            <option value="BawahanSMPLaki-Laki">Bawahan SMP Laki-Laki</option>
                            <option value="BawahanSMPPerempuan">Bawahan SMP Perempuan</option>
                            <option value="AtasanSMALaki-Laki">Atasan SMA Laki-Laki</option>
                            <option value="AtasanSMAPerempuan">Atasan SMA Perempuan</option>
                            <option value="BawahanSMALaki-Laki">Bawahan SMA Laki-Laki</option>
                            <option value="BawahanSMAPerempuan">Bawahan SMA Perempuan</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase font-semibold rounded-tl-xl">No</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Unit</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Stok</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">User</th>
                        @if(auth()->user()->role === 'user')
                        <th class="p-4 text-center text-sm uppercase font-semibold rounded-tr-xl">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $item)
                    <tr class="border-b border-gray-100 hover:bg-green-50 transition-colors duration-150">
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center font-medium text-gray-800">{{$item->kode_barang }}</td>
                        <td class="p-4 text-center">{{$item->nama_barang}}</td>
                        <td class="p-4 text-center">{{$item->kategori_barang}}</td>
                        <td class="p-4 text-center">{{$item->unit_barang}}</td>
                        <td class="p-4 text-center">
                            <span class="font-bold text-lg {{ $item->stok_barang <= 50 ? 'text-red-600' : 'text-green-700' }}">
                                {{ $item->stok_barang }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            {{-- Pastikan relasi 'user' didefinisikan di model Barang Anda --}}
                            @if($item->user)
                            {{ $item->user->username }}
                            @else
                            <span class="text-gray-500 italic">N/A</span>
                            @endif
                        </td>
                        @if(auth()->user()->role === 'user')
                        <td class="p-4 text-center" x-data="{ open: false }">
                            {{-- Tombol Edit --}}
                            <button
                                @click="open = true"
                                class="inline-flex items-center justify-center p-2 rounded-full text-green-600 hover:bg-green-100 hover:text-green-800 transition-colors duration-200" {{-- Adjusted color to match screenshot's green edit icon --}}
                                type="button"
                                title="Edit Barang">
                                <svg class="w-5 h-5" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 0L8.75 1.75L12.25 5.25L14 3.5L10.5 0ZM7 3.5L0 10.5V14H3.5L10.5 7L7 3.5Z" />
                                </svg>
                            </button>

                            <!-- Modal Edit Nama Barang -->
                            <div
                                x-show="open"
                                @click.away="open = false"
                                class="fixed inset-0 flex items-center justify-center z-50"
                                style="display: none;">
                                <div class="bg-black bg-opacity-40 absolute inset-0"></div>
                                <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-full max-w-md">
                                    <h2 class="text-xl font-bold mb-4">Edit Nama Barang</h2>
                                    <form method="POST" action="{{ route('stokbarang.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-4">
                                            <label class="block text-gray-700 mb-2">Nama Barang</label>
                                            <input
                                                type="text"
                                                name="nama_barang"
                                                value="{{ $item->nama_barang }}"
                                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-700"
                                                required>
                                        </div>
                                        <div class="flex justify-end gap-2">
                                            <button type="button" @click="open = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                                            <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        @endif
                        @empty
                    <tr>
                        <td colspan="8" class="p-4 text-center text-gray-500">Tidak ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
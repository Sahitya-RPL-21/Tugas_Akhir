@extends('newwelcome')

@section('role_name', 'Laporan Barang')
@section('page_title', 'Laporan Barang')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-sm rounded-lg">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Laporan Barang</h1>

        <!-- Form untuk filtering -->
        <form method="GET" action="{{ route('laporanbarang') }}" id="filterForm" class="mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <!-- Filter Tanggal -->
                <div class="flex items-center">
                    <input id="datepicker-range-start" name="start" type="date"
                        value="{{ request('start') }}"
                        class="border border-gray-300 rounded-lg p-2.5" placeholder="Tanggal Mulai">
                    <span class="mx-2 text-gray-500">ke</span>
                    <input id="datepicker-range-end" name="end" type="date"
                        value="{{ request('end') }}"
                        class="border border-gray-300 rounded-lg p-2.5" placeholder="Tanggal Selesai">
                </div>

                <!-- Filter Jenis Transaksi -->
                @if(auth()->user()->role === 'user' || auth()->user()->role === 'kepala')
                <div>
                    <select id="jenis_transaksi" name="jenis_transaksi" class="border border-gray-300 rounded-lg p-2.5">
                        <option value="">Semua Jenis Transaksi</option>
                        <option value="masuk" {{ request('jenis_transaksi') == 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                        <option value="keluar" {{ request('jenis_transaksi') == 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                    </select>
                </div>
                @endif

                <!-- Tombol Filter -->
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2.5 rounded-lg">Filter</button>

                <!-- Tombol Cetak Laporan (sekarang menjadi link) -->
                <a href="{{ route('laporanbarang.cetak', request()->query()) }}" target="_blank" class="bg-[#173720] hover:bg-green-800 text-white font-semibold py-2 px-5 rounded-lg shadow-md inline-flex items-center">
                    <svg class="inline-block mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 16H5.5V22H18.5V16Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 10H22V19H18.5086V16H5.49025V19H2V10Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M19 2H5V10H19V2Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                    </svg>
                    Cetak Laporan
                </a>
            </div>
        </form>

        <div class="overflow-x-auto shadow-sm rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">No.</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Tanggal</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Jenis Transaksi</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Jumlah</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $index => $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                        <td class="py-2 px-4">{{ $item->kode_barang }}</td>
                        <td class="py-2 px-4">{{ $item->nama_barang }}</td>
                        <td class="py-2 px-4 capitalize">{{ $item->jenis_transaksi }}</td>
                        <td class="py-2 px-4">{{ $item->jumlah }}</td>
                        <td class="py-2 px-4">{{ $item->unit_barang }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">Tidak ada data laporan barang untuk filter yang dipilih.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
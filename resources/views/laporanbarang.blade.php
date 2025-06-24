@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Laporan Barang</h1>
        <form method="GET" action="{{ route('laporanbarang') }}" class="flex items-center mb-6 gap-4">
            <div class="relative">
                <input id="datepicker-range-start" name="start" type="date"
                    value="{{ request('start') }}"
                    class="border border-gray-300 rounded-lg p-2.5" placeholder="Tanggal Mulai">
            </div>
            <span class="mx-2 text-gray-500">ke</span>
            <div class="relative">
                <input id="datepicker-range-end" name="end" type="date"
                    value="{{ request('end') }}"
                    class="border border-gray-300 rounded-lg p-2.5" placeholder="Tanggal Selesai">
            </div>
            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-lg">Filter</button>
        </form>

        <div class="flex justify-between items-center mb-4"> {{-- Reduced mb from 6 to 4 or even 0 to bring closer to table --}}
            <div class="">
                <label for="jenis_transaksi" class="mr-2 font-semibold text-gray-700">Jenis Laporan:</label>
                <select id="jenis_transaksi" name="jenis_transaksi" class="border border-gray-300 rounded-lg p-2.5"
                    onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="masuk" {{ request('jenis_transaksi') == 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="keluar" {{ request('jenis_transaksi') == 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                </select>
            </div>

            <div class="">
                <button onclick="window.print()" class="bg-[#173720] hover:bg-green-800 text-white font-semibold py-2 px-5 rounded-lg shadow-md">
                    <svg class="inline-block mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 16H5.5V22H18.5V16Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 10H22V19H18.5086V16H5.49025V19H2V10Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M19 2H5V10H19V2Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                    </svg>
                    Cetak Laporan
                </button>
            </div>
        </div>

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
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Stok Akhir</th>
                        <th class="py-3 px-4 text-left text-sm uppercase font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Your table rows will go here --}}
                </tbody>
            </table>
        </div>

        @endsection
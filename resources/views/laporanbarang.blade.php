@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Laporan Barang</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow-md">
            <table class="min-w-full text-gray-700 text-center">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase">Barang Masuk</th>
                        <th class="p-4 text-center text-sm uppercase">Barang Keluar</th>
                        <th class="p-4 text-center text-sm uppercase">Stok</th>
                        <th class="p-4 text-center text-sm uppercase">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-green-50 transition">
                        <td class="p-4">1</td>
                        <td class="p-4">KODE001</td>
                        <td class="p-4">Printer Epson L3110</td>
                        <td class="p-4">Elektronik</td>
                        <td class="p-4">10</td>
                        <td class="p-4">2</td>
                        <td class="p-4">8</td>
                        <td class="p-4 text-green-600 font-semibold">Tersedia</td>
                    </tr>
                    <tr class="hover:bg-green-50 transition">
                        <td class="p-4">2</td>
                        <td class="p-4">KODE002</td>
                        <td class="p-4">Kabel LAN 10m</td>
                        <td class="p-4">Aksesoris</td>
                        <td class="p-4">20</td>
                        <td class="p-4">20</td>
                        <td class="p-4">0</td>
                        <td class="p-4 text-red-500 font-semibold">Habis</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-center">
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

@endsection
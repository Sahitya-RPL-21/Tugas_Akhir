@extends('newwelcome')

@section('content')
    <div class="container mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Laporan Barang</h1>
            <p class="text-sm text-gray-500">Galeri Inventaris</p>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-center text-gray-700">
                <thead class="bg-green-700 text-white">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Kode Barang</th>
                        <th class="px-4 py-3">Nama Barang</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Barang Masuk</th>
                        <th class="px-4 py-3">Barang Keluar</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data, bisa diulang dengan loop jika pakai Laravel/Blade -->
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">KODE001</td>
                        <td class="px-4 py-2">Printer Epson L3110</td>
                        <td class="px-4 py-2">Elektronik</td>
                        <td class="px-4 py-2">10</td>
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">8</td>
                        <td class="px-4 py-2 text-green-600 font-semibold">Tersedia</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">KODE002</td>
                        <td class="px-4 py-2">Kabel LAN 10m</td>
                        <td class="px-4 py-2">Aksesoris</td>
                        <td class="px-4 py-2">20</td>
                        <td class="px-4 py-2">20</td>
                        <td class="px-4 py-2">0</td>
                        <td class="px-4 py-2 text-red-600 font-semibold">Habis</td>
                    </tr>
                    <!-- Tambah baris lainnya sesuai data -->
                </tbody>
            </table>
        </div>
    </div>

@endsection
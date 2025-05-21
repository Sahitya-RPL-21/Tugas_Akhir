@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Daftar Barang</h1>

        <!-- Switch untuk menampilkan barang mentah atau jadi -->
        <div x-data="{ tipe: '{{ $tipe ?? 'jadi' }}' }" class="flex flex-col space-y-4">
            <div class="flex justify-end pr-6 mb-4">
                <div class="flex items-center space-x-4 text-sm font-semibold">
                    <button @click="tipe = 'mentah'"
                        :class="tipe === 'mentah' ? 'text-green-800 border-b-2 border-green-800' : 'text-gray-600 hover:text-green-700'">
                        Barang Mentah
                    </button>
                    <span class="text-gray-400">|</span>
                    <button @click="tipe = 'jadi'"
                        :class="tipe === 'jadi' ? 'text-green-800 border-b-2 border-green-800' : 'text-gray-600 hover:text-green-700'">
                        Barang Jadi
                    </button>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0 mb-10">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" placeholder="Cari barang..."
                            class="w-full border-2 border-green-900 rounded-lg p-3 pl-10 transition">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.31685 13.4583C13.2046 13.4583 16.3564 10.7627 16.3564 7.43751C16.3564 4.11231 13.2046 1.41667 9.31685 1.41667C5.42905 1.41667 2.27734 4.11231 2.27734 7.43751C2.27734 10.7627 5.42905 13.4583 9.31685 13.4583Z" stroke="#123524" stroke-width="1.41667" stroke-linejoin="round" />
                                <path d="M14.3777 11.766L17.8914 14.7712" stroke="#123524" stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <select class="w-full border-2 border-green-800 rounded-lg p-3 transition">
                        <option>Pilih Kategori</option>
                    </select>
                </div>

                <div class="flex items-center gap-2" x-show="tipe === 'jadi'">
                    <button onclick="document.getElementById('modaltambahbarang').classList.remove('hidden')"
                        class="flex items-center gap-2 bg-[#173720] hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.0303 5L12.012 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5 12H19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Tambah Barang
                    </button>
                </div>
            </div>

            <!-- Tabel Barang Mentah -->
            <div x-show="tipe === 'mentah'" class="overflow-x-auto bg-white rounded-lg shadow">
                @include('barangmentah')
            </div>

            <!-- Tabel Barang Jadi -->
            <div x-show="tipe === 'jadi'" class="overflow-x-auto bg-white rounded-lg shadow">
                @include('barangjadi')
            </div>
        </div>

        <!-- Modal Tambah Barang -->
        <div id="modaltambahbarang" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Tambahkan Barang</h3>
                        <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('daftarbarang.tambah') }}" method="POST" class="p-4 space-y-4">
                        @csrf
                        <div>
                            <label for="nomorbarang" class="block mb-1 text-sm font-medium">Nomor Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div>
                            <label for="namabarang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div>
                            <label for="kategori_barang" class="block mb-1 text-sm font-medium">Kategori Barang</label>
                            <select name="kategori_barang" id="kategori_barang" required class="w-full border border-gray-300 p-2 rounded">
                                <option value="" disabled selected>Pilih Kategori</option>
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
                            </select>
                        </div>
                        <div>
                            <label for="jumlahbarang" class="block mb-1 text-sm font-medium">Jumlah Barang</label>
                            <input type="number" name="stok_barang" id="stok_barang" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div>
                            <label for="status_barang" class="block mb-1 text-sm font-medium">Status Barang</label>
                            <select name="status_barang" id="status_barang" required class="w-full border border-gray-300 p-2 rounded">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Tidak Tersedia">Tidak Tersedia</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full px-4 py-2 text-white bg-[#173720] rounded-md hover:bg-green-700">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
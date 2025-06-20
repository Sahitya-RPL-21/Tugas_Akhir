@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Daftar Barang Masuk</h1>




        <!-- Search and Filter Section hanya tampil jika tipe == 'jadi' -->
        <div x-show="tipe == 'jadi'" class="mb-6 w-full max-w-7xl mx-auto px-4">
            <form method="GET" action="{{ route('jadi') }}" class="flex items-center justify-between gap-4 w-full">
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
                        </select>
                    </div>
                </div>
                <button type="button"
                    class="h-12 flex items-center gap-2 bg-green-900 hover:bg-green-700 text-white font-medium px-5 rounded-lg shadow"
                    onclick="document.getElementById('modalbuatbarang').classList.remove('hidden')">
                    <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang Masuk
                </button>

            </form>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6" x-show="tipe=='jadi'">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Tanggal</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase">Unit</th>
                        <th class="p-4 text-center text-sm uppercase">Jumlah Masuk</th>
                        <th class="p-4 text-center text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histori as $item)
                    <tr class="border-b hover:bg-green-50 transition">
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td class="p-4 text-center">{{ $item->barang_id }}</td>
                        <td class="p-4 text-center">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->kategori_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->unit_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->jumlah_masuk }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('histori.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus histori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m-7 0v14a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V6" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Edit Barang -->
        <!-- <div id="modaleditbarang" tabindex="-1" aria-hidden="true"
            x-show="showEditModal"
            style="display: none;"
            class="fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Edit Barang</h3>
                        <button type="button" @click="showEditModal = false" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form :action="'{{ url('barangjadi') }}/' + itemData.kode_barang" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="kode_barang" :value="itemData.kode_barang" />
                        <input type="hidden" name="id" :value="itemData.id" />
                        <div>
                            <label for="edit_nama_barang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                            <input type="text" name="nama_barang" id="edit_nama_barang" x-model="itemData.nama_barang" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div>
                            <label for="edit_kategori_barang" class="block mb-1 text-sm font-medium">Kategori Barang</label>
                            <select name="kategori_barang" id="edit_kategori_barang" x-model="itemData.kategori_barang" required class="w-full border border-gray-300 p-2 rounded">
                                <option value="" disabled>Pilih Kategori</option>
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
                            <label for="edit_unit_barang" class="block mb-1 text-sm font-medium">Unit</label>
                            <select name="unit_barang" id="edit_unit_barang" x-model="itemData.unit_barang" required class="w-full border border-gray-300 p-2 rounded">
                                <option value="" disabled>Pilih Unit</option>
                                <option value="pcs">Pcs</option>
                                <option value="roll">Roll</option>
                                <option value="pak">Pak</option>
                                <option value="lusin">Lusin</option>
                                <option value="meter">Meter</option>
                                <option value="set">Set</option>
                                <option value="box">Box</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                                Perbarui
                            </button>
                            <button type="button" @click="showEditModal = false" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

        <!-- Modal Buat Barang -->
        <div id="modalbuatbarang" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Buat Barang Baru</h3>
                        <button type="button" onclick="document.getElementById('modalbuatbarang').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('homebarangjadi.tambah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="kode_barang" class="block mb-1 text-sm font-medium">Pilih Barang</label>
                            <select name="kode_barang" id="kode_barang" required class="w-full border border-gray-300 p-2 rounded" onchange="updateNamaBarang()">
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach($barang as $item)
                                <option value="{{ $item->kode_barang }}" data-nama="{{ $item->nama_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="nama_barang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                        </div>
                        <div class="md:col-span-2">
                            <label for="stok_barang" class="block mb-1 text-sm font-medium">Jumlah Barang</label>
                            <input type="number" name="stok_barang" id="stok_barang" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                                Buat
                            </button>
                            <button type="button" onclick="document.getElementById('modalbuatbarang').classList.add('hidden')" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function updateNamaBarang() {
                var select = document.getElementById('kode_barang');
                var nama = select.options[select.selectedIndex]?.getAttribute('data-nama') || '';
                document.getElementById('nama_barang').value = nama;
            }
        </script>

        <!-- Modal Tambah Barang Jadi -->
        <div id="modaltambahbarang" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Tambah Barang Jadi</h3>
                        <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('homebarangjadi.updateStok') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="kode_barang_jadi" class="block mb-1 text-sm font-medium">Kode Barang</label>
                            <select name="kode_barang" id="kode_barang_jadi" required class="w-full border border-gray-300 p-2 rounded">
                                <option value="" disabled selected>Pilih Kode Barang</option>
                                @foreach($barang as $item)
                                <option value="{{ $item->kode_barang }}" {{ old('kode_barang') == $item->kode_barang ? 'selected' : '' }}>
                                    {{ $item->kode_barang }} - {{ $item->nama_barang }}
                                </option>
                                @endforeach
                                <option value="lainnya">Lainnya</option>
                            </select>
                            @error('kode_barang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label for="stok_barang_jadi" class="block mb-1 text-sm font-medium">Jumlah Barang</label>
                            <input type="number" name="stok_barang" id="stok_barang_jadi" min="1" required class="w-full border border-gray-300 p-2 rounded" value="{{ old('stok_barang') }}" />
                            @error('stok_barang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                                Perbarui Stok
                            </button>
                            <button type="button" onclick="document.getElementById('modaltambahbarang').classList.add('hidden')" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(item) {
            let modal = document.getElementById('modaleditbarang');
            let alpineInstance = modal.__alpine; // Access Alpine.js instance

            if (alpineInstance) {
                // Set the entire item object to the Alpine.js data
                alpineInstance.$data.itemData = item;

                // Optional: manually set values if x-model doesn't bind immediately
                // or if you prefer direct DOM manipulation for clarity/debug
                document.getElementById('edit_nama_barang').value = item.nama_barang;
                document.getElementById('edit_kategori_barang').value = item.kategori_barang;
                document.getElementById('edit_unit_barang').value = item.unit_barang;
                document.getElementById('edit_stok_barang').value = item.stok_barang;

                // Make sure the modal is visible
                modal.classList.remove('hidden');
            }
        }
    </script>
    @endsection
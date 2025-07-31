@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<div x-data="pageData()" class="min-h-screen bg-gray-50 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold mb-4 text-gray-800">Barang Masuk</h1>
        <p class="text-gray-600 mb-6">Halaman data barang masuk.</p>

        <!-- Search and Filter Section hanya tampil jika tipe == 'jadi' -->
        <div class="p-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <form method="GET" action="{{ route('homebarangmasuk.search') }}">
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
                <button type="button" onclick="document.getElementById('modalbuatbarang').classList.remove('hidden')" class="h-12 w-full sm:w-auto flex-shrink-0 inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white font-semibold px-5 rounded-lg shadow-md transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Tambah Barang Masuk</span>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full w-full text-gray-800">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase font-semibold">No</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Tanggal</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Kode Barang</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Unit</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Jumlah Masuk</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">User</th>
                        <th class="p-4 text-left text-sm uppercase font-semibold">Keterangan</th>
                        <th class="p-4 text-center text-sm uppercase font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($histori as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-center text-gray-500">{{ $loop->iteration }}</td>
                        <td class="p-4 text-left text-gray-600">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }}</td>
                        <td class="p-4 text-left font-mono">{{ $item->barang->kode_barang ?? '-' }}</td>
                        <td class="p-4 text-left font-medium text-gray-900">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $item->barang->unit_barang ?? '' }}
                            </span>
                        </td>
                        <td class="p-4 text-left text-gray-600">{{ $item->jumlah_masuk ?? '-' }}</td>
                        <td class="p-4 text-left text-gray-600">{{ $item->user->username ?? 'N/A' }}</td>
                        <td class="p-4 text-left text-gray-600">{{ $item->keterangan ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('histori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini? Stok akan dikembalikan seperti semula.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-700 transition-colors" title="Hapus Data">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h4 class="text-xl font-semibold mb-1">Belum Ada Data Masuk</h4>
                                <p>Klik tombol "Tambah Masuk" untuk mencatat data baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Buat Barang -->
    <div id="modalbuatbarang" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-4xl">
            <div class="bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Barang Masuk</h3>
                    <button type="button" onclick="document.getElementById('modalbuatbarang').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('homebarangmasuk.tambah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div class="md:col-span-2">
                        <label for="barang_id" class="block mb-1 text-sm font-medium">Pilih Barang</label>
                        <select name="barang_id" id="barang_id" required class="w-full border border-gray-300 p-2 rounded" onchange="updateNamaBarang()">
                            <option value="" disabled selected>Pilih Barang</option>
                            @foreach($barang as $item)
                            <option value="{{ $item->id }}" data-nama="{{ $item->nama_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="nama_barang" class="block mb-1 text-sm font-medium">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                    </div>
                    <div class="md:col-span-2">
                        <label for="jumlah_masuk" class="block mb-1 text-sm font-medium">Jumlah Barang</label>
                        <input type="number" name="jumlah_masuk" id="jumlah_masuk" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="keterangan" class="block mb-1 text-sm font-medium">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
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
            var select = document.getElementById('barang_id');
            var nama = select.options[select.selectedIndex]?.getAttribute('data-nama') || '';
            document.getElementById('nama_barang').value = nama;
        }
    </script>
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
@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Barang Mentah Keluar</h1>

        <div class="mb-6 w-full max-w-7xl mx-auto px-4 flex justify-end">
            <button type="button"
                class="h-12 flex items-center gap-2 bg-green-900 hover:bg-green-700 text-white font-medium px-5 rounded-lg shadow"
                onclick="document.getElementById('modalbarangmentahkeluar').classList.remove('hidden')">
                <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Barang Mentah Keluar
            </button>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-green-900 text-white"> {{-- Warna header diubah untuk membedakan --}}
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Tanggal</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Kategori</th>
                        <th class="p-4 text-center text-sm uppercase">Unit</th>
                        <th class="p-4 text-center text-sm uppercase">Jumlah Keluar</th> {{-- Diubah ke Jumlah Keluar --}}
                        <th class="p-4 text-center text-sm uppercase">User</th>
                        <th class="p-4 text-center text-sm uppercase">Keterangan</th>
                        <th class="p-4 text-center text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histori as $item) {{-- Pastikan Anda melewatkan variabel $histori dari controller --}}
                    <tr class="border-b hover:bg-red-50 transition"> {{-- Warna hover diubah --}}
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td class="p-4 text-center">{{ $item->barang->kode_barang }}</td>
                        <td class="p-4 text-center">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->kategori_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->unit_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->jumlah_keluar }}</td> {{-- Pastikan ini mengambil data jumlah_keluar --}}
                        <td class="p-4 text-center">{{ $item->user->username ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->keterangan ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('histori.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus histori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.25 0C4.2875 0 3.5 0.7875 3.5 1.75H1.75C0.7875 1.75 0 2.5375 0 3.5H12.25C12.25 2.5375 11.4625 1.75 10.5 1.75H8.75C8.75 0.7875 7.9625 0 7 0H5.25ZM1.75 5.25V13.6675C1.75 13.86 1.89 14 2.0825 14H10.185C10.3775 14 10.5175 13.86 10.5175 13.6675V5.25H8.7675V11.375C8.7675 11.865 8.3825 12.25 7.8925 12.25C7.4025 12.25 7.0175 11.865 7.0175 11.375V5.25H5.2675V11.375C5.2675 11.865 4.8825 12.25 4.3925 12.25C3.9025 12.25 3.5175 11.865 3.5175 11.375V5.25H1.7675H1.75Z" fill="#B30000" /> {{-- Warna icon dihapus diubah --}}
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="modalbarangmentahkeluar" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-4xl">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="flex items-center justify-between p-4 border-b">
                        <h3 class="text-xl font-semibold text-gray-900">Barang Mentah Keluar</h3>
                        <button type="button" onclick="document.getElementById('modalbarangmentahkeluar').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('barangmentah.tambahkeluar') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="barang_mentah_id_keluar" class="block mb-1 text-sm font-medium">Pilih Barang Mentah</label>
                            <select name="barang_id" id="barang_mentah_id_keluar" required class="w-full border border-gray-300 p-2 rounded" onchange="updateNamaBarangMentahKeluar()">
                                <option value="" disabled selected>Pilih Barang Mentah</option>
                                @foreach($barangMentah as $item)
                                <option value="{{ $item->id }}" data-nama="{{ $item->nama_barang }}" data-stok="{{ $item->stok_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok_barang }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="nama_barang_mentah_keluar" class="block mb-1 text-sm font-medium">Nama Barang Mentah</label>
                            <input type="text" name="nama_barang" id="nama_barang_mentah_keluar" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                        </div>
                        <div class="md:col-span-2">
                            <label for="jumlah_keluar_mentah" class="block mb-1 text-sm font-medium">Jumlah Keluar</label>
                            <input type="number" name="jumlah_keluar" id="jumlah_keluar_mentah" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                            <p id="stok_tersedia_keluar" class="text-sm text-gray-600 mt-1"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label for="keterangan_keluar_mentah" class="block mb-1 text-sm font-medium">Keterangan</label>
                            <textarea name="keterangan" id="keterangan_keluar_mentah" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                                Tambah
                            </button>
                            <button type="button" onclick="document.getElementById('modalbarangmentahkeluar').classList.add('hidden')" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function updateNamaBarangMentahKeluar() {
                var select = document.getElementById('barang_mentah_id_keluar');
                var selectedOption = select.options[select.selectedIndex];
                var nama = selectedOption?.getAttribute('data-nama') || '';
                var stok = selectedOption?.getAttribute('data-stok') || '0';

                document.getElementById('nama_barang_mentah_keluar').value = nama;
                document.getElementById('stok_tersedia_keluar').innerText = 'Stok tersedia: ' + stok;

                // Set max value for jumlah_keluar based on available stock
                document.getElementById('jumlah_keluar_mentah').setAttribute('max', stok);
            }
        </script>
    </div>
    @endsection
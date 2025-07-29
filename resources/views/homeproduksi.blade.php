@extends('newwelcome')

@section('role_name', 'Admin Produksi')
@section('page_title', 'Pengajuan Barang Mentah')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Pengajuan Barang Mentah</h1>
        <p class="mb-8 text-gray-600">Halaman ini digunakan untuk mengajukan permintaan barang mentah yang diperlukan dalam proses produksi.</p>

        <!-- Form Pengajuan -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 mb-10">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Ajukan Barang Mentah Baru</h2>
            <form action="{{ route('pengajuanbarangmentah.tambah') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                <div>
                    <label for="barang_mentah_id" class="block text-gray-700 mb-2">Nama Barang Mentah</label>
                    <select id="barang_mentah_id" name="barang_id" required class="w-full p-3 border border-gray-300 rounded-lg">
                        <option value="" disabled selected>Pilih Barang Mentah</option>
                        @foreach($barangMentah as $item)
                        <option
                            value="{{ $item->id }}"
                            data-nama="{{ $item->nama_barang }}"
                            data-stok="{{ $item->stok_barang }}"
                            data-unit="{{ $item->unit_barang }}">
                            {{ $item->kode_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok_barang }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="jumlah" class="block text-gray-700 mb-2">Jumlah</label>
                    <div class="flex">
                        <input type="number" id="jumlah" name="jumlah" min="1" required placeholder="Masukkan jumlah"
                            class="w-full p-3 border border-gray-300 rounded-l-lg">
                        <span class="bg-gray-200 text-gray-700 px-4 py-3 rounded-r-lg" name="unit_barang">Unit</span>
                    </div>
                </div>


                <div class="md:col-span-2">
                    <label for="keterangan" class="block text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="w-full p-3 border border-gray-300 rounded-lg"
                        placeholder="Tambahkan keterangan..."></textarea>
                </div>

                <div class="md:col-span-2 flex justify-center">
                    <button type="submit"
                        class="bg-green-900 hover:bg-green-800 text-white font-bold py-3 px-8 rounded-full shadow-md hover:scale-105 transition">
                        Ajukan Permintaan
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Riwayat Pengajuan -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 overflow-x-auto">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Riwayat Pengajuan</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#173720] text-sm text-white uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">NO</th>
                        <th class="px-4 py-3 text-left">Kode Barang</th>
                        <th class="px-4 py-3 text-left">Nama Barang</th>
                        <th class="px-4 py-3 text-left">Stok Barang</th>
                        <th class="px-4 py-3 text-left">Jumlah Pengajuan</th>
                        <th class="px-4 py-3 text-left">Status Pengajuan</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-200">
                    @forelse ($pengajuanProduksi as $req)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $req->barangMentah->kode_barang }}</td>
                        <td class="px-4 py-2">{{ $req->barangMentah->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $req->barangMentah->stok_barang }}</td>
                        <td class="px-4 py-2">{{ $req->jumlah_pengajuan }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                @if($req->status_pengajuan == 'diajukan')
                                bg-yellow-100 text-yellow-800
                                @elseif($req->status_pengajuan == 'disetujui')
                                bg-green-100 text-green-800
                                @else
                                bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($req->status_pengajuan) }}
                            </span>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-gray-500">Belum ada pengajuan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectBarang = document.getElementById('barang_mentah_id');
        const unitSpan = document.querySelector('span[name="unit_barang"]');

        selectBarang.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const unit = selectedOption.getAttribute('data-unit');
            unitSpan.textContent = unit ? unit : 'Unit';
        });
    });
</script>

@endsection
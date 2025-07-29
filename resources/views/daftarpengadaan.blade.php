@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Daftar Pengadaan Barang Mentah</h1>
        <p class="mb-8 text-gray-600">Permintaan pengadaan barang mentah.</p>

        <div class="mb-6 w-full max-w-7xl mx-auto px-4 flex justify-end">
            <button type="button"
                class="h-12 flex items-center gap-2 bg-[#173720] hover:bg-green-700 text-white font-medium px-5 rounded-lg shadow"
                onclick="document.getElementById('modalpengadaan').classList.remove('hidden')">
                <svg class="h-6 w-6" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Ajukan Pengadaan Barang Mentah
            </button>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Tanggal Pengajuan</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Kategori Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Jumlah Pengajuan</th>
                        <th class="p-4 text-center text-sm uppercase">Unit Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Pengajuan Oleh</th>
                        <th class="p-4 text-center text-sm uppercase">Status Pengajuan</th>
                    </tr>
                </thead>
                <tbody id="data-barang-masuk">
                    @foreach ($pengadaan as $item)
                    <tr class="border-b hover:bg-red-50 transition">
                        <td class="p-4 text-center">{{ $loop->iteration }}</td>
                        <td class="p-4 text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengadaan)->format('d-m-Y') }}
                        </td>

                        <td class="p-4 text-center">{{ $item->barang->kode_barang }}</td>
                        <td class="p-4 text-center">{{ $item->barang->nama_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->barang->kategori_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->jumlah }}</td>
                        <td class="p-4 text-center">{{ $item->barang->unit_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->user->username ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $item->status_pengadaan ?? '-' }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalpengajuanpengadaan" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-4xl">
        <div class="bg-white rounded-lg shadow-sm">
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">Pengajuan Pengadaan Barang Mentah</h3>
                <button type="button" onclick="document.getElementById('modalpengajuanpengadaan').classList.add('hidden')" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg text-sm p-2.5 inline-flex items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('pengadaanbarangmentah') }}" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="md:col-span-2">
                    <label for="pengajuan_barangmentah_id" class="block mb-1 text-sm font-medium">Pilih Barang Mentah</label>
                    <select name="barang_id" id="barang_mentah_id" required class="w-full border border-gray-300 p-2 rounded" onchange="updateNamaBarangMentahKeluar()">
                        <option value="" disabled selected>Pilih Barang Mentah</option>
                        @foreach($barangMentah as $item)
                        <option value="{{ $item->id }}" data-nama="{{ $item->nama_barang }}" data-stok="{{ $item->stok_barang }}">{{ $item->kode_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok_barang }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="nama_barang_mentah" class="block mb-1 text-sm font-medium">Nama Barang Mentah</label>
                    <input type="text" name="nama_barang" id="nama_barang_mentah" required class="w-full border border-gray-300 p-2 rounded bg-gray-100" readonly />
                </div>
                <div class="md:col-span-2">
                    <label for="jumlah" class="block mb-1 text-sm font-medium">Jumlah Pengajuan</label>
                    <input type="number" name="jumlah" id="jumlah" min="1" required class="w-full border border-gray-300 p-2 rounded" />
                    <p id="stok_tersedia" class="text-sm text-gray-600 mt-1"></p>
                </div>
                <div class="md:col-span-2 flex justify-end gap-2 pt-2">
                    <button type="submit" class="px-4 py-2 text-white bg-green-900 rounded-md hover:bg-green-700">
                        Ajukan Barang Mentah
                    </button>
                    <button type="button" onclick="document.getElementById('modalpengajuanpengadaan').classList.add('hidden')" class="px-4 py-2 border rounded-md hover:bg-gray-200">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection




@push('scripts')
<script>
    function updateNamaBarangMentahKeluar() {
        var select = document.getElementById('barang_mentah_id');
        var selectedOption = select.options[select.selectedIndex];
        var nama = selectedOption?.getAttribute('data-nama') || '';
        var stok = selectedOption?.getAttribute('data-stok') || '0';

        document.getElementById('nama_barang_mentah').value = nama;
        document.getElementById('stok_tersedia').innerText = 'Stok tersedia: ' + stok;

        // Set max value for jumlah_keluar based on available stock
        document.getElementById('jumlah');
    }
</script>
@endpush
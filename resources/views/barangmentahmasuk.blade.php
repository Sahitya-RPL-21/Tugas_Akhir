@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Barang Mentah Masuk</h1>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Tanggal</th>
                        <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
                        <th class="p-4 text-center text-sm uppercase">Supplier</th>
                        <th class="p-4 text-center text-sm uppercase">Invoice</th>
                        <th class="p-4 text-center text-sm uppercase">Jumlah Masuk</th>
                        <th class="p-4 text-center text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data-barang-masuk">
                    {{-- DIUBAH: Tampilan awal tabel --}}
                    <tr>
                        <td colspan="10" class="p-6 text-center text-gray-500">
                            Tekan tombol "Sinkronisasi Data" untuk memuat data terbaru.
                        </td>
                    </tr>
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
    document.addEventListener('DOMContentLoaded', function() {
        loadData();
    });

    function loadData() {
        const tbody = document.getElementById('data-barang-masuk');
        tbody.innerHTML = '<tr><td colspan="10" class="p-6 text-center">Memuat data...</td></tr>';

        fetch('http://178.128.216.105/api/pengadaan')
            .then(response => response.json())
            .then(result => {
                renderTable(result.rows || []);
            });
    }

    function renderTable(items) {
        const tbody = document.getElementById('data-barang-masuk');
        tbody.innerHTML = '';

        if (!items || items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="10" class="p-6 text-center text-gray-500">Data tidak ditemukan atau kosong.</td></tr>';
            return;
        }

        items.forEach((item, index) => {
            const tanggal = new Date(item.tanggal_pembelian).toLocaleDateString('id-ID');
            const kodeBarang = item.barang?.kode_barang ?? '-';
            const namaBarang = item.barang?.nama ?? '-';
            const supplier = item.supplier?.nama_supplier ?? '-';
            const invoice = item.no_invoice ?? '-';
            const jumlahMasuk = item.jumlah_masuk;

            const row = document.createElement('tr');
            row.classList.add('border-b', 'hover:bg-green-50', 'transition');

            row.innerHTML = `
                <td class="p-4 text-center">${index + 1}</td>
                <td class="p-4 text-center">${tanggal}</td>
                <td class="p-4 text-center">${kodeBarang}</td>
                <td class="p-4 text-center">${namaBarang}</td>
                <td class="p-4 text-center">${supplier}</td>
                <td class="p-4 text-center">${invoice}</td>
                <td class="p-4 text-center">${jumlahMasuk}</td>
                <td class="p-4 text-center">
                    <button
                        class="add-to-stock bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm"
                        data-kode="${kodeBarang}"
                        data-jumlah="${jumlahMasuk}"
                    >Tambah ke Stok</button>
                </td>
            `;

            tbody.appendChild(row);
        });

        // Tambahkan event listener ke setiap tombol
        document.querySelectorAll('.add-to-stock').forEach(button => {
            button.addEventListener('click', function() {
                const kode = this.getAttribute('data-kode');
                const jumlah = this.getAttribute('data-jumlah');
                tambahStok(kode, jumlah, this);
            });
        });
    }

    function tambahStok(kode_barang, jumlah, btnElement) {
        fetch('/barang/import-stok', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    kode_barang,
                    jumlah
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    btnElement.textContent = 'Sudah Ditambahkan';
                    btnElement.disabled = true;
                    btnElement.classList.remove('bg-green-600', 'hover:bg-green-700');
                    btnElement.classList.add('bg-gray-400', 'cursor-not-allowed');
                } else {
                    alert(result.message || 'Gagal menambahkan stok');
                }
            })
            .catch(() => alert('Terjadi kesalahan saat menghubungi server.'));
    }


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
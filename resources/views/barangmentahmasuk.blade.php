@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Barang Mentah Masuk</h1>

        <div class="mb-6 w-full max-w-7xl mx-auto px-4 flex justify-end gap-4">
            {{-- Tombol untuk memicu pengambilan data --}}
            <!-- <button type="button"
                id="refresh-button"
                class="h-12 flex items-center justify-center gap-2 bg-[#173720] border border-green-900 text-white hover:bg-green-800 font-medium px-5 rounded-lg shadow transition-colors duration-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 4v6h6M20 20v-6h-6M4 10a9 9 0 0114.32-6.36M20 14a9 9 0 01-14.32 6.36" />
                </svg>
                {{-- DIUBAH: Teks tombol diperjelas --}}
                Sinkronisasi Data
            </button> -->
        </div>

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

        {{-- Modal tidak diubah --}}
        <div id="modalmasukbarangmentah" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 ...">
            {{-- ... Isi modalmu tetap di sini ... --}}
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
</script>
@endpush
@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Barang Mentah Masuk</h1>

        <div class="mb-6 w-full max-w-7xl mx-auto px-4 flex justify-end gap-4">
            {{-- Tombol untuk memicu pengambilan data --}}
            <button type="button"
                id="refresh-button"
                class="h-12 flex items-center justify-center gap-2 bg-[#173720] border border-green-900 text-white hover:bg-green-800 font-medium px-5 rounded-lg shadow transition-colors duration-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 4v6h6M20 20v-6h-6M4 10a9 9 0 0114.32-6.36M20 14a9 9 0 01-14.32 6.36" />
                </svg>
                {{-- DIUBAH: Teks tombol diperjelas --}}
                Sinkronisasi Data
            </button>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
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
                        <th class="p-4 text-center text-sm uppercase">User</th>
                        <th class="p-4 text-center text-sm uppercase">Keterangan</th>
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
    // Menunggu seluruh halaman HTML dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Cari tombol berdasarkan ID
        const refreshButton = document.getElementById('refresh-button');

        // Tambahkan event listener 'click' ke tombol
        if (refreshButton) {
            refreshButton.addEventListener('click', loadData);
        }
    });

    // Fungsi untuk mengambil dan menampilkan data
    function loadData() {
        const tbody = document.getElementById('data-barang-masuk');
        const refreshButton = document.getElementById('refresh-button');
        const originalButtonHTML = refreshButton.innerHTML;

        tbody.innerHTML = '<tr><td colspan="10" class="p-6 text-center">Memuat data...</td></tr>';
        refreshButton.disabled = true;
        refreshButton.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5M20 20v-5h-5M4 9a8 8 0 0113.5-5.65M20 15a8 8 0 01-13.5 5.65"></path>
            </svg>
            <span>Memperbarui...</span>`;

        // Ganti URL ini ke API aslimu jika sudah siap
        // fetch('/api/barang-masuk') 
        fetch('http://178.128.216.105/api/pengadaan')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(result => {
                renderTable(result.data);
            })
            .catch(error => {
                console.error("Error saat fetch:", error);
                tbody.innerHTML = `<tr><td colspan="10" class="p-6 text-center text-red-600">Gagal memuat data. Cek DevTools Console (F12).</td></tr>`;
            })
            .finally(() => {
                refreshButton.disabled = false;
                refreshButton.innerHTML = originalButtonHTML;
            });
    }

    // Fungsi untuk merender data ke dalam tabel
    function renderTable(items) {
        const tbody = document.getElementById('data-barang-masuk');
        tbody.innerHTML = '';

        if (!items || items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="10" class="p-6 text-center text-gray-500">Data tidak ditemukan atau kosong.</td></tr>';
            return;
        }

        items.forEach((item, index) => {
            const tanggal = new Date(item.created_at).toLocaleString('id-ID', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            }).replace(/\./g, ':');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const row = `
                <tr class="border-b hover:bg-green-50 transition">
                    <td class="p-4 text-center">${index + 1}</td>
                    <td class="p-4 text-center">${tanggal}</td> 
                    <td class="p-4 text-center">${item.barang?.kode_barang ?? '-'}</td>
                    <td class="p-4 text-center">${item.barang?.nama_barang ?? '-'}</td>
                    <td class="p-4 text-center">${item.barang?.kategori_barang ?? '-'}</td>
                    <td class="p-4 text-center">${item.barang?.unit_barang ?? '-'}</td>
                    <td class="p-4 text-center">${item.jumlah_masuk}</td>
                    <td class="p-4 text-center">${item.user?.username ?? '-'}</td>
                    <td class="p-4 text-center">${item.keterangan ?? '-'}</td>
                    <td class="p-4 text-center">
                        <form action="/histori/${item.id}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus histori ini?');">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.25 0C4.2875 0 3.5 0.7875 3.5 1.75H1.75C0.7875 1.75 0 2.5375 0 3.5H12.25C12.25 2.5375 11.4625 1.75 10.5 1.75H8.75C8.75 0.7875 7.9625 0 7 0H5.25ZM1.75 5.25V13.6675C1.75 13.86 1.89 14 2.0825 14H10.185C10.3775 14 10.5175 13.86 10.5175 13.6675V5.25H8.7675V11.375C8.7675 11.865 8.3825 12.25 7.8925 12.25C7.4025 12.25 7.0175 11.865 7.0175 11.375V5.25H5.2675V11.375C5.2675 11.865 4.8825 12.25 4.3925 12.25C3.9025 12.25 3.5175 11.865 3.5175 11.375V5.25H1.7675H1.75Z" fill="#123524"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>`;
            tbody.innerHTML += row;
        });
    }
</script>
@endpush
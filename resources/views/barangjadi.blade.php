<table class="min-w-full w-full text-gray-700">
    <thead class="bg-[#173720] text-white">
        <tr>
            <th class="p-4 text-center text-sm uppercase">No</th>
            <th class="p-4 text-center text-sm uppercase">Kode Barang</th>
            <th class="p-4 text-center text-sm uppercase">Nama Barang</th>
            <th class="p-4 text-center text-sm uppercase">Kategori</th>
            <th class="p-4 text-center text-sm uppercase">Stok</th>
            <th class="p-4 text-center text-sm uppercase">Status</th>
            <th class="p-4 text-center text-sm uppercase">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $item)
        <tr class="border-b hover:bg-green-50 transition">
            <td class="p-4 text-center"></td>
            <td class="p-4 text-center">{{$item->kode_barang }}</td>
            <td class="p-4 text-center">{{$item->nama_barang}}</td>
            <td class="p-4 text-center">{{$item->kategori_barang}}</td>
            <td class="p-4 text-center">{{$item->stok_barang}}</td>
            <td class="p-4 text-center font-semibold text-green-600">{{$item->status_barang}}</td>
            <td class="p-4 text-center">
                <button class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 0L8.75 1.75L12.25 5.25L14 3.5L10.5 0ZM7 3.5L0 10.5V14H3.5L10.5 7L7 3.5Z" fill="#123524" />
                    </svg>
                </button>
                <button class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.25 0C4.2875 0 3.5 0.7875 3.5 1.75H1.75C0.7875 1.75 0 2.5375 0 3.5H12.25C12.25 2.5375 11.4625 1.75 10.5 1.75H8.75C8.75 0.7875 7.9625 0 7 0H5.25ZM1.75 5.25V13.6675C1.75 13.86 1.89 14 2.0825 14H10.185C10.3775 14 10.5175 13.86 10.5175 13.6675V5.25H8.7675V11.375C8.7675 11.865 8.3825 12.25 7.8925 12.25C7.4025 12.25 7.0175 11.865 7.0175 11.375V5.25H5.2675V11.375C5.2675 11.865 4.8825 12.25 4.3925 12.25C3.9025 12.25 3.5175 11.865 3.5175 11.375V5.25H1.7675H1.75Z" fill="#123524" />
                    </svg>
                </button>
            </td>
        </tr>
        @endforeach

        <!-- Modal Edit Barang -->
        <div id="openditModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <button onclick="closeEditModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <h2 class="text-lg font-semibold mb-4">Edit Barang</h2>
                <form id="editBarangForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Kode Barang</label>
                        <input type="text" name="kode_barang" id="edit_kode_barang" class="w-full border rounded px-3 py-2" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Nama Barang</label>
                        <input type="text" name="nama_barang" id="edit_nama_barang" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Kategori</label>
                        <input type="text" name="kategori_barang" id="edit_kategori_barang" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Stok</label>
                        <input type="number" name="stok_barang" id="edit_stok_barang" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status_barang" id="edit_status_barang" class="w-full border rounded px-3 py-2" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 mr-2 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                        <button type="submit" class=" px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditModal(item) {
                document.getElementById('edit_kode_barang').value = item.kode_barang;
                document.getElementById('edit_nama_barang').value = item.nama_barang;
                document.getElementById('edit_kategori_barang').value = item.kategori_barang;
                document.getElementById('edit_stok_barang').value = item.stok_barang;
                document.getElementById('edit_status_barang').value = item.status_barang;
                document.getElementById('editBarangForm').action = '/barangjadi/' + item.id;
                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }
        </script>
    </tbody>
</table>
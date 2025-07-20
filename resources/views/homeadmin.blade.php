@extends('newwelcome')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Manajemen Akun Pengguna</h1>

    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Akun Pengguna</h2>
        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        <div class="overflow-x-auto">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white">
                    <tr>
                        <th class="p-4 text-center text-sm uppercase">No</th>
                        <th class="p-4 text-center text-sm uppercase">Username</th>
                        <th class="p-4 text-center text-sm uppercase">Role</th>
                        <th class="p-4 text-center text-sm uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 text-center">{{ $user->username }}</td>
                        <td class="py-3 px-4 text-center">{{ ucfirst($user->role) }}</td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 mr-2" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.25 0C4.2875 0 3.5 0.7875 3.5 1.75H1.75C0.7875 1.75 0 2.5375 0 3.5H12.25C12.25 2.5375 11.4625 1.75 10.5 1.75H8.75C8.75 0.7875 7.9625 0 7 0H5.25ZM1.75 5.25V13.6675C1.75 13.86 1.89 14 2.0825 14H10.185C10.3775 14 10.5175 13.86 10.5175 13.6675V5.25H8.7675V11.375C8.7675 11.865 8.3825 12.25 7.8925 12.25C7.4025 12.25 7.0175 11.865 7.0175 11.375V5.25H5.2675V11.375C5.2675 11.865 4.8825 12.25 4.3925 12.25C3.9025 12.25 3.5175 11.865 3.5175 11.375V5.25H1.7675H1.75Z" fill="#123524" />
                                    </svg>
                                </button>
                            </form>
                            <button onclick="openEditModal('{{ $user->id }}', '{{ $user->username }}', '{{ $user->role }}')" class="text-blue-600 hover:text-blue-800">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 0L8.75 1.75L12.25 5.25L14 3.5L10.5 0ZM7 3.5L0 10.5V14H3.5L10.5 7L7 3.5Z" fill="#123524" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex justify-center mt-6">
        <button onclick="document.getElementById('tambahAkunPengguna').classList.remove('hidden')" class="py-2 px-4 bg-[#173720] text-white rounded-lg hover:bg-green-800 focus:outline-none">
            + Buat Pengguna Baru
        </button>
    </div>

    <div id="tambahAkunPengguna" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Pengguna Baru</h2>
            <form action="{{ route('tambahpenggunamodal') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" class="w-full border border-gray-300 p-2 rounded" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="user">Admin Stok</option>
                        <option value="kepala">Kepala TPKU</option>
                        <option value="admin">Super Admin</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('tambahAkunPengguna').classList.add('hidden')" class="py-2 px-4 bg-gray-300 text-gray-800 rounded-lg mr-2 hover:bg-gray-400 focus:outline-none">
                        Batal
                    </button>
                    <button type="submit" class="py-2 px-4 bg-[#173720] text-white rounded-lg hover:bg-green-800 focus:outline-none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    <!-- Modal Edit User -->
    <div id="editAkunPengguna" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Edit Pengguna</h2>
            <form id="editUserForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editUserId" name="id">
                <div class="mb-4">
                    <label for="editUsername" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="editUsername" name="username" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editRole" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="editRole" name="role" class="w-full border border-gray-300 p-2 rounded" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="user">Admin Stok</option>
                        <option value="kepala">Kepala TPKU</option>
                        <option value="admin">Super Admin</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="editUserPassword" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="editUserPassword" name="password" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="toggleEditModal()" class="py-2 px-4 bg-gray-300 text-gray-800 rounded-lg mr-2 hover:bg-gray-400 focus:outline-none">
                        Batal
                    </button>
                    <button type="submit" class="py-2 px-4 bg-[#173720] text-white rounded-lg hover:bg-green-800 focus:outline-none">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('tambahUser');
            modal.classList.toggle('hidden');
        }
    </script>

    <script>
        function openEditModal(id, username, role) {
            document.getElementById('editAkunPengguna').classList.remove('hidden');
            document.getElementById('editUserId').value = id;
            document.getElementById('editUsername').value = username;
            document.getElementById('editRole').value = role;
            document.getElementById('editUserPassword').value = '';
            document.getElementById('editUserForm').action = '/users/' + id;
        }

        function toggleEditModal() {
            document.getElementById('editAkunPengguna').classList.add('hidden');
        }
    </script>

    @endsection
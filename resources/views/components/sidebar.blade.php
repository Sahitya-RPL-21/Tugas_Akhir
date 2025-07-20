@php
$role = Auth::user()->role;
@endphp

<div class="hidden peer-checked:flex flex flex-col w-64 bg-green-900 transition-all duration-300 ease-in-out">
    <div class="flex items-center justify-between h-16 bg-green-900 px-4">
        <span class="text-white font-bold uppercase">STOKIN</span>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-[#173720]">
            {{-- Semua Role: Beranda --}}
            <a href="/" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                <!-- ikon -->
                <svg width="24" height="24" ...>...</svg>
                Beranda
            </a>
            @endif

            {{-- Admin Stok: Master Barang --}}
            @if ($role === 'admin')
            <a href="/masterbarang" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                <!-- ikon -->
                <svg width="24" height="24" ...>...</svg>
                Master Barang
            </a>
            @endif

            {{-- Admin Stok: Stok Barang --}}
            @if ($role === 'admin' || $role === 'kepala')
            <a href="/stokbarang" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                <!-- ikon -->
                <svg width="24" height="24" ...>...</svg>
                Stok Barang
            </a>
            @endif

            {{-- Admin Stok: Stok Opname --}}
            @if ($role === 'admin')
            <a href="/stokopname" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                <!-- ikon -->
                <svg width="24" height="24" ...>...</svg>
                Stok Opname
            </a>
            @endif

            {{-- Laporan: Admin Stok, Kepala TPKU}}
            @if ($role === 'admin_stok || $role === 'kepala')
            <a href="/laporanbarang" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                <!-- ikon -->
                <svg width="24" height="24" ...>...</svg>
                Laporan Barang
            </a>
            @endif

            {{-- Admin Stok: Barang Mentah Masuk --}}
            @if ($role === 'admin')
            <a href="/stokopname" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                <!-- ikon -->
                <svg width="24" height="24" ...>...</svg>
                Stok Opname
            </a>
            @endif


            {{-- Tombol Logout: semua role --}}
            <button onclick="document.getElementById('logoutModal').classList.remove('hidden')" class="flex items-center gap-3 w-full bg-[#c0392b] hover:bg-[#e74c3c] p-2 rounded-md text-white text-sm transition">
                <svg width=" 24" height="24" ...>...</svg>
                Log Out
            </button>
        </nav>
    </div>
</div>

<div class="flex flex-col flex-1 overflow-y-auto">
    <!-- header -->
    <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
        <div class="flex items-center px-4 py-6">
            <label for="menu-toggle" class="mr-4 bg-green-900 text-white p-2 rounded focus:outline-none cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-sm font-bold text-gray-700 pr-8">{{ strtoupper($role) }}</span>
        </div>
    </div>

    <section>
        @yield('content')
    </section>
</div>

<!-- Modal Log Out -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 text-center">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Logout</h2>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin logout?</p>
        <div class="flex justify-center gap-4">
            <button onclick="document.getElementById('logoutModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                Batal
            </button>
            <a href="{{ route('logout') }}" class="px-4 py-2 bg-[#173720] text-white rounded-lg hover:bg-green-900 transition">
                Logout
            </a>
        </div>
    </div>
</div>
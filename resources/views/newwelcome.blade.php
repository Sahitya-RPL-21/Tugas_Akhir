<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STOKIN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/gambar/stokinlogo.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
        }
    </style>
</head>

<body class="">
    <div class="flex min-h-screen bg-gray-100">

        <input type="checkbox" id="menu-toggle" class="hidden peer" checked>

        <div class="hidden peer-checked:flex flex flex-col w-64 bg-green-900 transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-between h-16 bg-green-900 px-4">
                <div class="flex justify-center w-full">
                    <img src="{{ asset('assets/gambar/stokin.png') }}" alt="Logo" class="h-14">
                </div>
            </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-2 py-4 bg-[#173720]">
                    <a href="/" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('/') ? 'bg-green-900 font-bold' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 22V10L12 2L2 10V22H8V13H16V22H22Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M12 22V17" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Beranda
                    </a>
                    <a href="/masterbarang" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('masterbarang') ? 'bg-green-900 font-bold' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 5H21V19H3V5Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M7 5V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 19V21C3 21.5523 3.44772 22 4 22H20C20.5523 22 21 21.5523 21 21V19" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Master Barang
                    </a>
                    <a href="/stokbarang" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('stokbarang*') ? 'bg-green-900 font-bold' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="4" width="16" height="16" rx="2" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M8 8H16V16H8V8Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                        Stok Barang
                    </a>
                    <a href="/stokopname" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('stokopname*') ? 'bg-green-900 font-bold' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="18" height="18" rx="2" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M8 9H16M8 13H14" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        Stok Opname
                    </a>
                    <a href="/homebarangmasuk" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('stokbarang*') ? 'bg-green-900 font-bold' : '' }}">
                        <svg class="h-6 w-6 text-green-200" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.4953 3.375H3.375V23.625H13.5" stroke="white" stroke-width="1.6875" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.0625 18.5625L9 13.5L14.0625 8.4375" stroke="white" stroke-width="1.6875" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M23.625 13.4954H9" stroke="white" stroke-width="1.6875" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Barang Masuk
                    </a>
                    <a href="/homebarangkeluar" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('barangmentah*') ? 'bg-green-900 font-bold' : '' }}">
                        <svg class="h-6 w-6 text-yellow-200" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.9955 3.25H3.25V22.75H13" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17.875 17.875L22.75 13L17.875 8.125" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8.66669 12.9955H22.75" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Barang Keluar
                    </a>
                    <a href="/laporanbarang" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group {{ Request::is('laporanbarang*') ? 'bg-green-900 font-bold' : '' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="MS16 3H11V21H16V3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M21 3H16V21H21V3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M5 3L9 3.5L7.25 21L3 20.5L5 3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M18.5 9V7.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.5 9V7.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Laporan Barang
                    </a>
                    <div class="mb-2 relative group">
                        @auth
                        @if(auth()->user()->role === 'admin')
                        <a href="/tambahuser" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-green-900 group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 20C4 16.6863 7.58172 14 12 14C16.4183 14 20 16.6863 20 20" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 8H20M18 6V10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Tambah User
                        </a>
                        @endif
                        @endauth
                        @if (Request::is('kepala*'))
                        <a href="/kepala" class="flex items-center rounded-md gap-x-2 w-full px-4 py-2 mt-2 text-left 
                        {{ Request::is('kepala*') ? 'bg-green-900' : '' }} text-gray-100 hover:bg-green-900 group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 3H21V21H3V3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M7 7H17V17H7V7Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M10 10H14V14H10V10Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                            Data Penjualan
                        </a>
                        @endif
                    </div>
                    <button onclick="document.getElementById('logoutModal').classList.remove('hidden')" class="flex items-center gap-3 w-full bg-[#c0392b] hover:bg-[#e74c3c] p-2 rounded-md text-white text-sm transition">
                        <svg width=" 24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 3H9C7.89543 3 7 3.89543 7 5V19C7 20.1046 7.89543 21 9 21H15C16.1046 21 17 20.1046 17 19V5C17 3.89543 16.1046 3 15 3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M10 12H21M21 12L18 9M21 12L18 15" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Log Out
                    </button>
                </nav>
            </div>
        </div>

        <div class="flex flex-col flex-1 overflow-y-auto">
            <!-- header -->
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4 py-6">
                    <label for="menu-toggle"
                        class="mr-4 bg-green-900 text-white p-2 rounded focus:outline-none cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="white">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-bold text-gray-700 pr-8">@yield('page_title', 'SUPERADMIN')</span>
                </div>
            </div>
            <section>
                @yield('content')
            </section>
        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
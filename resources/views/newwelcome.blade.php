<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALERI INVENTARIS TPKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">
    <div class="flex h-screen bg-gray-100">

        <input type="checkbox" id="menu-toggle" class="hidden peer" checked>

        <div class="hidden peer-checked:flex flex flex-col w-64 bg-green-800 transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-between h-16 bg-green-900 px-4">
                <span class="text-white font-bold uppercase">Galeri Inventaris</span>
            </div>

            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-2 py-4 bg-green-800">
                    <a href="/" class="flex items-center w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-gray-700 group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 22V10L12 2L2 10V22H8V13H16V22H22Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M12 22V17" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Beranda
                    </a>
                    <a href="/daftarbarang" class="flex items-center w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-gray-700 group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.5 5L4 6.5L7 3.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2.5 12L4 13.5L7 10.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2.5 19L4 20.5L7 17.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.5 12H21.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.5 19H21.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.5 5H21.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Daftar Barang
                    </a>

                    <div class="mb-2 relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="absolute top-2 left-4 text-white hidden group-hover:block peer-checked:block h-6 w-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                        </svg>
                    </div>
                    <a href="laporanbarang" class="flex items-center w-full px-4 py-2 mt-2 text-left text-gray-100 hover:bg-gray-700 group">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 3H11V21H16V3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M21 3H16V21H21V3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M5 3L9 3.5L7.25 21L3 20.5L5 3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M18.5 9V7.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.5 9V7.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Laporan Barang
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mb-4">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-left text-gray-100 hover:bg-gray-700 group">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 3H9C7.89543 3 7 3.89543 7 5V19C7 20.1046 7.89543 21 9 21H15C16.1046 21 17 20.1046 17 19V5C17 3.89543 16.1046 3 15 3Z" stroke="white" stroke-width="1.5" stroke-linejoin="round" />
                                <path d="M10 12H21M21 12L18 9M21 12L18 15" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Log Out
                        </button>
                    </form>
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
                    <span class="text-gray-700 mfont-semibold hidden sm:inline">ADMIN STOK</span>
                    <img src="https://ui-avatars.com/api/?name=User&background=1f2937&color=fff&size=32"
                        alt="Profile"
                        class="w-8 h-8 rounded-full border-2 border-gray-300 cursor-pointer">
                </div>
            </div>

            <section>
                @yield('content')
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
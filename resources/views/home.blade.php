@extends('newwelcome')

@section('content')

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Beranda</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
<style>
</style>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
	<div class="flex h-screen bg-gray-100">

		<input type="checkbox" id="menu-toggle" class="hidden peer" checked>

		<div class="hidden peer-checked:flex flex flex-col w-64 bg-green-800 transition-all duration-300 ease-in-out">
			<div class="flex items-center justify-between h-16 bg-green-900 px-4">
				<span class="text-white font-bold uppercase">Galeri Inventaris</span>
			</div>

			<div class="flex flex-col flex-1 overflow-y-auto">
				<nav class="flex-1 px-2 py-4 bg-green-800">
					<a href="#" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700 group">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 group-hover:transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24"
							stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M4 6h16M4 12h16M4 18h16" />
						</svg>
						Beranda
					</a>
					<a href="#" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700 group">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="group-hover:hidden h-6 w-6 mr-2">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden group-hover:block h-6 w-6 mr-2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
						  </svg>						  
						Daftar Barang
					</a>

					<div class="mb-2 relative group">
						<input type="checkbox" id="messages-toggle" class="hidden peer">
					
						<label for="messages-toggle"
							class="flex items-center px-12 py-2 mt-2 text-gray-100 hover:bg-gray-700 cursor-pointer w-full">
							Tambah Barang
						</label>
					
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
							class="absolute top-2 left-4 text-white group-hover:hidden h-6 w-6 mr-2 peer-checked:hidden">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
						</svg>
				
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
							class="absolute top-2 left-4 text-white hidden group-hover:block peer-checked:block h-6 w-6 mr-2">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
						</svg>
					</div>
					
					<a href="#" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700 group">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="h-6 w-6 mr-2 group-hover:hidden">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden group-hover:block h-6 w-6 mr-2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
						</svg>
						Laporan Barang
					</a>
				</nav>
			</div>
		</div>

		<div class="flex flex-col flex-1 overflow-y-auto">
			<div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
				<div class="flex items-center px-4">
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
        			<span class="text-gray-700 mfont-semibold hidden sm:inline">Admin Stok</span>
        				<img src="https://ui-avatars.com/api/?name=User&background=1f2937&color=fff&size=32"
             				 alt="Profile"
             			class="w-8 h-8 rounded-full border-2 border-gray-300 cursor-pointer">
    				</div>
			</div>
			<div class="p-4">
				<h1 class="text-2xl font-bold">Beranda</h1>
			</div>

			<div class="flex justify-end items-center space-x-4 mb-6">
      				<a href="#barang-masuk" class="bg-green-900 text-white px-4 py-2 rounded-md flex items-center space-x-2 hover:bg-green-800">
        			<span>Barang Masuk</span>
        			<span class="text-xl font-bold">+</span>
      			</a>
      				<a href="#barang-keluar" class="bg-red-700 text-white px-4 py-2 rounded-md flex items-center space-x-2 hover:bg-red-600">
        			<span>Barang Keluar</span>
       				<span class="text-xl font-bold">−</span>
     			</a>
    		</div>

			<div x-show="activeSection === 'dashboard'" class="space-y-6 px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700">Stok Masuk</h2>
                        <p class="text-2xl font-bold text-green-600">12</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700">Stok Keluar</h2>
                        <p class="text-2xl font-bold text-yellow-600">3</p>
                    </div>
                </div>
            </div>


  				<div class="p-6 bg-white rounded shadow mt-6 mx-4">
   					 <h2 class="text-lg font-semibold text-gray-700 mb-5">Statistik Order</h2>
    				<canvas id="orderChart" width="400" height="200"></canvas>
				<div>

		</div>
	</div>

	
</body>
<script>
  const ctx = document.getElementById('orderChart').getContext('2d');
  const orderChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
      datasets: [{
        label: 'Total Orders',
        data: [5, 10, 3, 8, 6, 12],
        backgroundColor: 'rgba(34, 197, 94, 0.6)',
        borderColor: 'rgba(34, 197, 94, 1)',
        borderWidth: 1,
        borderRadius: 6,
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 2
          }
        }
      }
    }
  });
</script>

</html>
@endsection
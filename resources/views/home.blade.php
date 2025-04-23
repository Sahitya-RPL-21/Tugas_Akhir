@extends('newwelcome')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- content -->
<div class="p-4">
	<h1 class="text-2xl font-bold">Beranda</h1>
</div>
<div class="space-y-6 px-4">
	<div class="flex justify-end items-center space-x-4 mb-6">
		<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="bg-green-900 text-white px-4 py-2 rounded-md flex items-center space-x-2 hover:bg-green-800" type="button">
			<span>Barang Masuk</span>
			<span class="text-xl font-bold">+</span>
		</button>
		<a href="#barang-keluar" class="bg-red-700 text-white px-4 py-2 rounded-md flex items-center space-x-2 hover:bg-red-600">
			<span>Barang Keluar</span>
			<span class="text-xl font-bold">−</span>
		</a>
	</div>
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

<!-- Tambah Barang -->
<!-- modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
	<div class="relative p-4 w-full max-w-md max-h-full">
		<!-- Modal content -->
		<div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-100">
			<!-- Modal header -->
			<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
				<h3 class="text-xl font-semibold text-gray-900 dark:text-gray">
					Tambahkan Barang
				</h3>
				<button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-green-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-green-800 dark:hover:text-white" data-modal-hide="authentication-modal">
					<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
					</svg>
					<span class="sr-only">Close modal</span>
				</button>
			</div>
			<!-- Modal body -->
			<div class="p-4 md:p-5">
				<form class="space-y-4" action="#">
					<div>
						<label for="nomorbarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Nomor Barang</label>
						<input type="text" name="nomorbarang" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-gray" />
					</div>
					<div>
						<label for="namabarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Nama Barang</label>
						<input type="text" name="namabarang" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-gray" />
					</div>
					<div>
						<label for="kategoribarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Kategori Barang</label>
						<select class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-00 dark:border-gray-500 dark:placeholder-gray-400 dark:text-gray" id="kategori_barang" name="kategori_barang" required>
							<option value="" disabled selected>Pilih Kategori</option>
							<option value="BedUnit">BED UNIT</option>
							<option value="Benang500Y">Benang 500Y</option>
							<option value="Benang5000Y">Benang 5000Y</option>
							<option value="BenangBordir">Benang Bordir</option>
							<option value="Polyster">Polyster</option>
							<option value="Resleting17">Resleting 17CM</option>
							<option value="BenangNeci">Benang Neci</option>
							<option value="KancingLubang2">Kancing 2 Lubang</option>
							<option value="KancingLubang4">Kancing 4 Lubang</option>
							<option value="RendaSilang"> Renda Silang</option>
							<option value="Pita">Pita 1/4</option>
						</select>
					</div>
					<div>
						<label for="jumlahbarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Jumlah Barang</label>
						<input type="number" name="jumlahbarang" id="jumlahbarang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-gray" min="1" required />
					</div>
					<div>
						<label for="satuanbarang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Satuan Barang</label>
						<select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-00 dark:border-gray-500 dark:placeholder-gray-400 dark:text-gray" id="satuan_barang" name="satuan_barang" required>
							<option value="" disabled selected>Pilih Satuan</option>
							<option value="pcs">PCS</option>
							<option value="meter">Meter</option>
							<option value="cm">CM</option>
						</select>
					</div>
			</div>
			<button type="submit" class="w-full text-white bg-green-800 hover:bg-green-800 font-medium text-sm px-5 py-2.5 text-center dark:bg-green-800 dark:hover:bg-green-900">Tambah</button>
			</form>
		</div>
	</div>
</div>

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
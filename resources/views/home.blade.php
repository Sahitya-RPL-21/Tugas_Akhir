@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-gray-100 p-6">
	<h1 class="text-4xl font-bold mb-8 text-gray-800">Beranda</h1>

	<div class="flex justify-end items-center space-x-4 mb-8">
		<a href="{{ route('daftarbarang') }}" class="py-2.5 px-5 bg-[#173720] text-white rounded-lg hover:bg-green-700 transition">
			Cek Stok</a>
		<a href="{{ route('barang.mentah') }}" class="py-2.5 px-5 bg-[#173720] text-white rounded-lg hover:bg-green-700 transition">
			Barang Mentah</a>
		<a href="#" onclick="toggleModal()" class="py-2.5 px-5 bg-[#173720] text-white rounded-lg hover:bg-green-700 transition">
			Tambah Barang Jadi</a>
	</div>

	<!-- Modal Tambah Barang -->
	<div id="tambahBarangModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
		<div class="bg-white rounded-lg shadow-lg w-96 p-6">
			<h2 class="text-xl font-bold mb-4 text-gray-800">Tambah Barang</h2>
			<form action="" method="POST">
				@csrf
				<div class="mb-4">
					<label for="no_barang" class="block text-sm font-medium text-gray-700">No Barang</label>
					<input type="text" id="no_barang" name="no_barang" class="w-full border border-gray-300 p-2 rounded" required>
				</div>
				<div class=" mb-4">
					<label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
					<input type="text" id="nama_barang" name="nama_barang" class="w-full border border-gray-300 p-2 rounded" required>
				</div>
				<div class=" mb-4">
					<label for="jumlah_barang" class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
					<input type="number" id="jumlah_barang" name="jumlah_barang" class="w-full border border-gray-300 p-2 rounded" required>
				</div>
				<div class="flex justify-end space-x-4">
					<button type="button" onclick="toggleModal()" class="py-2 px-4 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Batal</button>
					<button type="submit" class="py-2 px-4 bg-[#173720] text-white rounded-lg hover:bg-green-700 transition">Simpan</button>
				</div>
			</form>
		</div>
	</div>

	<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
		<!-- Stok Bahan Mentah -->
		<div class="bg-white p-6 rounded-2xl shadow-lg flex items-center justify-between">
			<div>
				<h2 class="text-lg font-semibold text-gray-600">Stok Bahan Mentah</h2>
				<p class="text-3xl font-bold text-green-700 mt-2">12</p>
				<p class="text-sm text-gray-500">08 May 2025</p>
			</div>
			<div class="ml-4 bg-green-100 text-green-700 p-3 rounded-full">
				<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 2L12 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M5 15L12 22L19 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</div>
		</div>

		<!-- Stok Barang Jadi -->
		<div class="bg-white p-6 rounded-2xl shadow-lg flex items-center justify-between">
			<div>
				<h2 class="text-lg font-semibold text-gray-600">Stok Barang Jadi</h2>
				<p class="text-3xl font-bold text-yellow-600 mt-2">3</p>
				<p class="text-sm text-gray-500">08 May 2025</p>
			</div>
			<div class="ml-4 bg-green-100 text-green-700 p-3 rounded-full">
				<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 2L12 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M5 9L12 2L19 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</div>
		</div>
	</div>


	<!-- Statistik Order -->
	<div class="bg-white p-8 rounded-2xl shadow-lg col-span-2">
		<div id="bar-chart" class="w-full"></div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	const chartConfig = {
		series: [{
			name: "Sales",
			data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
		}],
		chart: {
			type: "bar",
			height: 400,
			toolbar: {
				show: false,
			},
		},
		title: {
			text: "Penjualan Bulanan",
			align: "center",
			style: {
				fontSize: "18px",
				fontWeight: "bold",
				color: "#333",
				fontFamily: "helvetica, sans-serif",
			},
		},
		dataLabels: {
			enabled: false,
		},
		colors: ["#4CAF50"],
		plotOptions: {
			bar: {
				columnWidth: "50%",
				borderRadius: 4,
			},
		},
		xaxis: {
			axisTicks: {
				show: false,
			},
			axisBorder: {
				show: false,
			},
			labels: {
				style: {
					colors: "#616161",
					fontSize: "12px",
					fontFamily: "inherit",
					fontWeight: 400,
				},
			},
			categories: [
				"Apr",
				"May",
				"Jun",
				"Jul",
				"Aug",
				"Sep",
				"Oct",
				"Nov",
				"Dec",
			],
		},
		yaxis: {
			labels: {
				style: {
					colors: "#616161",
					fontSize: "12px",
					fontFamily: "inherit",
					fontWeight: 400,
				},
			},
		},
		grid: {
			show: true,
			borderColor: "#e0e0e0",
			strokeDashArray: 4,
			xaxis: {
				lines: {
					show: true,
				},
			},
			padding: {
				top: 10,
				right: 20,
				left: 20,
			},
		},
		fill: {
			opacity: 0.9,
		},
		tooltip: {
			theme: "light",
			style: {
				fontSize: "12px",
				fontFamily: "inherit",
			},
		},
	};

	const chart = new ApexCharts(document.querySelector("#bar-chart"), chartConfig);

	chart.render();

	function toggleModal() {
		const modal = document.getElementById('tambahBarangModal');
		modal.classList.toggle('hidden');
	}
</script>
@endsection
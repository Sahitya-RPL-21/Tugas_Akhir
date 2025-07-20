@extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
@section('page_title', 'ADMIN STOK')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-gray-100 p-6">
	<h1 class="text-4xl font-bold mb-8 text-gray-800">Beranda</h1>

	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
		<div class="bg-green-900 text-white p-4 rounded-lg flex flex-col justify-between items-center text-center">
			<div class="mb-2">
				<svg class="h-16 w-16 text-blue-200 mx-auto" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M21.6667 6.5H4.33333C3.73502 6.5 3.25 6.98502 3.25 7.58333V21.6667C3.25 22.265 3.73502 22.75 4.33333 22.75H21.6667C22.265 22.75 22.75 22.265 22.75 21.6667V7.58333C22.75 6.98502 22.265 6.5 21.6667 6.5Z" stroke="white" stroke-width="1.625" stroke-linejoin="round" />
					<path d="M9.72278 13.0045H16.2228" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M3.25 7.04171L7.04167 2.70837H18.9583L22.75 7.04171" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<h3 class="text-xl font-semibold mt-2">Stok Barang</h3>
			</div>
			<a href="/stokbarang" class="bg-white text-green-900 px-4 py-2 rounded-full text-sm flex items-center">
				Lihat Detail
				<svg class="w-6 h-6 ml-2" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 10h4M11 7l3 3-3 3" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</a>
		</div>

		<div class="bg-green-900 text-white p-4 rounded-lg flex flex-col justify-between items-center text-center">
			<div class="mb-2">
				<svg class="h-16 w-16 text-green-200 mx-auto" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.4953 3.375H3.375V23.625H13.5" stroke="white" stroke-width="1.6875" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M14.0625 18.5625L9 13.5L14.0625 8.4375" stroke="white" stroke-width="1.6875" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M23.625 13.4954H9" stroke="white" stroke-width="1.6875" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<h3 class="text-xl font-semibold mt-2">Barang Masuk</h3>
			</div>
			<a href="/homebarangmasuk" class="bg-white text-green-900 px-4 py-2 rounded-full text-sm flex items-center">
				Lihat Detail
				<svg class="w-6 h-6 ml-2" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 10h4M11 7l3 3-3 3" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</a>
		</div>

		<div class="bg-green-900 text-white p-4 rounded-lg flex flex-col justify-between items-center text-center">
			<div class="mb-2 flex flex-col items-center">
				<svg class="h-16 w-16 text-yellow-200 mx-auto" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.9955 3.25H3.25V22.75H13" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M17.875 17.875L22.75 13L17.875 8.125" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M8.66669 12.9955H22.75" stroke="white" stroke-width="1.625" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<h3 class="text-xl font-semibold mt-2">Barang Keluar</h3>
			</div>
			<a href="/homebarangkeluar" class="bg-white text-green-900 px-4 py-2 rounded-full text-sm flex items-center">
				Lihat Detail
				<svg class="w-6 h-6 ml-2" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 10h4M11 7l3 3-3 3" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</a>
		</div>

		<div class="bg-green-900 text-white p-4 rounded-lg flex flex-col justify-between items-center text-center">
			<div class="mb-2 flex flex-col items-center">
				<svg class="h-16 w-16 text-red-200 mx-auto block" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M7.60413 10.6459C7.60413 8.12608 9.64683 6.08337 12.1666 6.08337H48.6666C51.1865 6.08337 53.2291 8.12608 53.2291 10.6459V66.9167H12.1666C9.64683 66.9167 7.60413 64.8741 7.60413 62.3542V10.6459Z" stroke="white" stroke-width="4.5625" stroke-linejoin="round" />
					<path d="M53.2292 36.5C53.2292 34.8201 54.591 33.4584 56.2709 33.4584H62.3542C64.0342 33.4584 65.3959 34.8201 65.3959 36.5V62.3542C65.3959 64.8741 63.3533 66.9167 60.8334 66.9167H53.2292V36.5Z" stroke="white" stroke-width="4.5625" stroke-linejoin="round" />
					<path d="M16.7291 18.25H28.8958" stroke="white" stroke-width="4.5625" stroke-linecap="round" stroke-linejoin="round" />
					<path d="M16.7291 28.8959H34.9791" stroke="white" stroke-width="4.5625" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				<h3 class="text-xl font-semibold mt-2">Laporan</h3>
			</div>
			<a href="/laporanbarang" class="bg-white text-green-900 px-4 py-2 rounded-full text-sm flex items-center">
				Lihat Detail
				<svg class="w-6 h-6 ml-2" fill="none" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M8 10h4M11 7l3 3-3 3" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
			</a>
		</div>
	</div>
@endsection
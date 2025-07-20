extends('newwelcome')

@section('role_name', 'Dashboard Admin Stok')
<body class="font-sans bg-white p-10">
    <div class="header text-center mb-8">
        <h2 class="text-2xl font-bold mb-2">Data Cetak PDF</h2>
        <p class="text-gray-600">Silakan klik tombol di bawah untuk mencetak halaman ini ke PDF.</p>
    </div>
    <button class="no-print bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow mb-4" onclick="window.print()">Cetak PDF</button>
    <table class="w-full border border-gray-300 mt-5">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nama</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $i => $item)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $i+1 }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $item->nama }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $item->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer mt-10 text-right">
        <p class="text-gray-500">Tanggal Cetak: {{ date('d-m-Y') }}</p>
    </div>
</body>
</html>


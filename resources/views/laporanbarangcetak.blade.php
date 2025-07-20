<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
    <style>
        body {
            font-family: 'sans-serif';
            font-size: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .header p {
            font-size: 12px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            text-align: right;
            font-size: 9px;
            color: #555;
        }

        .text-capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Laporan Transaksi Barang</h1>
        @if(isset($start) && isset($end))
        <p>Periode: {{ date('d M Y', strtotime($start)) }} - {{ date('d M Y', strtotime($end)) }}</p>
        @endif
        @if(isset($jenis_transaksi) && $jenis_transaksi)
        <p>Jenis Transaksi: <span class="text-capitalize">{{ $jenis_transaksi }}</span></p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td class="text-capitalize">{{ $item->jenis_transaksi }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->unit_barang }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data untuk periode yang dipilih.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Data Pengadaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Data Pengadaan</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal Penerimaan</th>
                <th>Kode Barang</th>
                <th>Jumlah Pengadaan Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPengadaans as $pengadaan)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($pengadaan->tgl_penerimaan)->format('Y-m-d') }}</td>
                    <td>{{ $pengadaan->dataBarang->kode_barang ?? 'Data Barang tidak ditemukan' }}</td>
                    <td>{{ $pengadaan->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

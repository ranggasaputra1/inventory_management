<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Barang</title>
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
    <h2>Data Barang</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Kode Ruangan</th>
                <th>Nama Barang</th>
                <th>Merk Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah Barang</th>
                <th>Status Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataBarangs as $barang)
                <tr>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->dataRuangan->kode_ruangan ?? 'N/A' }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->merk_barang }}</td>
                    <td>{{ $barang->jenis_barang }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td>{{ $barang->status_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

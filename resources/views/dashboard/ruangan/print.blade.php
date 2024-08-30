<!-- resources/views/data-ruangan/print.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Data Ruangan</title>
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
    <h1>Data Ruangan</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Kondisi Ruangan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataRuangans as $ruangan)
                <tr>
                    <td>{{ $ruangan->kode_ruangan }}</td>
                    <td>{{ $ruangan->nama_ruangan }}</td>
                    <td>{{ $ruangan->kondisi_ruangan }}</td>
                    <td>{{ $ruangan->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

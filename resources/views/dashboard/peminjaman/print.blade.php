<!DOCTYPE html>
<html>

<head>
    <title>Print Peminjaman</title>
    <style>
        /* CSS untuk tampilan print */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Agar kolom memiliki lebar yang tetap */
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 4px;
            /* Mengurangi padding untuk menghemat ruang */
            text-align: left;
            word-wrap: break-word;
            /* Agar teks panjang dipecah jika diperlukan */
            font-size: 10px;
            /* Mengurangi ukuran font agar kolom lebih kompak */
        }

        .table th {
            background-color: #f2f2f2;
            font-size: 8px;
            /* Menjadikan sub judul lebih kecil */
            text-align: center;
            /* Memusatkan teks di dalam <th> */
        }

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 10%;
            /* Lebar kolom tanggal peminjaman */
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 10%;
            /* Lebar kolom tanggal pengembalian */
        }

        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 15%;
            /* Lebar kolom nama peminjam */
        }

        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 10%;
            /* Lebar kolom kode barang */
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 15%;
            /* Lebar kolom nama barang */
        }

        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 10%;
            /* Lebar kolom kode ruangan */
        }

        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 10%;
            /* Lebar kolom jumlah */
        }

        .table th:nth-child(8),
        .table td:nth-child(8) {
            width: 10%;
            /* Lebar kolom status */
        }

        @media print {

            /* CSS khusus untuk print */
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th,
            .table td {
                border: 1px solid #ddd;
                padding: 2px;
                /* Mengurangi padding saat print */
                font-size: 8px;
                /* Mengurangi ukuran font saat print */
            }

            .table th {
                background-color: #f2f2f2;
                font-size: 6px;
                /* Menjadikan sub judul lebih kecil saat print */
                text-align: center;
                /* Memusatkan teks di dalam <th> saat print */
            }

            @page {
                size: A4 landscape;
                /* Mengatur ukuran kertas ke landscape untuk ruang tambahan */
                margin: 10mm;
                /* Margin untuk printer */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Peminjaman</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Tgl Peminjaman</th>
                    <th>Tgl Pengembalian</th>
                    <th>Nama Peminjam</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kode Ruangan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPeminjamen as $peminjaman)
                    <tr>
                        <td data-label="Tanggal Peminjaman">{{ $peminjaman->tgl_peminjaman }}</td>
                        <td data-label="Tanggal Pengembalian">{{ $peminjaman->tgl_pengembalian }}</td>
                        <td data-label="Nama Peminjam">{{ $peminjaman->nama_peminjam }}</td>
                        <td data-label="Kode Barang">
                            {{ $peminjaman->dataBarang->kode_barang ?? '-' }}</td>
                        <td data-label="Nama Barang">
                            {{ $peminjaman->dataBarang->nama_barang ?? '-' }}</td>
                        <td data-label="Kode Ruangan">
                            {{ $peminjaman->dataRuangan->kode_ruangan ?? '-' }}</td>
                        <td data-label="Jumlah">{{ $peminjaman->jumlah ?? '-' }}</td>
                        <td data-label="Status">{{ $peminjaman->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

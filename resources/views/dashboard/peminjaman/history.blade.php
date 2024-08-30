@extends('dashboard.layouts.main')

@section('container')
    <style>
        /* Tambahkan styling jika perlu */
    </style>
    <div class="container">
        <div class="page-inner">
            <!-- Message Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="auto-hide-alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- End Message Alert -->

            <!-- Tombol Cetak -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('peminjaman.history.print', 'newest') }}" class="btn btn-primary me-2"
                    target="_blank">Print Data
                    Terbaru</a>
                <a href="{{ route('peminjaman.history.print', 'oldest') }}" class="btn btn-secondary" target="_blank">Print
                    Data Terlama</a>
            </div>

            <!-- Riwayat Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Riwayat Peminjaman</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if ($dataHistories->isEmpty())
                                    <p>Tidak ada data riwayat yang tersedia.</p>
                                @else
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Peminjaman</th>
                                                <th>Tanggal Pengembalian</th>
                                                <th>Nama Peminjam</th>
                                                <th>Kode Barang</th>
                                                <th>Kode Ruangan</th>
                                                <th>Jumlah</th>
                                                <th>Status</th>
                                                <th>Diinput Pada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataHistories as $history)
                                                <tr>
                                                    <td>{{ $history->tgl_peminjaman }}</td>
                                                    <td>{{ $history->tgl_pengembalian }}</td>
                                                    <td>{{ $history->nama_peminjam }}</td>
                                                    <td>{{ $history->dataBarang->kode_barang ?? 'N/A' }}</td>
                                                    <td>{{ $history->dataRuangan->kode_ruangan ?? 'N/A' }}</td>
                                                    <td>{{ $history->jumlah }}</td>
                                                    <td>{{ $history->status }}</td>
                                                    <td>{{ $history->deleted_at ? $history->deleted_at->format('Y-m-d') : '-' }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

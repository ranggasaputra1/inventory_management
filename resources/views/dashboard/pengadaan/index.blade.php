<!-- resources/views/pengadaan/index.blade.php -->

@extends('dashboard.layouts.main')

@section('container')
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

            <!-- Pengadaan Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Pengadaan</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="{{ url('pengadaan/create') }}">
                                    <i class="fa fa-plus"></i>
                                    Tambah Pengadaan
                                </a>
                                <!-- Print PDF Buttons -->
                                <div class="ms-2">
                                    <a href="{{ route('pengadaan.print', ['sort_by' => 'newest']) }}"
                                        class="btn btn-secondary" target="_blank"><i class="fa fa-print"></i>
                                        PDF
                                    </a>
                                    <!--  <a href="{{ route('pengadaan.print', ['sort_by' => 'oldest']) }}"
                                                                                class="btn btn-secondary" target="_blank"><i class="fa fa-print"></i>
                                                                                Print Terlama
                                                                            </a> -->
                                </div>
                                <!-- End Print PDF Buttons -->
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="{{ url('pengadaan') }}" method="GET" class="mb-3">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..."
                                        value="{{ request()->input('search') }}">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                                <div class="input-group mb-3">
                                    <select name="sort_by" class="form-select" onchange="this.form.submit()">
                                        <option value="">Urut Berdasarkan</option>
                                        <option value="newest"
                                            {{ request()->input('sort_by') === 'newest' ? 'selected' : '' }}>Terbaru
                                            Ditambahkan</option>
                                        <option value="oldest"
                                            {{ request()->input('sort_by') === 'oldest' ? 'selected' : '' }}>Terlama
                                            Ditambahkan</option>
                                    </select>
                                </div>
                            </form>
                            <!-- End Search Form -->

                            <div class="table-responsive">
                                @if ($dataPengadaans->isEmpty())
                                    <p>Tidak ada data Pengadaan yang tersedia.</p>
                                @else
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Penerimaan</th>
                                                <th>Kode Barang</th>
                                                <th>Jumlah Pengadaan Barang</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataPengadaans as $pengadaan)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($pengadaan->tgl_penerimaan)->format('Y-m-d') }}
                                                    </td>

                                                    <td>{{ $pengadaan->dataBarang->kode_barang ?? 'N/A' }}</td>
                                                    <td>{{ $pengadaan->jumlah }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ url('pengadaan/' . $pengadaan->id) }}"
                                                                data-bs-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-warning">
                                                                <i class="fa fa-file-alt" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ url('pengadaan/' . $pengadaan->id . '/edit') }}"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="{{ url('pengadaan/' . $pengadaan->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onsubmit="return confirm('Apakah Anda yakin akan menghapus data?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-bs-toggle="tooltip"
                                                                    title="Remove" class="btn btn-link btn-danger">
                                                                    <i class="fa fa-trash-alt"></i>
                                                                </button>
                                                            </form>

                                                        </div>
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
            <!-- End Pengadaan Table -->
        </div>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for auto-hide alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('auto-hide-alert');
            if (alert) {
                setTimeout(function() {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000); // Change 5000 to the desired time in milliseconds
            }
        });
    </script>
@endsection

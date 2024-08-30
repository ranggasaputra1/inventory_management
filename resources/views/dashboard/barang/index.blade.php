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

            <!-- Data Barang Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Barang</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="{{ url('barang/create') }}">
                                    <i class="fa fa-plus"></i>
                                    Tambah Barang
                                </a>
                                <!-- Print PDF Buttons -->
                                <div class="ms-2">
                                    <a href="{{ route('barang.print', ['sort_by' => 'newest']) }}" class="btn btn-secondary"
                                        target="_blank">
                                        <i class="fa fa-print"></i> PDF
                                    </a>
                                </div>
                                <!-- End Print PDF Buttons -->
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="{{ url('barang') }}" method="GET" class="mb-3">
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
                                @if ($dataBarangs->isEmpty())
                                    <p>Tidak ada data Barang yang tersedia.</p>
                                @else
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Kode Ruangan</th>
                                                <th>Nama Barang</th>
                                                <th>Merk Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Status Barang</th>
                                                <th>Foto Barang</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataBarangs as $barang)
                                                <tr>
                                                    <td>{{ $barang->kode_barang }}</td>
                                                    <td>{{ $barang->dataRuangan->kode_ruangan ?? '-' }}</td>
                                                    <td>{{ $barang->nama_barang }}</td>
                                                    <td>{{ $barang->merk_barang }}</td>
                                                    <td>{{ $barang->jumlah_barang }}</td>
                                                    <td>{{ $barang->status_barang }}</td>
                                                    <td>
                                                        @if ($barang->foto_barang)
                                                            <img src="{{ asset('storage/public/foto_barang/' . $barang->foto_barang) }}"
                                                                alt="Foto Barang" class="img-thumbnail" width="300"
                                                                data-bs-toggle="modal" data-bs-target="#fotoBarangModal"
                                                                data-image="{{ asset('storage/public/foto_barang/' . $barang->foto_barang) }}"
                                                                style="cursor: pointer;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ url('barang/' . $barang->id) }}"
                                                                data-bs-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-warning">
                                                                <i class="fa fa-file-alt" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ url('barang/' . $barang->id . '/edit') }}"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="{{ url('barang/' . $barang->id) }}"
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
            <!-- End Data Barang Table -->
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="fotoBarangModal" tabindex="-1" aria-labelledby="fotoBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoBarangModalLabel">Foto Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="fotoBarangImg" src="" alt="Foto Barang" class="img-fluid"
                        style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for auto-hide alert and modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('auto-hide-alert');
            if (alert) {
                setTimeout(function() {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000); // Change 5000 to the desired time in milliseconds
            }

            var fotoBarangModal = document.getElementById('fotoBarangModal');
            fotoBarangModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button yang mengaktifkan modal
                var imageSrc = button.getAttribute('data-image'); // Ambil data-image dari button
                var modalImage = fotoBarangModal.querySelector(
                    '#fotoBarangImg'); // Temukan elemen gambar di modal
                modalImage.src = imageSrc; // Set src gambar modal dengan URL gambar yang diklik
            });
        });
    </script>
@endsection

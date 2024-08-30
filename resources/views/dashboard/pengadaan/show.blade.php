@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <!-- message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="auto-hide-alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- end message -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Pengadaan</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('pengadaan.index') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="tgl_penerimaan" class="form-label">Tanggal Penerimaan</label>
                                    <input type="text" class="form-control" id="tgl_penerimaan"
                                        value="{{ \Carbon\Carbon::parse($pengadaan->tgl_penerimaan)->format('Y-m-d') }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang"
                                        value="{{ $pengadaan->dataBarang->kode_barang ?? 'Data Barang tidak ditemukan' }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang"
                                        value="{{ $pengadaan->dataBarang->nama_barang ?? 'Data Barang tidak ditemukan' }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control" id="jumlah"
                                        value="{{ $pengadaan->jumlah }}" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                }, 5000); // Ganti 5000 dengan waktu dalam milidetik
            }
        });
    </script>
@endsection

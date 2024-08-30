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

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Peminjaman</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('peminjaman.index') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="tgl_peminjaman" class="form-label">Tanggal Peminjaman</label>
                                    <input type="text" class="form-control" id="tgl_peminjaman"
                                        value="{{ $peminjaman->tgl_peminjaman }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                    <input type="text" class="form-control" id="tgl_pengembalian"
                                        value="{{ $peminjaman->tgl_pengembalian }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                                    <input type="text" class="form-control" id="nama_peminjam"
                                        value="{{ $peminjaman->nama_peminjam }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang"
                                        value="{{ $peminjaman->dataBarang->kode_barang ?? 'Data Barang tidak ditemukan atau Data Barang telah Dihapus' }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang"
                                        value="{{ $peminjaman->dataBarang->nama_barang ?? 'Data Barang tidak ditemukan atau Data Barang telah Dihapus' }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="kode_ruangan" class="form-label">Kode Ruangan</label>
                                    <input type="text" class="form-control" id="kode_ruangan"
                                        value="{{ $peminjaman->dataRuangan->kode_ruangan ?? ' - Data Ruangan tidak ditemukan atau Data Ruangan telah Dihapus' }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control" id="jumlah"
                                        value="{{ $peminjaman->jumlah }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status"
                                        value="{{ $peminjaman->status }}" readonly>
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

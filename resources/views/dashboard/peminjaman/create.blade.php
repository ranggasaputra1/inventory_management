<!-- resources/views/peminjaman/create.blade.php -->
@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Peminjaman</h4>
                            @if ($errors->any())
                                <br>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                    id="auto-hide-alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form action="{{ route('peminjaman.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="tgl_peminjaman">Tanggal Peminjaman</label>
                                    <input type="date" name="tgl_peminjaman" id="tgl_peminjaman" class="form-control"
                                        value="{{ old('tgl_peminjaman') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_pengembalian">Tanggal Pengembalian</label>
                                    <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control"
                                        value="{{ old('tgl_pengembalian') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_peminjam">Nama Peminjam</label>
                                    <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control"
                                        value="{{ old('nama_peminjam') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_barang">Kode Barang</label>
                                    <select name="kode_barang" id="kode_barang" class="form-select" required>
                                        <option value="">Pilih Kode Barang</option>
                                        @foreach ($dataBarangs as $barang)
                                            <option value="{{ $barang->id }}"
                                                {{ old('kode_barang') == $barang->id ? 'selected' : '' }}>
                                                {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_ruangan">Kode Ruangan</label>
                                    <select name="kode_ruangan" id="kode_ruangan" class="form-select" required>
                                        <option value="">Pilih Kode Ruangan</option>
                                        @foreach ($dataRuangan as $ruangan)
                                            <option value="{{ $ruangan->id }}"
                                                {{ old('kode_ruangan') == $ruangan->id ? 'selected' : '' }}>
                                                {{ $ruangan->kode_ruangan }} - {{ $ruangan->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control"
                                        value="{{ old('jumlah') }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <input type="text" name="status" id="status" class="form-control"
                                        value="Dipinjam" readonly required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
                }, 5000); // Change 5000 to the desired time in milliseconds
            }
        });
    </script>
@endsection

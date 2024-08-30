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

            <!-- Add Barang Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Barang</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Other Form Fields -->
                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control @error('kode_barang') is-invalid @enderror"
                                        id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" required>
                                    @error('kode_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kode_ruangan" class="form-label">Kode Ruangan</label>
                                    <select class="form-select @error('kode_ruangan') is-invalid @enderror"
                                        id="kode_ruangan" name="kode_ruangan" required>
                                        <option value="">Pilih Kode Ruangan</option>
                                        @foreach ($dataRuangans as $ruangan)
                                            <option value="{{ $ruangan->id }}"
                                                {{ old('kode_ruangan') == $ruangan->id ? 'selected' : '' }}>
                                                {{ $ruangan->kode_ruangan }} - {{ $ruangan->nama_ruangan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kode_ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                        id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="merk_barang" class="form-label">Merk Barang</label>
                                    <input type="text" class="form-control @error('merk_barang') is-invalid @enderror"
                                        id="merk_barang" name="merk_barang" value="{{ old('merk_barang') }}">
                                    @error('merk_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                    <input type="text" class="form-control @error('jenis_barang') is-invalid @enderror"
                                        id="jenis_barang" name="jenis_barang" value="{{ old('jenis_barang') }}">
                                    @error('jenis_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="satuan_barang" class="form-label">Satuan Barang</label>
                                    <input type="text" class="form-control @error('satuan_barang') is-invalid @enderror"
                                        id="satuan_barang" name="satuan_barang" value="{{ old('satuan_barang') }}">
                                    @error('satuan_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Foto Barang Preview -->
                                <div class="mb-3">
                                    <label for="foto_barang" class="form-label">Foto Barang</label>
                                    <div class="mb-2">
                                        <img id="fotoPreview" src="" alt="Preview" class="img-fluid"
                                            style="width: 150px; height: auto; display: none;">
                                    </div>
                                    <input type="file" class="form-control @error('foto_barang') is-invalid @enderror"
                                        id="foto_barang" name="foto_barang">
                                    @error('foto_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                    <input type="number" class="form-control @error('jumlah_barang') is-invalid @enderror"
                                        id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang') }}"
                                        min="0" required>
                                    @error('jumlah_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kondisi_barang" class="form-label">Kondisi Barang</label>
                                    <input type="text"
                                        class="form-control @error('kondisi_barang') is-invalid @enderror"
                                        id="kondisi_barang" name="kondisi_barang" value="{{ old('kondisi_barang') }}">
                                    @error('kondisi_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status_barang" class="form-label">Status Barang</label>
                                    <input type="text"
                                        class="form-control @error('status_barang') is-invalid @enderror"
                                        id="status_barang" name="status_barang" value="{{ old('status_barang') }}">
                                    @error('status_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Add Barang Form -->
        </div>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for Image Preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fotoInput = document.getElementById('foto_barang');
            var fotoPreview = document.getElementById('fotoPreview');

            fotoInput.addEventListener('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        fotoPreview.src = e.target.result;
                        fotoPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    fotoPreview.src = '';
                    fotoPreview.style.display = 'none';
                }
            });
        });
    </script>
@endsection

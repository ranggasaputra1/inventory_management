@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Barang</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang.update', $barang->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                        value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="data_ruangan_id">Kode Ruangan</label>
                                    <select class="form-select" id="data_ruangan_id" name="data_ruangan_id" required>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}"
                                                {{ $r->id == $barang->data_ruangan_id ? 'selected' : '' }}>
                                                {{ $r->kode_ruangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="merk_barang">Merk Barang</label>
                                    <input type="text" class="form-control" id="merk_barang" name="merk_barang"
                                        value="{{ old('merk_barang', $barang->merk_barang) }}">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_barang">Jenis Barang</label>
                                    <input type="text" class="form-control" id="jenis_barang" name="jenis_barang"
                                        value="{{ old('jenis_barang', $barang->jenis_barang) }}">
                                </div>
                                <div class="form-group">
                                    <label for="satuan_barang">Satuan Barang</label>
                                    <input type="text" class="form-control" id="satuan_barang" name="satuan_barang"
                                        value="{{ old('satuan_barang', $barang->satuan_barang) }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_barang">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
                                        value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_barang">Kondisi Barang</label>
                                    <input type="text" class="form-control" id="kondisi_barang" name="kondisi_barang"
                                        value="{{ old('kondisi_barang', $barang->kondisi_barang) }}">
                                </div>
                                <div class="form-group">
                                    <label for="status_barang">Status Barang</label>
                                    <input type="text" class="form-control" id="status_barang" name="status_barang"
                                        value="{{ old('status_barang', $barang->status_barang) }}">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $barang->keterangan) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto_barang">Foto Barang</label>
                                    <div class="mb-3">
                                    </div>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="foto_barang" name="foto_barang">
                                    </div>
                                    <img id="fotoBarangPreview" class="img-fluid img-thumbnail mt-3"
                                        style="display: none; max-width: 200px;">
                                    <br>
                                    @if ($barang->foto_barang)
                                        <img id="currentFotoBarang"
                                            src="{{ asset('storage/public/foto_barang/' . $barang->foto_barang) }}"
                                            alt="Foto Barang" class="img-fluid img-thumbnail" style="max-width: 200px;">
                                    @endif

                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update Barang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JavaScript for image preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fileInput = document.getElementById('foto_barang');
            var imagePreview = document.getElementById('fotoBarangPreview');
            var currentImage = document.getElementById('currentFotoBarang');

            fileInput.addEventListener('change', function(event) {
                var file = event.target.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        currentImage.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                    currentImage.style.display =
                        'block';
                }
            });
        });
    </script>
@endsection

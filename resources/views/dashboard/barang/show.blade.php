@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Detail Barang</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang"
                                        value="{{ $barang->kode_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kode_ruangan">Kode Ruangan</label>
                                    <input type="text" class="form-control" id="kode_ruangan"
                                        value="{{ $barang->dataRuangan->kode_ruangan ?? '- Data Ruangan tidak ditemukan atau Data Ruangan telah Dihapus ' }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang"
                                        value="{{ $barang->nama_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="merk_barang">Merk Barang</label>
                                    <input type="text" class="form-control" id="merk_barang"
                                        value="{{ $barang->merk_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_barang">Jenis Barang</label>
                                    <input type="text" class="form-control" id="jenis_barang"
                                        value="{{ $barang->jenis_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="satuan_barang">Satuan Barang</label>
                                    <input type="text" class="form-control" id="satuan_barang"
                                        value="{{ $barang->satuan_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_barang">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="jumlah_barang"
                                        value="{{ $barang->jumlah_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_barang">Kondisi Barang</label>
                                    <input type="text" class="form-control" id="kondisi_barang"
                                        value="{{ $barang->kondisi_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="status_barang">Status Barang</label>
                                    <input type="text" class="form-control" id="status_barang"
                                        value="{{ $barang->status_barang }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" rows="3" readonly>{{ $barang->keterangan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto_barang">Foto Barang</label>
                                    <br>
                                    @if ($barang->foto_barang)
                                        <img src="{{ asset('storage/public/foto_barang/' . $barang->foto_barang) }}"
                                            alt="Foto Barang" width="200" data-bs-toggle="modal"
                                            data-bs-target="#fotoBarangModal"
                                            data-image="{{ asset('storage/public/foto_barang/' . $barang->foto_barang) }}"
                                            style="cursor: pointer;">
                                    @else
                                        <p>No Image Available</p>
                                    @endif
                                </div>
                                <a href="{{ url('barang') }}" class="btn btn-primary mt-3">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="fotoBarangModal" tabindex="-1" aria-labelledby="fotoBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoBarangModalLabel">Foto Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="fotoBarangImg" src="" alt="Foto Barang" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript untuk modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fotoBarangModal = document.getElementById('fotoBarangModal');
            fotoBarangModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Tombol yang mengaktifkan modal
                var imageSrc = button.getAttribute('data-image'); // Ambil data-image dari tombol
                var modalImage = fotoBarangModal.querySelector(
                    '#fotoBarangImg'); // Temukan elemen gambar di modal
                modalImage.src = imageSrc; // Set src gambar modal dengan URL gambar yang diklik
            });
        });
    </script>
@endsection

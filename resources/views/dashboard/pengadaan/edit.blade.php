@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="auto-hide-alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Pengadaan</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('pengadaan.index') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengadaan.update', $pengadaan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="tgl_penerimaan" class="form-label">Tanggal Penerimaan</label>
                                    <input type="date" class="form-control" id="tgl_penerimaan" name="tgl_penerimaan"
                                        value="{{ old('tgl_penerimaan', $pengadaan->tgl_penerimaan->format('Y-m-d')) }}"
                                        required>
                                    @error('tgl_penerimaan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                    <select name="kode_barang" class="form-select" id="kode_barang" required>
                                        <option value="">Pilih Kode Barang</option>
                                        @foreach ($dataBarangs as $dataBarang)
                                            <option value="{{ $dataBarang->id }}"
                                                data-jumlah-barang="{{ $dataBarang->jumlah_barang }}"
                                                {{ $dataBarang->id == $pengadaan->kode_barang ? 'selected' : '' }}>
                                                {{ $dataBarang->kode_barang }} - {{ $dataBarang->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kode_barang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        value="{{ old('jumlah', $pengadaan->jumlah) }}" min="1" required>
                                    @error('jumlah')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pengadaan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

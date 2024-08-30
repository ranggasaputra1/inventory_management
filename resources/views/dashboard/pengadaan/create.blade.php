@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Pengadaan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('pengadaan.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="tgl_penerimaan">Tanggal Penerimaan</label>
                                    <input type="date" name="tgl_penerimaan" class="form-control" id="tgl_penerimaan"
                                        value="{{ old('tgl_penerimaan') }}" required>
                                    @error('tgl_penerimaan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <select name="kode_barang" class="form-select" id="kode_barang" required>
                                        <option value="">Pilih Kode Barang</option>
                                        @foreach ($dataBarangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->kode_barang }} -
                                                {{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                    @error('kode_barang')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control" id="jumlah"
                                        value="{{ old('jumlah') }}" min="1" required>
                                    @error('jumlah')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('pengadaan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

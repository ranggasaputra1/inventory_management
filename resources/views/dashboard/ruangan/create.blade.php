@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Ruangan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('ruangan.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_ruangan">Kode Ruangan</label>
                                    <input type="text" name="kode_ruangan" class="form-control" id="kode_ruangan"
                                        value="{{ old('kode_ruangan') }}" required>
                                    @error('kode_ruangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_ruangan">Nama Ruangan</label>
                                    <input type="text" name="nama_ruangan" class="form-control" id="nama_ruangan"
                                        value="{{ old('nama_ruangan') }}" required>
                                    @error('nama_ruangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_ruangan">Kondisi Ruangan</label>
                                    <input type="text" name="kondisi_ruangan" class="form-control" id="kondisi_ruangan"
                                        value="{{ old('kondisi_ruangan') }}" required>
                                    @error('kondisi_ruangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan" required>{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

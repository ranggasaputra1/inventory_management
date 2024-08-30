<!-- resources/views/data-ruangan/edit.blade.php -->

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
                                <h4 class="card-title">Edit Ruangan</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ url('ruangan') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="kode_ruangan" class="form-label">Kode Ruangan</label>
                                    <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan"
                                        value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" required>
                                    @error('kode_ruangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                    <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan"
                                        value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
                                    @error('nama_ruangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kondisi_ruangan" class="form-label">Kondisi Ruangan</label>
                                    <input type="text" class="form-control" id="kondisi_ruangan" name="kondisi_ruangan"
                                        value="{{ old('kondisi_ruangan', $ruangan->kondisi_ruangan) }}" required>
                                    @error('kondisi_ruangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $ruangan->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
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

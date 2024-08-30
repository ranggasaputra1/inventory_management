<!-- resources/views/data-ruangan/show.blade.php -->

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
                                <h4 class="card-title">Detail Ruangan</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ url('ruangan') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="kode_ruangan" class="form-label">Kode Ruangan</label>
                                    <input type="text" class="form-control" id="kode_ruangan"
                                        value="{{ $ruangan->kode_ruangan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                    <input type="text" class="form-control" id="nama_ruangan"
                                        value="{{ $ruangan->nama_ruangan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="kondisi_ruangan" class="form-label">Kondisi Ruangan</label>
                                    <input type="text" class="form-control" id="kondisi_ruangan"
                                        value="{{ $ruangan->kondisi_ruangan }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" rows="3" readonly>{{ $ruangan->keterangan }}</textarea>
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

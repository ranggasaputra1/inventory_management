<!-- resources/views/data-ruangan/index.blade.php -->

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

            <!-- Data Ruangan Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Ruangan</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="{{ url('ruangan/create') }}">
                                    <i class="fa fa-plus"></i>
                                    Tambah Ruangan
                                </a>
                                <!-- Print PDF Buttons -->
                                <div class="ms-2">
                                    <a href="{{ route('ruangan.print', ['sort_by' => 'newest']) }}"
                                        class="btn btn-secondary" target="_blank">
                                        <i class="fa fa-print"></i> PDF
                                    </a>
                                    <!--  <a href="{{ route('ruangan.print', ['sort_by' => 'oldest']) }}"
                                                                                                        class="btn btn-secondary" target="_blank">
                                                                                                        <i class="fa fa-print"></i> Print Terlama
                                                                                                    </a> -->
                                </div>
                                <!-- End Print PDF Buttons -->
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form action="{{ url('ruangan') }}" method="GET" class="mb-3">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..."
                                        value="{{ request()->input('search') }}">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                                <div class="input-group mb-3">
                                    <select name="sort_by" class="form-select" onchange="this.form.submit()">
                                        <option value="">Urut Berdasarkan</option>
                                        <option value="newest"
                                            {{ request()->input('sort_by') === 'newest' ? 'selected' : '' }}>Terbaru
                                            Ditambahkan</option>
                                        <option value="oldest"
                                            {{ request()->input('sort_by') === 'oldest' ? 'selected' : '' }}>Terlama
                                            Ditambahkan</option>
                                    </select>
                                </div>
                            </form>
                            <!-- End Search Form -->


                            <div class="table-responsive">
                                @if ($dataRuangans->isEmpty())
                                    <p>Tidak ada data Ruangan yang tersedia.</p>
                                @else
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kode Ruangan</th>
                                                <th>Nama Ruangan</th>
                                                <th>Kondisi Ruangan</th>
                                                <th>Keterangan</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataRuangans as $ruangan)
                                                <tr>
                                                    <td>{{ $ruangan->kode_ruangan }}</td>
                                                    <td>{{ $ruangan->nama_ruangan }}</td>
                                                    <td>{{ $ruangan->kondisi_ruangan }}</td>
                                                    <td>{{ $ruangan->keterangan }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ url('ruangan/' . $ruangan->id) }}"
                                                                data-bs-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-warning">
                                                                <i class="fa fa-file-alt" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ url('ruangan/' . $ruangan->id . '/edit') }}"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-primary">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('ruangan.destroy', $ruangan->id) }}"
                                                                method="POST" style="display:inline;"
                                                                onsubmit="return confirm('Apakah Anda yakin akan menghapus data?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" data-bs-toggle="tooltip"
                                                                    title="Remove" class="btn btn-link btn-danger">
                                                                    <i class="fa fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Data Ruangan Table -->
        </div>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for auto-hide alert -->
    <script>
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                // Misalnya, script ini dapat menyebabkan masalah
                if (event.target.method === 'POST' && event.target.querySelector('[name="_method"]')
                    .value === 'DELETE') {
                    event.preventDefault();
                    var url = new URL(event.target.action);
                    url.searchParams.set('_token', document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'));
                    event.target.action = url.toString();
                    event.target.submit();
                }
            });
        });
    </script>
@endsection

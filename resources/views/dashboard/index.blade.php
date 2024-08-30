@extends('dashboard.layouts.main')


@section('container')
    {{-- Main --}}
    <div class="page-inner"> <br><br><br>
        <!-- Welcome Message -->
        <div class="dashboard-welcome">
            <h1 class="welcome-text">Selamat Datang, {{ auth()->user()->name }}</h1>
            <p class="welcome-subtext">Sarana Prasarana LKP Talium</p>
        </div>

        <!-- Stats Cards 
        <div class="row">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <a href="ruangan">
                            <h5 class="card-title">Tambah Data Ruangan</h5>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <a href="barang">
                            <h5 class="card-title">Tambah Data Barang</h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <a href="pengadaan">
                            <h5 class="card-title">Tambah Data Pengadaan</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Main --}} -->

        <!-- Recent Activity with Image -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Aplikasi Inventory Manajemen</h5>
            </div>
            <div class="card-body">
                <center>
                    <img src="https://lkpktallium.id/wp-content/uploads/2022/12/LOGO-TALLIUM.png"
                        alt="Recent Activity" class="recent-activity-img" style="width: 15%;" height="10%">
                    </center>
                    <br><br>
                    <p>Nama Lembaga         : LKP TALIUM</p>
                    <p>Nama Kepala Lembaga  : Drs.Dedi Purwoto,MM</p>
                    <p>Alamat : Jl. Raya Batujajar Barat No. 275 Rt.02 Rw.04 Ds. Batujajar Barat Kec. Batujajar Kab. Bandung Barat.</p>
                    <p>Nomor Telp : 0812 2444 6322</p>
                    <p>Akreditasi : B</p>
                    <p>NSM/NPSN : K5650351</p>
            </div>
            
        </div>
    </div>
    </div>
    </div>
    {{-- End Main --}}
@endsection

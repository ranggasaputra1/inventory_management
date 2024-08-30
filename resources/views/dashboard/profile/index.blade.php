<!-- resources/views/profile/index.blade.php -->

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

            <!-- Profile Update Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Update Profile Picture -->
                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Update Foto Profil</label>
                                    <div class="mb-3">
                                        <img src="{{ Auth::user()->profile_picture
                                            ? asset('storage/' . Auth::user()->profile_picture)
                                            : asset('img/profile_kosong.jpg') }}"
                                            alt="Profile Picture" width="100">
                                    </div>
                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                                    @error('profile_picture')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Update Password -->
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Lama</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password">
                                    @error('current_password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                    @error('new_password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru
                                    </label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation">
                                    @error('new_password_confirmation')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Profile Update Form -->
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
                }, 5000); // Change 5000 to the desired time in milliseconds
            }
        });
    </script>
@endsection

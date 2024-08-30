{{-- Header --}}
<div class="main-panel">
    <div class="main-header">
        <div class="main-header-logo">
            <div class="logo-header" data-background-color="dark">
                <a href="#" class="logo">
                    <img src="{{ asset('assets/template/assets_db/img/kaiadmin/.svg') }}" alt="navbar brand"
                        class="navbar-brand" height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
        </div>
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                            aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="{{ Auth::user()->profile_picture
                                    ? asset('storage/' . Auth::user()->profile_picture)
                                    : asset('img/profile_kosong.jpg') }}"
                                    alt="Profile Picture" width="100" class="avatar-img rounded-circle">
                            </div>

                            <span class="profile-username">
                                <span class="op-7"></span>
                                <span class="fw-bold">{{ auth()->user()->name }}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    {{-- End Header --}}

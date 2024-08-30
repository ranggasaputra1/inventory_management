<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="dashboard" class="logo">
                <img src="{{ asset('assets/template/assets_db/img/kaiadmin/logo_news.png') }}" alt="navbar brand"
                    class="navbar-brand" height="25" />
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?= $active_menu === 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= url('dashboard') ?>"
                        class="<?= $active_menu === 'dashboard' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item <?= $active_menu === 'ruangan' ? 'active' : '' ?>">
                    <a href="<?= url('ruangan') ?>"
                        class="<?= $active_menu === 'ruangan' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-building"></i>
                        <p>Ruangan</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu === 'barang' ? 'active' : '' ?>">
                    <a href="<?= url('barang') ?>"
                        class="<?= $active_menu === 'barang' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-box"></i>
                        <p>Barang</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu === 'pengadaan' ? 'active' : '' ?>">
                    <a href="<?= url('pengadaan') ?>"
                        class="<?= $active_menu === 'pengadaan' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-truck-loading"></i>
                        <p>Pengadaan</p>
                    </a>
                </li>
                <li class="nav-item <?= $active_menu === 'peminjaman' ? 'active' : '' ?>">
                    <a href="<?= url('peminjaman') ?>"
                        class="<?= $active_menu === 'peminjaman' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-archive"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>


                <hr>

                <li class="nav-item <?= $active_menu === 'profile' ? 'active' : '' ?>">
                    <a href="<?= url('profile') ?>"
                        class="<?= $active_menu === 'profile' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <li class="nav-item <?= $active_menu === 'add-account' ? 'active' : '' ?>">
                    <a href="<?= url('add-account') ?>"
                        class="<?= $active_menu === 'add-account' ? 'collapsed active' : 'collapsed' ?>"
                        aria-expanded="false">
                        <i class="fas fa-user-plus"></i>
                        <p>Tambah Akun</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); if (confirm('Apakah Akan Logout?')) { document.getElementById('logout-form').submit(); }">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

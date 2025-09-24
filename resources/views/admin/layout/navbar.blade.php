<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual">
            <span class="smini-visible">
                <i class="text-white">S</i>
            </span>
            <span class="smini-hide fs-5 tracking-wider"><img src="{{ asset('assets/media/logo.png') }}" alt=""
                    width="50px" height="50px"> SIMPAN</span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                data-action="dark_mode_toggle">
                <i class="far fa-moon"></i>
            </button>
            <!-- END Dark Mode -->

            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() === 'admin.data.kategori' ? 'active' : '' }}"
                        href="{{ route('admin.data.kategori') }}">
                        <i class="nav-main-link-icon far fa-rectangle-list"></i>
                        <span class="nav-main-link-name">Kategori</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() === 'admin.data.aset' || Route::currentRouteName() === 'admin.import.aset' || Route::currentRouteName() === 'admin.data.aset.kategori' || Route::currentRouteName() === 'admin.detail.aset' ? 'active' : '' }}"
                        href="{{ route('admin.data.aset') }}">
                        <i class="nav-main-link-icon si si-layers"></i>
                        <span class="nav-main-link-name">Aset</span>
                    </a>
                </li>
                <li
                    class="nav-main-item {{ Route::currentRouteName() === 'admin.peminjaman.tambah' || Route::currentRouteName() === 'admin.peminjaman' || Route::currentRouteName() === 'admin.peminjaman.tambah-kendaraan' || Route::currentRouteName() === 'admin.peminjaman.tambah-laptop' ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="true" href="#">
                        <i class="nav-main-link-icon fa fa-hand-holding"></i>
                        <span class="nav-main-link-name">Peminjaman</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::currentRouteName() === 'admin.peminjaman.tambah' || Route::currentRouteName() === 'admin.peminjaman.tambah-kendaraan' || Route::currentRouteName() === 'admin.peminjaman.tambah-laptop' ? 'active' : '' }}"
                                href="{{ route('admin.peminjaman.tambah') }}">
                                <span class="nav-main-link-name">Tambah Peminjaman</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ Route::currentRouteName() === 'admin.peminjaman' ? 'active' : '' }}"
                                href="{{ route('admin.peminjaman') }}">
                                <span class="nav-main-link-name">Sedang Berlangsung</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::currentRouteName() === 'admin.laporan' || Route::currentRouteName() === 'admin.peminjaman.detail' ? 'active' : '' }}"
                        href="{{ route('admin.laporan') }}">
                        <i class="nav-main-link-icon si si-notebook"></i>
                        <span class="nav-main-link-name">Laporan</span>
                    </a>
                </li>
                @if (session()->get('role') === 'Admin')
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::currentRouteName() === 'admin.data.pengguna' ? 'active' : '' }}"
                            href="{{ route('admin.data.pengguna') }}">
                            <i class="nav-main-link-icon si si-users"></i>
                            <span class="nav-main-link-name">Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ Route::currentRouteName() === 'admin.penandatangan' ? 'active' : '' }}"
                            href="{{ route('admin.penandatangan') }}">
                            <i class="nav-main-link-icon fa fa-file-signature"></i>
                            <span class="nav-main-link-name">Penandatangan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>

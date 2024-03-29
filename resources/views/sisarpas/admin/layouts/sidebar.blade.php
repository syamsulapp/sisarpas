<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('sisarpas.landing') }}" class="app-brand-link" target="_blank">
            <span class="app-brand-logo demo">
                <img src="{{ asset('sisarpas/assets/img/logo.png') }}" width="50" height="50" alt="logo"
                    style="border-radius: 50%" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">SARPRAS ITERA</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->

        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active open' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Module ADMIN&amp;
                SI SARPRAS</span></li>

        <li
            class="menu-item {{ request()->is('admin/dashboard/master_data/landing/header') ||
            request()->is('admin/dashboard/master_data/landing/video') ||
            request()->is('admin/dashboard/master_data/landing/footer') ||
            request()->is('admin/dashboard/master_data/landing/informasi_penting')
                ? 'active open'
                : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-world"></i>
                <div data-i18n="Tables">Landing</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/dashboard/master_data/landing/header') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_landing_header') }}" class="menu-link">
                        <div data-i18n="Landing">Header</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/dashboard/master_data/landing/video') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_landing_video') }}" class="menu-link">
                        <div data-i18n="Pricing">Video</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/dashboard/master_data/landing/footer') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_landing_footer') }}" class="menu-link">
                        <div data-i18n="Pricing">Footer</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('admin/dashboard/master_data/landing/informasi_penting') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_landing_informasi_penting') }}" class="menu-link">
                        <div data-i18n="Pricing">Informasi Penting</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->is('admin/dashboard/master_data/contacts') ? 'active open' : '' }}">
            <a href="{{ route('admin.dashboard_contacts') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-contact"></i>
                <div data-i18n="Tables">Contact</div>
            </a>
        </li>

        <li
            class="menu-item {{ request()->is('admin/dashboard/master_data/inventori/barang') ||
            request()->is('admin/dashboard/master_data/inventori/ruangan') ||
            request()->is('admin/dashboard/master_data/inventori/admin') ||
            request()->is('admin/dashboard/master_data/inventori/penjadwalan')
                ? 'active open'
                : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-data"></i>
                <div data-i18n="Tables">Data Inventori</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ request()->is('admin/dashboard/master_data/inventori/barang') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_inventori_barang') }}" class="menu-link">
                        <div data-i18n="Landing">Data Barang</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('admin/dashboard/master_data/inventori/ruangan') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_inventori_ruangan') }}" class="menu-link">
                        <div data-i18n="Pricing">Data Ruangan</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('admin/dashboard/master_data/inventori/admin') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_inventori_admin') }}" class="menu-link">
                        <div data-i18n="Pricing">Data Pengguna</div>
                    </a>
                </li>
                <li
                    class="menu-item {{ request()->is('admin/dashboard/master_data/inventori/penjadwalan') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_inventori_penjadwalan') }}" class="menu-link">
                        <div data-i18n="Pricing">Data Penjadwalan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->is('admin/dashboard/peminjaman') ? 'active open' : '' }}">
            <a href="{{ route('admin.dashboard_peminjaman') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-file-export"></i>
                <div data-i18n="Tables">Data Peminjaman</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->

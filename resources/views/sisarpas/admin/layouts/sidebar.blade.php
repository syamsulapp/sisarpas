<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
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

        <li class="menu-item active open">
            <a href="index.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp;
                Tables</span></li>

        <li class="menu-item">
            <a href="peminjaman.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Tables">Data Peminjaman</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="pengembalian.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Tables">Data Pengembalian</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->

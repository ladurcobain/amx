<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->˝
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>menu</span></li>
                @if (Session::get('user_role') == 2)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('dashboard.admin') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('customer*') ? 'active' : '' }}"
                            href="{{ route('customer.index') }}">
                            <i class="ri-user-2-line"></i> <span>Customer</span>
                        </a>
                    </li>
                    <li class="menu-title"><span>Ekspedisi</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('provinsi*') ? 'active' : '' }}"
                            href="{{ route('provinsi.index') }}">
                            <i class="ri-user-2-line"></i> <span>Provinsi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('kota*') ? 'active' : '' }}"
                            href="{{ route('kota.index') }}">
                            <i class="ri-user-2-line"></i> <span>Kota</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('branch*') ? 'active' : '' }}"
                            href="{{ route('branch.index') }}">
                            <i class="ri-user-2-line"></i> <span>Cabang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('forwarder*') ? 'active' : '' }}"
                            href="{{ route('forwarder.index') }}">
                            <i class="ri-user-2-line"></i> <span>Forwarder</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('layanan*') ? 'active' : '' }}"
                            href="{{ route('layanan.index') }}">
                            <i class="ri-user-2-line"></i> <span>Layanan</span>
                        </a>
                    </li>
                    <li class="menu-title"><span>Pengaturan</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::is('user*') ? 'active' : '' }}"
                            href="{{ route('user.index') }}">
                            <i class="ri-user-2-line"></i><span>Pengguna</span>
                        </a>
                    </li>
                @elseif(Session::get('user_role') == 3)
                    @if (Session::get('user_account') == 'kasir')
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('dashboard.kasir') }}">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    @elseif(Session::get('user_account') == 'invoice')
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('dashboard.invoce') }}">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('biayakirm*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Biaya Kirim</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('viatransfer*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Via Transfer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('viatunai*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Via Tunai</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('tagihaninvoice*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Tagihan Invoice</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('pemasukan*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Pemasukan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('kirimbalik*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Kirim Balik</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('rekapinvoice*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Rekap Invoice</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('refereshbiaya*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Refresh Biaya Kiriman</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span>Laporan</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li>
                                        <h6 class="dropdown-header text-light">STT</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('belumeditbiaya*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Belum Edit Biaya</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('sudaheditbiaya*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Sudah Edit Biaya</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('terbiteditbiaya*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Terbit Edit Biaya</span>
                                        </a>
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header text-light">Invoice</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('belumlunas*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Belum Lunas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('sudahlunas*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Sudah Lunas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('tampilsemua*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Tampil Semua</span>
                                        </a>
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header text-light">Via Transfer</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('belumlunastransfer*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Belum Lunas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('sudahlunastransfer*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Sudah Lunas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('tampilsemuatransfer*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Tampil Semua</span>
                                        </a>
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header text-light">Via Tunai</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('belumlunastunai*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Belum Lunas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('sudahlunastunai*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Sudah Lunas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('tampilsemuatunai*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Tampil Semua</span>
                                        </a>
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header text-light">POD Customer</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('beluminputtanggal*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Belum Input Tanggal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('sudahinputtanggal*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Sudah Input Tanggal</span>
                                        </a>
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header text-light">Layanan</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('pemasukan*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Pemasukan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('penjualanperbulan*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Penjualan Perbulan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                    @else
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('dashboard.cservice') }}">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('suratjalan*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Surat
                                    Jalan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('tagihanvendor*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Tagihan
                                    Vendor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('pengeluaran*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i>
                                <span>Pengeluaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('lacakstt*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Lacak
                                    STT</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('hapuslacak*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Hapus
                                    Lacak</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('tandaterima*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i> <span>Tanda
                                    Terima</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ Request::is('statuspenerima*') ? 'active' : '' }}"
                                href=""> <i class="ri-user-2-line"></i>
                                <span>Status
                                    Penerima</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span>Laporan</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li>
                                        <h6 class="dropdown-header text-light">STT</h6>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('dalampengiriman*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Dalam
                                                Pengiriman</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('belumditerima*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Belum
                                                diterima</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{ Request::is('sudahditerima*') ? 'active' : '' }}"
                                            href=""> <i class="ri-user-2-line"></i> <span>Sudah
                                                diterima</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

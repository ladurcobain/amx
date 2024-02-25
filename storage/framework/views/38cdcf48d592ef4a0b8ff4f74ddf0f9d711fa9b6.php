<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->˝
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('assets/images/logo-light.png')); ?>" alt="" height="17">
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
                <?php if(Session::get('user_role') == 2): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="<?php echo e(route('dashboard.admin')); ?>">
                            <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('customer*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('customer.index')); ?>">
                            <i class="ri-user-2-line"></i> <span>Customer</span>
                        </a>
                    </li>
                <?php elseif(Session::get('user_role') == 3): ?>
                    <?php if(Session::get('user_account') == 'kasir'): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo e(route('dashboard.kasir')); ?>">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    <?php elseif(Session::get('user_account') == 'invoice'): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo e(route('dashboard.invoce')); ?>">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?php echo e(route('dashboard.cservice')); ?>">
                                <i class="ri-dashboard-2-line"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Session::get('user_role') == 2): ?>
                    <li class="menu-title"><span>Ekspedisi</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('provinsi*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('provinsi.index')); ?>">
                            <i class="ri-user-2-line"></i> <span>Provinsi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('kota*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('kota.index')); ?>">
                            <i class="ri-user-2-line"></i> <span>Kota</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('branch*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('branch.index')); ?>">
                            <i class="ri-user-2-line"></i> <span>Cabang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('forwarder*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('forwarder.index')); ?>">
                            <i class="ri-user-2-line"></i> <span>Forwarder</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('layanan*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('layanan.index')); ?>">
                            <i class="ri-user-2-line"></i> <span>Layanan</span>
                        </a>
                    </li>
                    <li class="menu-title"><span>Pengaturan</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(Request::is('user*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('user.index')); ?>">
                            <i class="ri-user-2-line"></i><span>Pengguna</span>
                        </a>
                    </li>
                <?php else: ?>
                    <?php if(Session::get('user_account') == 'kasir'): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(Request::is('forwarder*') ? 'active' : ''); ?>"
                                href="<?php echo e(route('forwarder.index')); ?>">
                                <i class="ri-user-2-line"></i> <span>kasir</span>
                            </a>
                        </li>
                    <?php elseif(Session::get('user_account') == 'invoice'): ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(Request::is('forwarder*') ? 'active' : ''); ?>"
                                href="<?php echo e(route('forwarder.index')); ?>">
                                <i class="ri-user-2-line"></i> <span>invoice</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo e(Request::is('forwarder*') ? 'active' : ''); ?>"
                                href="<?php echo e(route('forwarder.index')); ?>">
                                <i class="ri-user-2-line"></i> <span>cservie</span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH /Users/hmamacbook/Documents/Project yoga/amx/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>
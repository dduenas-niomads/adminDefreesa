<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-gray elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="/img/logo.png" alt="{{ env('APP_NAME') }} Logo" 
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        @php
            $user = \Auth::user();
        @endphp
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview @yield('nav-dashboard-menu')">
                    <a href="#" class="nav-link @yield('nav-dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Panel de control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/home" class="nav-link @yield('nav-overview')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Visión general</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/my-account" class="nav-link @yield('nav-account')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mi cuenta</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/categories" class="nav-link  @yield('nav-categories')">
                        <i class="fa fa-cubes nav-icon "></i>
                        <p>Categorías</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/suppliers" class="nav-link  @yield('nav-suppliers')">
                        <i class="fa fa-store-alt nav-icon "></i>
                        <p>Proveedores</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/delivery-users" class="nav-link  @yield('nav-delivery-users')">
                        <i class="fa fa-motorcycle nav-icon "></i>
                        <p>Repartidores</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/clients" class="nav-link  @yield('nav-clients')">
                        <i class="fa fa-heart nav-icon "></i>
                        <p>Consumidores</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/orders" class="nav-link  @yield('nav-orders')">
                        <i class="fa fa-clipboard-check nav-icon "></i>
                        <p>Pedidos y entregas</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/sales" class="nav-link  @yield('nav-sales')">
                        <i class="fa fa-file-invoice nav-icon "></i>
                        <p>Ventas y pagos</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/contact-support" class="nav-link  @yield('nav-contact-support')">
                        <i class="fa fa-headset nav-icon "></i>
                        <p>Soporte técnico</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <nav class="mt-2" style=" bottom: 0;">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <p>© 2020 {{ env('APP_NAME') }}</p>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
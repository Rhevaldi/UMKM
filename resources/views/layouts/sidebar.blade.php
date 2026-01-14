<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('welcome') }}" class="brand-link">
        <img src="adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">UMKM DIGITAL</span>
    </a>

    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="/adminlte/dist/img/umkm.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="{{ route('dashboard') }}" class="d-block">UMKM</a>
                        </div>
                    </div>
                </li>

                {{-- Search Bar --}}

                {{-- <li class="nav-item">
                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('orders.index') }}"
                        class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Pesanan</p>
                    </a>
                </li>




                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
    </div>
</aside>

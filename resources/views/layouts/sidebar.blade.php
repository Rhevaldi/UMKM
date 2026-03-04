<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- BRAND --}}
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}"
            class="brand-image img-circle elevation-3"
            style="opacity:.8">

        <span class="brand-text font-weight-light">
            UMKM DIGITAL
        </span>
    </a>


    <div class="sidebar">

        {{-- USER PANEL --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/umkm.jpg') }}"
                    class="img-circle elevation-2">
            </div>

            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">
                    Admin UMKM
                </a>
            </div>
        </div>


        {{-- MENU --}}
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">


                {{-- DASHBOARD --}}
                <li class="nav-item">

                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>Dashboard</p>

                    </a>

                </li>


                {{-- MASTER DATA --}}
                <li class="nav-header">MASTER DATA</li>


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



                {{-- TRANSAKSI --}}
                <li class="nav-header">TRANSAKSI</li>


                <li class="nav-item">

                    <a href="{{ route('orders.index') }}"
                        class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-shopping-cart"></i>

                        <p>Pesanan</p>

                    </a>

                </li>



                {{-- LAPORAN --}}
                <li class="nav-header">LAPORAN</li>


                <li class="nav-item">

                    <a href="{{ route('reports.index') }}"
                        class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-chart-bar"></i>

                        <p>Laporan Penjualan</p>

                    </a>

                </li>



                {{-- WEBSITE --}}
                <li class="nav-header">WEBSITE</li>


                <li class="nav-item">

                    <a href="{{ route('home') }}" class="nav-link" target="_blank">

                        <i class="nav-icon fas fa-globe"></i>

                        <p>
                            Lihat Website
                            <i class="right fas fa-external-link-alt"></i>
                        </p>

                    </a>

                </li>



                {{-- PENGATURAN --}}
                <li class="nav-header">PENGATURAN</li>


                {{-- PAYMENT SETTING --}}
                <li class="nav-item">

                    <a href="{{ route('payment.settings') }}"
                        class="nav-link {{ request()->routeIs('payment.settings') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-credit-card"></i>

                        <p>Pengaturan Pembayaran</p>

                    </a>

                </li>



                {{-- ACCOUNT --}}
                <li class="nav-header">ACCOUNT</li>


                <li class="nav-item">

                    <a href="{{ route('profile.edit') }}"
                        class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-user"></i>

                        <p>Profile</p>

                    </a>

                </li>



                {{-- LOGOUT --}}
                <li class="nav-item">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button class="nav-link btn btn-link text-left">

                            <i class="nav-icon fas fa-sign-out-alt"></i>

                            <p>Logout</p>

                        </button>

                    </form>

                </li>


            </ul>

        </nav>

    </div>

</aside>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
            UMKM Digital
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

            <ul class="navbar-nav align-items-center">

                <li class="nav-item me-3">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-success' : '' }}"
                        href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link {{ request()->routeIs('order.page') ? 'active fw-bold text-success' : '' }}"
                        href="{{ route('order.page') }}">
                        Pesan Produk
                    </a>
                </li>

                @auth

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm px-3">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-success text-secondary btn-sm px-3">
                            Login
                        </a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UMKM Digital | Sistem Informasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    {{-- Animate & AOS --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"/>

    <style>
        body {
            background: linear-gradient(135deg, #f4f6f9, #e9ecef);
            transition: background .3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1f2d3d, #111827);
        }

        .hero {
            min-height: 80vh;
            display: flex;
            align-items: center;
            background:
                radial-gradient(circle at top right, rgba(0,123,255,.08), transparent 40%),
                radial-gradient(circle at bottom left, rgba(40,167,69,.08), transparent 40%);
        }

        body.dark-mode .hero {
            background:
                radial-gradient(circle at top right, rgba(0,123,255,.15), transparent 45%),
                radial-gradient(circle at bottom left, rgba(40,167,69,.15), transparent 45%);
        }

        .hero-title {
            font-size: 2.4rem;
            font-weight: 600;
        }

        .hero-subtitle {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #6c757d;
        }

        body.dark-mode .hero-subtitle {
            color: #cfd4da;
        }

        .glass-card {
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(6px);
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,.08);
            padding: 2.5rem;
        }

        body.dark-mode .glass-card {
            background: rgba(30,41,59,.9);
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand-md navbar-white navbar-light border-bottom">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand font-weight-bold">
                UMKM Digital
            </a>

            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item mr-3">
                    <button id="darkToggle" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Content --}}
    <div class="content-wrapper">
        <div class="content hero">
            <div class="container">

                <div class="row align-items-center">
                    <div class="col-md-6"
                         data-aos="fade-right"
                         data-aos-duration="1000">
                        <h1 class="hero-title mb-3">
                            Sistem Informasi UMKM Digital
                        </h1>

                        <p class="hero-subtitle">
                            Platform terintegrasi untuk pengelolaan data UMKM,
                            monitoring perkembangan usaha, dan dukungan
                            pengambilan keputusan berbasis data.
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('login') }}"
                               class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-user-lock mr-1"></i> Login Sistem
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="main-footer text-center">
        <strong>&copy; {{ date('Y') }} UMKM Digital</strong><br>
        <small>Sistem Informasi Pengelolaan UMKM</small>
    </footer>

</div>

{{-- JS --}}
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
    AOS.init({
        once: true
    });

    const toggle = document.getElementById('darkToggle');
    const body = document.body;

    if (localStorage.getItem('darkMode') === 'on') {
        body.classList.add('dark-mode');
    }

    toggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem(
            'darkMode',
            body.classList.contains('dark-mode') ? 'on' : 'off'
        );
    });
</script>

</body>
</html>

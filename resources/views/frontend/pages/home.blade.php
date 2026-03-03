@extends('frontend.layouts.app')

@section('title', 'UMKM Digital')

@section('content')

    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container text-center text-white hero-content">
            <h1>UMKM Digital</h1>
            <p>Pesan produk favorit Anda dengan mudah & cepat</p>
            <a href="{{ route('order.page') }}" class="btn btn-primary btn-lg mt-3">
                Pesan Sekarang
            </a>
        </div>
    </section>

    

    <footer class="text-center py-4 bg-dark text-white">
        © {{ date('Y') }} UMKM Digital. All rights reserved.
    </footer>

@endsection

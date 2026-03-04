@extends('frontend.layouts.app')

@section('title', 'Pesan Produk')

@section('content')

    <section class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Pesan Produk
                </h2>

                <p class="text-muted">
                    Pilih produk dan isi data Anda
                </p>

            </div>


            <form action="{{ route('order.public') }}" method="POST">

                @csrf

                <div class="row g-4">

                    {{-- PRODUK --}}
                    <div class="col-lg-7">

                        <div class="card shadow-sm border-0 p-4">

                            <h5 class="mb-4">
                                Daftar Produk
                            </h5>

                            @foreach ($products as $product)
                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <div>

                                        <label>

                                            <input type="checkbox" name="products[]" value="{{ $product->id }}"
                                                class="product-check me-2" data-price="{{ $product->price }}">

                                            <strong>{{ $product->name }}</strong>

                                        </label>

                                        <div class="text-muted small">

                                            Rp {{ number_format($product->price, 0, ',', '.') }}

                                        </div>

                                    </div>

                                    <input type="number" name="quantities[]" value="1" min="1"
                                        class="form-control quantity-input" style="width:90px">

                                </div>
                            @endforeach

                        </div>

                    </div>


                    {{-- CUSTOMER --}}
                    <div class="col-lg-5">

                        <div class="card shadow border-0 p-4">

                            <h5 class="mb-4">
                                Data Pemesan
                            </h5>

                            <input type="text" name="name" class="form-control mb-3" placeholder="Nama Lengkap"
                                required>

                            <input type="text" name="phone" class="form-control mb-3" placeholder="No WhatsApp"
                                required>

                            <div class="alert alert-light">

                                <strong>Total:</strong>

                                <span id="totalPrice">
                                    Rp 0
                                </span>

                            </div>

                            <button class="btn btn-success w-100 btn-lg">

                               Lanjut ke Pembayaran

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>

@endsection

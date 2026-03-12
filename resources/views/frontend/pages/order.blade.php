@extends('frontend.layouts.app')

@section('title', 'Pesan Produk')

@section('content')

    <style>
        .menu-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            padding: 16px;
            transition: all .2s ease;
            height: 100%;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .menu-img {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
        }

        .menu-title {
            font-weight: 600;
            font-size: 16px;
        }

        .menu-price {
            color: #16a34a;
            font-weight: 600;
        }

        .stock-text {
            font-size: 13px;
            color: #6b7280;
        }

        .qty-box {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: #f3f4f6;
            font-weight: bold;
            cursor: pointer;
        }

        .qty-btn:hover {
            background: #e5e7eb;
        }

        .qty-input {
            width: 50px;
            text-align: center;
        }

        .checkout-card {
            border-radius: 14px;
        }

        .total-box {
            background: #f9fafb;
            border-radius: 10px;
            padding: 14px;
            font-size: 18px;
        }
    </style>



    <section class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Pesan Produk
                </h2>

                <p class="text-muted">
                    Pilih menu favorit Anda
                </p>

            </div>


            <form id="orderForm" action="{{ route('order.public') }}" method="POST">

                @csrf

                <div class="row g-4">

                    {{-- LIST PRODUK --}}
                    <div class="col-lg-7">

                        <div class="row">

                            @foreach ($products as $product)
                                @if ($product->stock > 0)
                                    <div class="col-md-6 mb-3">

                                        <div class="menu-card">

                                            <div class="d-flex justify-content-between align-items-center">

                                                <div class="d-flex gap-3">

                                                    @if ($product->image)
                                                        <img src="{{ asset($product->image) }}" class="menu-img">
                                                    @else
                                                        <img src="{{ asset('images/no-image.png') }}" class="menu-img">
                                                    @endif


                                                    <div>

                                                        <label class="menu-title d-block">

                                                            <input type="checkbox" class="product-check me-2"
                                                                name="products[]" value="{{ $product->id }}"
                                                                data-price="{{ $product->price }}">

                                                            {{ $product->name }}

                                                        </label>

                                                        <div class="menu-price">
                                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        </div>

                                                        <div class="stock-text">
                                                            Stok {{ $product->stock }}
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="qty-box">

                                                    <button type="button" class="qty-btn minus">-</button>

                                                    <input type="number" class="form-control qty-input quantity-input"
                                                        name="quantities[]" value="1" min="1"
                                                        max="{{ $product->stock }}" disabled>

                                                    <button type="button" class="qty-btn plus">+</button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>



                    {{-- CHECKOUT --}}
                    <div class="col-lg-5">

                        <div class="card checkout-card shadow-sm border-0">

                            <div class="card-body">

                                <h5 class="fw-bold mb-4">
                                    Data Pemesan
                                </h5>

                                <input type="text" name="name" class="form-control mb-3" placeholder="Nama Lengkap"
                                    required>

                                <input type="text" name="phone" class="form-control mb-4" placeholder="No WhatsApp"
                                    required>



                                <div class="total-box d-flex justify-content-between mb-4">

                                    <span>Total</span>

                                    <span class="fw-bold text-success fs-5" id="totalPrice">
                                        Rp 0
                                    </span>

                                </div>


                                <button class="btn btn-success w-100 btn-lg">
                                    Lanjut ke Pembayaran
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>

@endsection



@section('scripts')

    <script>
        function calculateTotal() {

            let total = 0;

            document.querySelectorAll('.menu-card').forEach(card => {

                const check = card.querySelector('.product-check');
                const qty = card.querySelector('.quantity-input');

                if (check.checked) {

                    const price = parseInt(check.dataset.price);
                    const quantity = parseInt(qty.value);

                    total += price * quantity;

                }

            });

            document.getElementById('totalPrice').innerText =
                "Rp " + total.toLocaleString('id-ID');

        }



        // aktifkan qty saat produk dicentang
        document.querySelectorAll('.product-check').forEach(check => {

            check.addEventListener('change', function() {

                const card = this.closest('.menu-card');
                const qty = card.querySelector('.quantity-input');

                qty.disabled = !this.checked;

                calculateTotal();

            });

        });



        // tombol plus
        document.querySelectorAll('.plus').forEach(btn => {

            btn.addEventListener('click', function() {

                const input = this.parentElement.querySelector('.quantity-input');

                if (input.disabled) return;

                let max = parseInt(input.max);
                let val = parseInt(input.value);

                if (val < max) {

                    input.value = val + 1;

                }

                calculateTotal();

            });

        });



        // tombol minus
        document.querySelectorAll('.minus').forEach(btn => {

            btn.addEventListener('click', function() {

                const input = this.parentElement.querySelector('.quantity-input');

                if (input.disabled) return;

                let val = parseInt(input.value);

                if (val > 1) {

                    input.value = val - 1;

                }

                calculateTotal();

            });

        });



        // input manual
        document.querySelectorAll('.quantity-input').forEach(input => {

            input.addEventListener('input', function() {

                let max = parseInt(this.max);

                if (this.value > max) {
                    this.value = max;
                }

                if (this.value < 1) {
                    this.value = 1;
                }

                calculateTotal();

            });

        });



        // validasi submit
        document.getElementById('orderForm').addEventListener('submit', function(e) {

            const checked = document.querySelectorAll('.product-check:checked');

            if (checked.length === 0) {

                alert("Silakan pilih minimal 1 produk");

                e.preventDefault();

            }

        });
    </script>

@endsection

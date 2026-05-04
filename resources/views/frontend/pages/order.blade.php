@extends('frontend.layouts.app')

@section('title', 'Pesan Produk')

@section('content')




<section class="order-section py-5">

<div class="container">

    {{-- HEADER --}}
    <div class="text-center mb-5">

        <h1 class="page-title">
            Pilih Menu 
        </h1>

        <p class="page-sub">
            Order cepat & praktis langsung dari website
        </p>

    </div>


    {{-- SEARCH --}}
    <div class="row justify-content-center mb-4">

        <div class="col-lg-5">

            <div class="input-group search-box">

                <span class="input-group-text bg-white border-0">🔍</span>

                <input type="text"
                       id="searchMenu"
                       class="form-control border-0"
                       placeholder="Cari makanan / minuman...">

            </div>

        </div>

    </div>


    {{-- FILTER --}}
    <div class="text-center mb-5">

        <button class="btn btn-success filter-btn active" data-filter="all">
            Semua
        </button>

        @foreach ($categories as $category)
            <button class="btn btn-outline-success filter-btn"
                data-filter="{{ strtolower($category->name) }}">
                {{ $category->name }}
            </button>
        @endforeach

    </div>


    <form id="orderForm" action="{{ route('order.public') }}" method="POST">
    @csrf

    <div class="row g-4">

        {{-- PRODUK --}}
        <div class="col-lg-8">

            <div class="row g-4" id="productList">

                @foreach ($products as $product)
                @if ($product->stock > 0)

                <div class="col-md-6 col-xl-4 product-item"
                    data-name="{{ strtolower($product->name) }}"
                    data-category="{{ strtolower($product->category->name ?? 'lainnya') }}">

                    <div class="product-card">

                        <div class="product-image">
                            <img src="{{ $product->image ? asset($product->image) : asset('images/no-image.png') }}">
                        </div>

                        <div class="product-body">

                            <div class="d-flex justify-content-between">

                                <div>
                                    <div class="fw-semibold">
                                        {{ $product->name }}
                                    </div>

                                    <small class="text-muted">
                                        Stok {{ $product->stock }}
                                    </small>
                                </div>

                                <input type="checkbox"
                                       class="product-check"
                                       name="products[]"
                                       value="{{ $product->id }}"
                                       data-price="{{ $product->price }}"
                                       data-name="{{ $product->name }}">

                            </div>

                            <div class="product-price mt-2">
                                Rp {{ number_format($product->price,0,',','.') }}
                            </div>

                            <div class="qty-box">
                                <button type="button" class="qty-btn minus">−</button>

                                <input type="number"
                                    class="qty-input quantity-input"
                                    name="quantities[]"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    disabled>

                                <button type="button" class="qty-btn plus">+</button>
                            </div>

                        </div>

                    </div>

                </div>

                @endif
                @endforeach

            </div>

        </div>


        {{-- CART --}}
        <div class="col-lg-4">

            <div class="checkout-card">

                <h5 class="fw-bold mb-3">
                    🧾 Ringkasan Order
                </h5>

                <ul id="cartList" class="cart-list mb-3"></ul>

                <div class="p-3 rounded mb-3"
                     style="background:#16a34a; color:white;">

                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <span id="totalPrice">Rp 0</span>
                    </div>

                </div>

                <input type="text"
                    name="name"
                    class="form-control mb-2"
                    placeholder="Nama Lengkap" required>

                <input type="text"
                    name="phone"
                    class="form-control mb-3"
                    placeholder="No WhatsApp" required>

                <button class="btn btn-success w-100 fw-bold">
                    🚀 Checkout Sekarang
                </button>

            </div>

        </div>

    </div>

    </form>

</div>
</section>

@endsection



@section('scripts')

<script>
document.addEventListener("DOMContentLoaded", function() {

    function updateCart() {

        let total = 0;
        let html = "";

        document.querySelectorAll(".product-card").forEach(card => {

            let check = card.querySelector(".product-check");
            let qty = card.querySelector(".quantity-input");

            if (check.checked) {

                let price = parseInt(check.dataset.price);
                let quantity = parseInt(qty.value);

                total += price * quantity;

                html += `<li>
                    <span>${check.dataset.name}</span>
                    <span>x${quantity}</span>
                </li>`;
            }

        });

        document.getElementById("cartList").innerHTML = html;
        document.getElementById("totalPrice").innerText =
            "Rp " + total.toLocaleString("id-ID");
    }

    document.querySelectorAll(".product-check").forEach(check => {

        check.addEventListener("change", function() {

            let card = this.closest(".product-card");
            let qty = card.querySelector(".quantity-input");
            let box = card.querySelector(".qty-box");

            qty.disabled = !this.checked;
            box.style.display = this.checked ? "flex" : "none";

            updateCart();

        });

    });

    document.querySelectorAll(".plus").forEach(btn => {

        btn.addEventListener("click", function() {

            let input = this.parentElement.querySelector(".quantity-input");
            let max = parseInt(input.max);

            if (!input.disabled && input.value < max) input.value++;

            updateCart();
        });

    });

    document.querySelectorAll(".minus").forEach(btn => {

        btn.addEventListener("click", function() {

            let input = this.parentElement.querySelector(".quantity-input");

            if (!input.disabled && input.value > 1) input.value--;

            updateCart();
        });

    });

});
</script>

@endsection
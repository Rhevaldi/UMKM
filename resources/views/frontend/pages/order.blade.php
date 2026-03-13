@extends('frontend.layouts.app')

@section('title', 'Pesan Produk')

@section('content')

    <section class="order-section py-5">

        <div class="container">

            <div class="text-center mb-4">
                <h2 class="fw-bold">Pesan Produk</h2>
                <p class="text-muted">Pilih menu favorit Anda</p>
            </div>

            {{-- SEARCH --}}
            <div class="row justify-content-center mb-3">

                <div class="col-lg-6">

                    <input type="text" id="searchMenu" class="form-control search-input" placeholder="Cari menu...">

                </div>

            </div>


            <div class="text-center mb-4">

                <button class="btn btn-outline-success filter-btn active" data-filter="all">
                    Semua
                </button>

                @foreach ($categories as $category)
                    <button class="btn btn-outline-success filter-btn" data-filter="{{ strtolower($category->name) }}">

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
                                    <div class="col-md-6 col-xl-4 product-item" data-name="{{ strtolower($product->name) }}"
                                        data-category="{{ strtolower($product->category->name ?? 'lainnya') }}">

                                        <div class="product-card">

                                            {{-- BEST SELLER --}}
                                            @if ($loop->index < 2)
                                                <div class="badge-best">🔥 Best Seller</div>
                                            @endif

                                            <div class="product-image">

                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}">
                                                @endif

                                            </div>

                                            <div class="product-body">

                                                <label class="product-title">

                                                    <input type="checkbox" class="product-check" name="products[]"
                                                        value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                        data-name="{{ $product->name }}">

                                                    {{ $product->name }}

                                                </label>

                                                <div class="product-price">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </div>

                                                <div class="stock-text">
                                                    Stok {{ $product->stock }}
                                                </div>

                                                <div class="qty-box">

                                                    <button type="button" class="qty-btn minus">−</button>

                                                    <input type="number" class="qty-input quantity-input"
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


                    {{-- CART --}}
                    <div class="col-lg-4">

                        <div class="checkout-card">

                            <div class="floating-cart" id="floatingCart">

                                <h6 class="fw-bold mb-2">🛒 Keranjang</h6>

                                <ul id="cartList" class="cart-list"></ul>

                                <div class="cart-total">
                                    Total : <span id="totalPrice">Rp 0</span>
                                </div>

                                

                            </div>

                            <hr>

                            <input type="text" name="name" class="form-control mb-3" placeholder="Nama Lengkap"
                                required>

                            <input type="text" name="phone" class="form-control" placeholder="No WhatsApp" required>

                           <button class="btn btn-success w-100 mt-3">
                                    Checkout
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

            let searchInput = document.getElementById("searchMenu");
            let filterButtons = document.querySelectorAll(".filter-btn");
            let products = document.querySelectorAll(".product-item");


            let currentFilter = "all";
            let currentSearch = "";


            /* FILTER + SEARCH */

            function filterProducts() {

                products.forEach(item => {

                    let name = item.dataset.name;
                    let category = item.dataset.category;

                    let matchSearch = name.includes(currentSearch);
                    let matchCategory = (currentFilter === "all" || category === currentFilter);

                    item.style.display = (matchSearch && matchCategory) ? "block" : "none";

                });

            }


            /* SEARCH */

            searchInput.addEventListener("keyup", function() {

                currentSearch = this.value.toLowerCase();

                filterProducts();

            });


            /* CATEGORY */

            filterButtons.forEach(btn => {

                btn.addEventListener("click", function() {

                    filterButtons.forEach(b => b.classList.remove("active"));

                    this.classList.add("active");

                    currentFilter = this.dataset.filter;

                    filterProducts();

                });

            });


            /* CART */

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

                        html += `
<li>
<span>${check.dataset.name}</span>
<span>x${quantity}</span>
</li>
`;

                    }

                });

                document.getElementById("cartList").innerHTML = html;

                document.getElementById("totalPrice").innerText =
                    "Rp " + total.toLocaleString("id-ID");

            }


            /* CHECKBOX */

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


            /* PLUS */

            document.querySelectorAll(".plus").forEach(btn => {

                btn.addEventListener("click", function() {

                    let input = this.parentElement.querySelector(".quantity-input");

                    if (input.disabled) return;

                    let max = parseInt(input.max);

                    if (parseInt(input.value) < max) {

                        input.value++;

                    }

                    updateCart();

                });

            });


            /* MINUS */

            document.querySelectorAll(".minus").forEach(btn => {

                btn.addEventListener("click", function() {

                    let input = this.parentElement.querySelector(".quantity-input");

                    if (input.disabled) return;

                    if (parseInt(input.value) > 1) {

                        input.value--;

                    }

                    updateCart();

                });

            });


        });
    </script>

@endsection

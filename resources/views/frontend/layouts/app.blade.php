<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'UMKM template')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/LineIcons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/custom.css') }}">
   
</head>

<body>



    @yield('content')


    <script src="{{ asset('template/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/scrolling-nav.js') }}"></script>
    <script src="{{ asset('template/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const checkboxes = document.querySelectorAll('.product-check');
            const quantities = document.querySelectorAll('.quantity-input');
            const totalDisplay = document.getElementById('totalPrice');

            function calculateTotal() {
                let total = 0;

                checkboxes.forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        let price = parseInt(checkbox.dataset.price);
                        let qty = parseInt(quantities[index].value);
                        total += price * qty;
                    }
                });

                totalDisplay.innerText = "Rp " + total.toLocaleString('id-ID');
            }

            checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));
            quantities.forEach(q => q.addEventListener('input', calculateTotal));

        });
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NUTSTREE | CHECKOUT</title>
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/style.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
        @include('temp.layouts.Humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
        @include('temp.layouts.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Catégories</span>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="#">{{ $category->type }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="https://media.istockphoto.com/id/523458571/fr/photo/des-assortiments-de-fruits-secs-bio.jpg?s=612x612&w=0&k=20&c=QTJNyWYJSaUnU4hqmxr7BTjRdjaj4QblLQyx2UuAplM=">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('layouts.home')}}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Détails de Facturation</h4>
                <form action="{{ route('commande.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <input type="hidden" name="cart_items" value="{{ json_encode($cartItems) }}">
                            <div class="checkout__input">
                                <p>Nom Complet<span>*</span></p>
                                <input type="text" name="name" required>
                            </div>
                            <div class="checkout__input">
                                <p>Pays<span>*</span></p>
                                <input
                                    type="text"
                                    id="pays"
                                    name="pays"
                                    placeholder="Choisir un pays"
                                    autocomplete="off"
                                    class="autocomplete-input"
                                    required>
                                <ul id="pays-list" class="autocomplete-list hidden">
                                    @foreach ($countries as $name)
                                        <li class="autocomplete-item" data-value="{{ $name }}">{{ $name }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="checkout__input">
                                <p>Adresse<span>*</span></p>
                                <input type="text" name="addresse" placeholder="Adresse de la rue" required>
                            </div>
                            <div class="checkout__input">
                                <p>Ville<span>*</span></p>
                                <input type="text" name="ville" required>
                            </div>

                         {{--    <script>
                                document.getElementById('ville').addEventListener('input', function(e) {
                                    e.target.value = e.target.value.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
                                });
                            </script> --}}

                            <div class="checkout__input">
                                <p>Code Postal<span>*</span></p>
                                <input type="text" name="codepostal" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Téléphone<span>*</span></p>
                                        <input type="text" name="tel" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Notes de commande<span>*</span></p>
                                <input type="text" name="order_notes" placeholder="Remarques concernant votre commande, ex. instructions spéciales pour la livraison.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Votre Commande</h4>
                                <div class="checkout__order__products">Produits <span>Total</span></div>
                                <ul>
                                    @foreach ($cartItems as $item)
                                        <li>{{ $item->product->nom }} (x{{ $item->quantity }})<span>${{ number_format($item->product->prix , 2) }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">
                                    Sous-total <span>${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="checkout__order__subtotal">
                                    Frais Livraison <span>${{ number_format($deliveryFee, 2) }}</span>
                                </div>
                                <div class="checkout__order__total">
                                    Total <span>${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="checkout__input__radio">
                                    <label for="payment_cash">
                                        Paiement à la livraison
                                        <input type="radio" name="payment_method" value="Cash on Delivery" id="payment_cash" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__radio">
                                    <label for="payment_card">
                                        Paiement par Carte
                                        <input type="radio" name="payment_method" value="Credit Card" id="payment_card" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PASSER LA COMMANDE</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
        @include('temp.layouts.footer')
    <!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="/home/js/jquery-3.3.1.min.js"></script>
    <script src="/home/js/bootstrap.min.js"></script>
    <script src="/home/js/jquery.nice-select.min.js"></script>
    <script src="/home/js/jquery-ui.min.js"></script>
    <script src="/home/js/jquery.slicknav.js"></script>
    <script src="/home/js/mixitup.min.js"></script>
    <script src="/home/js/owl.carousel.min.js"></script>
    <script src="/home/js/main.js"></script>

<style>
    .autocomplete-list {
    position: absolute;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    max-height: 200px;
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
    padding: 0;
    margin: 0;
    list-style: none;
}

.autocomplete-item {
    padding: 10px;
    cursor: pointer;
}

.autocomplete-item:hover {
    background-color: #f0f0f0;
}

.hidden {
    display: none;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('pays');
    const list = document.getElementById('pays-list');

    input.addEventListener('input', function () {
        const query = input.value.toLowerCase();
        const items = list.querySelectorAll('.autocomplete-item');

        if (query) {
            list.classList.remove('hidden');
            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.startsWith(query)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        } else {
            list.classList.add('hidden');
        }
    });

    // Handle selecting an item
    list.addEventListener('click', function (e) {
        if (e.target && e.target.matches('.autocomplete-item')) {
            input.value = e.target.getAttribute('data-value');
            list.classList.add('hidden');
        }
    });

    // Hide list when clicking outside
    document.addEventListener('click', function (e) {
        if (!list.contains(e.target) && e.target !== input) {
            list.classList.add('hidden');
        }
    });
});

</script>

</body>

</html>

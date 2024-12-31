<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panier | NUTSTREE</title>
    @vite('resources/css/app.css')

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">

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
                            <form action="{{ route('prod.index') }}">
                                <div class="hero__search__categories">
                                    Catégories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" name="search" placeholder="De quoi avez-vous besoin ?">
                                <button type="submit" class="site-btn">CHERCHER</button>
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
    @if(session('success'))
    <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-md text-center">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif

    @if(session('delP'))
        <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-md text-center">
            <strong>{{ session('delP') }}</strong>
        </div>
    @endif
    @if(session('error'))
    <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-md text-center">
    <strong>{{ session('error') }}</strong>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul class="list-unstyled">
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
                        <h2>Panier Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('layouts.home')}}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <form action="{{ route('cart.updateMultiple') }}" method="POST">
                            @csrf
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Produits</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Si l'utilisateur est connecté et a des articles dans le panier --}}
                                    @if(auth()->check() && $cartItems->count() > 0)
                                        @foreach($cartItems as $item)
                                            <tr>
                                                @if($item->product)
                                                    <td class="shoping__cart__item md:flex md:flex-nowrap">
                                                        <img src="{{ asset('storage/' . ($item->product->firstImage?->images ?? 'default-image.jpg')) }}"
                                                             class="rounded-md w-48 shadow-md">
                                                        <h4 class="text-gray-800 font-bold">{{ $item['name'] ?? $item->product->nom }}</h4>
                                                    </td>
                                                    <td class="shoping__cart__price">
                                                        {{ number_format($item['price'] ?? $item->product->prix, 2) }} DH
                                                    </td>
                                                    <td class="shoping__cart__quantity">
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="number" name="quantity[{{ $item->id }}]"
                                                                       value="{{ $item['quantity'] ?? $item->quantity }}" min="1" class="update-quantity">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="shoping__cart__total">
                                                        {{ number_format(($item['price'] ?? $item->product->prix) * ($item['quantity'] ?? $item->quantity), 2) }} DH
                                                    </td>
                                                    <td class="shoping__cart__item__close">
                                                        <a class="remove-item" data-item-id="{{ $item['id'] }}"
                                                           onclick="removeItem(event, '{{ route('cart.remove', $item['id']) }}')">
                                                            <span class="icon_close"></span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td colspan="5" class="text-center">Votre panier est vide !</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @elseif(!auth()->check() && session('cart'))
                                        {{-- Si l'utilisateur n'est pas connecté mais utilise une session pour le panier --}}
                                        @foreach(session('cart') as $item)
                                            <tr>
                                                    <td class="shoping__cart__item md:flex md:flex-nowrap">
                                                        <img src="{{ asset('storage/' . ($item['image']->images ?? 'default-image.jpg')) }}"
                                                        alt="{{ $item['name'] }}" class="rounded-md w-48 shadow-md">
                                                        <h4 class="text-gray-800 font-bold">{{ $item['name'] ?? $item->product->nom }}</h4>
                                                    </td>
                                                    <td class="shoping__cart__price">
                                                        {{ number_format($item['price'] ?? $item->product->prix, 2) }} DH
                                                    </td>
                                                    <td class="shoping__cart__quantity">
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="number" name="quantity[{{ $item['id'] }}]" value="{{ $item['quantity'] }}" min="1" class="update-quantity">

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="shoping__cart__total">
                                                        {{ number_format(($item['price'] ?? $item->product->prix) * ($item['quantity'] ?? $item->quantity), 2) }} DH
                                                    </td>
                                                    <td class="shoping__cart__item__close">
                                                        <a class="remove-item" data-item-id="{{ $item['id'] }}"
                                                           onclick="removeItem(event, '{{ route('cart.remove', $item['id']) }}')">
                                                            <span class="icon_close"></span>
                                                        </a>
                                                    </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Votre panier est vide !</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="shoping__cart__btns">
                                <a href="{{route('prod.index')}}" class="primary-btn cart-btn">CONTINUER LES ACHATS</a>
                                <button type="submit" class="primary-btn cart-btn cart-btn-right">
                                    <span class="icon_loading"></span> Mettre à jour le panier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Codes de réduction</h5>
                            <form action="{{ route('apply.promo') }}" method="POST">
                                @csrf
                                <input type="text" name="code" placeholder="Entrez votre code promo">
                                <button type="submit" class="site-btn">APPLIQUER LE CODE</button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h5 class="text-2xl font-bold text-gray-800 mb-6">Total du Panier</h5>
                        <ul class="mb-6 text-gray-700">
                            @php
                            $subtotal = 0;

                            if (auth()->check()) {
                                // Authenticated user: Calculate subtotal from the database cart
                                $subtotal = auth()->user()->cartItems->sum(function ($item) {
                                    return $item->quantity * $item->product->prix;
                                });
                            } elseif (session('cart')) {
                                // Guest user: Calculate subtotal from the session cart
                                foreach (session('cart') as $item) {
                                    $subtotal += ($item['quantity'] ?? 1) * ($item['price'] ?? 0);
                                }
                            }
                        @endphp

                        <li class="flex justify-between py-2 border-b">
                            <span class="font-medium">Sous-total</span>
                            <span>{{ number_format($subtotal, 2) }} MAD</span>
                        </li>

                            @if(session('promo_code'))
                                @if(session('discountAmount') > 0)
                                    <li class="flex justify-between py-2 border-b">
                                        <span class="font-medium text-green-600">Réduction appliquée</span>
                                        <span>-{{ number_format(session('discountAmount'), 2) }} MAD</span>
                                    </li>
                                   {{--  <li class="flex justify-between py-2 border-b">
                                        <span class="font-medium">Sous-total après réduction</span>
                                        <span>{{ number_format(session('newSubtotal', 0), 2) }} MAD</span>
                                    </li> --}}
                                @endif
                            @endif

                            <li class="flex justify-between py-2 border-b">
                                <span class="font-medium">Frais de Livraison</span>
                                <span>{{ number_format(session('deliveryFee', $deliveryFee), 2) }} MAD</span>
                            </li>

                            <li class="flex justify-between py-2 font-semibold text-lg text-green-600">
                                <span>Total</span>
                                <span>{{ number_format(session('total', $total), 2) }} MAD</span>
                            </li>
                        </ul>

                        <form action="{{ route('update.city') }}" method="POST" class="mb-4">
                            @csrf
                            <label for="city" class="block text-gray-700 font-medium mb-2">Ajustez votre ville</label>
                            <div class="flex items-center space-x-4">
                                <select name="city" id="city" class="appearance-none w-full border border-gray-300 rounded-md focus:ring focus:ring-green-300 focus:outline-none bg-white text-gray-700" required>
                                    <option value="" disabled selected>Veuillez sélectionner une ville</option>
                                    @foreach($allCities as $availableCity)
                                    <option value="{{ $availableCity }}" {{ $availableCity == $currentCity ? 'selected' : '' }}>
                                        {{ ucfirst($availableCity) }}
                                    </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="px-4 py-3 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-700 transition duration-200">Ajuster</button>
                            </div>
                        </form>

                            <a href="{{route('pay.check')}}">
                                <button type="submit" class="primary-btn bg-green-600 text-white text-center py-3 rounded-md block font-semibold shadow hover:bg-green-700 transition duration-200">
                                    PASSER À LA CAISSE
                                </button>
                            </a>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>


    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
        @include('temp.layouts.footer')
    <!-- Footer Section End -->

    <script>

        function removeItem(event, url) {
            event.preventDefault();  // Prevent the default link action

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer ce produit ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, navigate to the removal route
                    window.location.href = url;
                }
            });
        }
    </script>
    <!-- Js Plugins -->
    <script src="/home/js/jquery-3.3.1.min.js"></script>
    <script src="/home/js/bootstrap.min.js"></script>
    <script src="/home/js/jquery.nice-select.min.js"></script>
    <script src="/home/js/jquery-ui.min.js"></script>
    <script src="/home/js/jquery.slicknav.js"></script>
    <script src="/home/js/mixitup.min.js"></script>
    <script src="/home/js/owl.carousel.min.js"></script>
    <script src="/home/js/main.js"></script>

</body>

</html>


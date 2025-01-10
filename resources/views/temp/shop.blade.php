
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produits | NUTSTREE</title>
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
                        <li>
                            <a
                                href="{{ route('prod.index', ['category' => $category->id]) }}"
                                class="{{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->type }}
                            </a>
                        </li>
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
    <div class="alert alert-success mx-auto text-center bg-green-500 text-green-900 p-4 rounded-md shadow-md w-3/4 md:w-1/2">
        <strong>{{ session('success') }}</strong>
    </div>
@endif

@if(session('error'))
<div class="alert alert-success mx-auto text-center bg-red-500 text-red-900 p-4 rounded-md shadow-md w-3/4 md:w-1/2">
    <strong>{{ session('error') }}</strong>
</div>
@endif

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="https://media.istockphoto.com/id/523458571/fr/photo/des-assortiments-de-fruits-secs-bio.jpg?s=612x612&w=0&k=20&c=QTJNyWYJSaUnU4hqmxr7BTjRdjaj4QblLQyx2UuAplM=">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>NUTSTREE Shop</h2>
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

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                @foreach ($categories as $category)
                                <li><a href="#">{{ $category->type }}</a></li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Derniers Produits</h4>
                                <div class="latest-product__slider owl-carousel">
                                    @foreach ($latestProduits as $product)
                                        <div class="latest-prdouct__slider__item">
                                            <a href="{{ route('prod.details', $product->id) }}" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="{{ $product->firstImage ? asset('storage/' . $product->firstImage->images) : asset('storage/default.jpg') }}">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{ $product->nom }}</h6>
                                                    <span>{{ number_format($product->prix, 2) }} MAD</span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Promo</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($produitsDiscount as $product)
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                 data-setbg="{{ $product->firstImage ? asset('storage/' . $product->firstImage->images) : asset('storage/default.jpg') }}" alt="{{ $product->nom }}">
                                                <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                                <ul class="product__item__pic__hover">
                                                    @if ($product->quantite > 0)
                                        <li><a onclick="addToCart({{ $product->id }})" style="cursor: pointer" title="Ajouter en panier">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a></li>
                                        @else
                                        <li><a href="#" title="Rupture de Stock"><i class="fa fa-ban"></i></a></li>
                                        @endif
                                                </ul>
                 <script>
                    function addToCart(productId) {
                        fetch(`/cart/add/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    html: `<h3>${data.message}</h3>`,
                                    icon: 'success',
                                });
                            } else {
                                Swal.fire({
                                    html: `<h3>${data.message || 'Une erreur est survenue.'}</h3>`,
                                    icon: 'success',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                html: `<h3>Erreur lors de l'ajout au panier.</h3>`,
                                icon: 'error',
                            });
                        });
                    }
                </script>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>
                                                    @isset($product->categorie_id)
                                                    @foreach($categories as $categorie)
                                                        @if($categorie->id == $product->categorie_id)
                                                            <span class="bg-green-200 text-green-700 text-sm px-2 py-1 rounded">
                                                                {{$categorie->type}}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                @endisset
                                                </span>
                                                <h5><a href="{{ route('prod.details', $product->id) }}">{{ $product->nom }}</a></h5>
                                                <div class="product__item__price">
                                                    {{ number_format($product->prix * (1 - $product->discount / 100), 2) }} MAD
                                                    <span>{{ number_format($product->prix, 2) }} MAD</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                               {{--  <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div> --}}
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    @if(isset($product))
                                    <h6><span>{{$product->count()}}</span> Products found</h6>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($produits as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg"
                                         data-setbg="{{ $product->firstImage ? asset('storage/' . $product->firstImage->images) : asset('storage/default.jpg') }}">
                                        <ul class="product__item__pic__hover">
                                            @if ($product->quantite > 0)
                                                    <li><a onclick="addToCart({{ $product->id }})" href="#" title="Ajouter en panier">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </a></li>
                                            @else
                                                    <li><a href="#" title="Rupture de Stock"><i class="fa fa-ban"></i></a></li>
                                                    @endif
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{ route('prod.details', $product->id) }}">{{ $product->nom }}</a></h6>
                                        <h5>{{ number_format($product->prix, 2) }} MAD</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($produits->count() > 0)
                        <div class="">
                            {!! $produits->links() !!}
                        </div>
                    @else
                        <p>Aucun produit disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    <!-- Product Section End -->

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


</body>

</html>

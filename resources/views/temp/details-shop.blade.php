<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $produit->nom }} - Nutstree</title>
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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="https://media.istockphoto.com/id/523458571/fr/photo/des-assortiments-de-fruits-secs-bio.jpg?s=612x612&w=0&k=20&c=QTJNyWYJSaUnU4hqmxr7BTjRdjaj4QblLQyx2UuAplM=">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>
                            @isset($produit->categorie_id)
                            @foreach($categories as $categorie)
                                @if($categorie->id == $produit->categorie_id)
                                    <span class="bg-green-200 text-green-700 text-sm px-2 py-1 rounded">
                                        {{$categorie->type}} Package
                                    </span>
                                @endif
                            @endforeach
                        @endisset
                        </h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>{{$produit->nom}} Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                            src="{{ $produit->firstImage ? asset('storage/' . $produit->firstImage->images) : asset('storage/default.jpg') }}"
                            alt="{{ $produit->nom }}">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach ($produit->images as $image)
                            <img data-imgbigurl="{{ asset('storage/' . $image->images) }}" alt="{{ $produit->nom }}"
                            src="{{ asset('storage/' . $image->images) }}" alt="{{ $produit->nom }}"
                           >
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $produit->nom }}</h3>
                        <div class="product__details__rating">
                             @for($i = 1; $i <= 5; $i++)
                                @if($i <= $produit->rating)
                                    <i class="fa fa-star"></i> <!-- Étoile pleine -->
                            @else
                                    <i class="fa fa-star-o"></i> <!-- Étoile vide -->
                                @endif
                            @endfor
                            <span>( {{$produit->reviews->count()}} reviews)</span>
                        </div>
                        <div class="product__details__price">
                            @if($produit->discount > 0)
                            <span style="text-decoration: line-through;">{{ number_format($produit->prix, 2) }} MAD</span> <!-- Prix normal barré -->
                            <span>{{ number_format($produit->prix * (1 - $produit->discount / 100), 2) }} MAD</span> <!-- Prix avec réduction -->
                        @else
                            <span>{{ number_format($produit->prix, 2) }} MAD</span>
                        @endif
                        </div>
                        <p>{{ $produit->description }}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="number" name="quantite" id="quantity" value="1" min="1" max="{{ $produit->quantite }}">
                                </div>
                            </div>
                        </div>
                        <a style="cursor:pointer" onclick="addToCart({{ $produit->id }})"  class="primary-btn">AJOUT EN PANIER</a>
                        <ul>
                            <li><b>Disponibilité</b>
                                @if ($produit->quantite > 0)
                                <span>En stock</span>
                                @else
                                <span>Non disponible</span>
                                @endif
                            </li>
                            {{--  <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li> --}}
                            <li><b>Mesure</b> <span>{{$produit->mesure}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>({{$produit->reviews->count()}})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>
                                        @if ($produit->description)
                                        {{$produit->description}}
                                        @else
                                        <p>pas de description</p>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    @forelse($produit->reviews as $review)
                                    <p>
                                        {{ $produit->$review->content }}
                                    </p>
                                    @empty
                                    <p>pas de commentaires</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ $product->firstImage ? asset('storage/' . $product->firstImage->images) : asset('storage/default.jpg') }}">
                                <ul class="product__item__pic__hover">
                                    <li><a style="cursor:pointer" onclick="addToCart({{ $produit->id }})"><i class="fa fa-shopping-cart"></i></a></li>
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
        </div>
    </section>

    <!-- Related Product Section End -->
    <!-- Footer Section Begin -->
    @include('temp.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->

    <script>
        function addToCart(productId) {
            var quantity = document.getElementById('quantity').value;
            if (quantity < 1) {
                Swal.fire({
                    html: `<h3>Veuillez sélectionner une quantité valide.</h3>`,
                    icon: 'error',
                });
                return;
            }
            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    quantity: quantity,
                }),
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
                        icon: 'error',
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


    <script src="/home/js/jquery-3.3.1.min.js"></script>
    <script src="/home/js/bootstrap.min.js"></script>
    <script src="/home/js/jquery.nice-select.min.js"></script>
    <script src="/home/js/jquery-ui.min.js"></script>
    <script src="/home/js/jquery.slicknav.js"></script>
    <script src="/home/js/mixitup.min.js"></script>
    <script src="/home/js/owl.carousel.min.js"></script>
    <script src="/home/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".latest-product__slider").owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NUTSTREE </title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.default.min.css">

    @vite('resources/css/app.css')

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
    <!-- Hero Section Begin -->

    @include('temp.layouts.sec1')

    <!-- Hero Section End -->
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($categories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('storage/' . $category->image) }}">
                                <h5><a href="#">{{ $category->type }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- Categories Section End -->
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Products</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach($categories as $category)
                                <li data-filter=".{{ strtolower($category->type) }}">{{ $category->type }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row featured__filter">
                @foreach($produits as $produit)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $produit->Categories ? strtolower($produit->Categories->type) : 'no-category' }}">
                    <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="{{ $produit->firstImage ? asset('storage/' . $produit->firstImage->images) : asset('storage/default.jpg') }}">
                                    <ul class="featured__item__pic__hover">
                                        @if ($produit->quantite > 0)
                                        <li><a onclick="addToCart({{ $produit->id }})" style="cursor: pointer" title="Ajouter en panier">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a></li>
                                        @else
                                        <li><a href="#" title="Rupture de Stock"><i class="fa fa-ban"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="{{route('prod.details',$produit->id)}}" title="{{$produit->nom}}">
                                        {{ $produit->nom }}</a></h6>
                                    <h5>{{ $produit->prix }} DH</h5>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
    </section>
    <!-- Featured Section End -->
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="{{ route('cart.sendPromo') }}">
                            <img src="https://img.freepik.com/photos-gratuite/vue-gros-plan-noix-cinq-bols-bruns-noix-au-centre-du-tableau-blanc_140725-111442.jpg?t=st=1734928465~exp=1734932065~hmac=54c27401d948a200bdd672321d5322be7319eda9feef29b3014dbeb5b2ff8dd2&w=1800" alt="">
                        </a>
                    </div>
                <br>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="https://img.freepik.com/photos-gratuite/assortiment-fruits-seches-bio_114579-49246.jpg?t=st=1734928439~exp=1734932039~hmac=957f39250979e1e51d09a9f30877aa8ad621642ca2fdeb0d78122b30b40dccff&w=1800" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <!-- Latest Products -->
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($latestProduits as $produit)
                                <div class="latest-prdouct__slider__item">
                                    <a href="{{ route('prod.details', $produit->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ $produit->firstImage ? asset('storage/' . $produit->firstImage->images) : asset('storage/default.jpg') }}" alt="{{ $produit->nom }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $produit->nom }}</h6>
                                            <span>${{ $produit->prix }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Top Rated Products -->
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($topRatedProduits as $produit)
                                <div class="latest-prdouct__slider__item">
                                    <a href="{{ route('prod.details', $produit->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ $produit->firstImage ? asset('storage/' . $produit->firstImage->images) : asset('storage/default.jpg') }}" alt="{{ $produit->nom }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $produit->nom }}</h6>
                                            <span>${{ $produit->prix }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Review Products -->
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($reviewProduits as $produit)
                                <div class="latest-prdouct__slider__item">
                                    <a href="{{ route('prod.details', $produit->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ $produit->firstImage ? asset('storage/' . $produit->firstImage->images) : asset('storage/default.jpg') }}" alt="{{ $produit->nom }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $produit->nom }}</h6>
                                            <span>${{ $produit->prix }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Product Section End -->
    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="https://media.istockphoto.com/id/496689738/fr/photo/assortiment-de-fruits-%C3%A0-coque.jpg?s=612x612&w=0&k=20&c=fMXTH3jZEV86RI5WYtA6nq7vOJh2jrCn5a2x2bzFodg=" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Dec 16, 2024</li>
                                <li><i class="fa fa-comment-o"></i> 12</li>
                            </ul>
                            <h5><a href="#">How to Choose the Best Dried Fruits for Your Health</a></h5>
                            <p>Learn about the health benefits of dried fruits and how to incorporate them into your diet for a healthier lifestyle.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="https://img-3.journaldesfemmes.fr/klQXxQDCaHGIjU2rDYHs2Y7sR_w=/1500x/smart/1be07b6379f941f484764e5f4693a067/ccmcms-jdf/16962606.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Dec 14, 2024</li>
                                <li><i class="fa fa-comment-o"></i> 7</li>
                            </ul>
                            <h5><a href="#">Creative Recipes with Dried Fruits</a></h5>
                            <p>Explore unique recipes that use dried fruits as main ingredients, perfect for snacks, desserts, or healthy meals.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="https://www.musculation.com/wikibody/wp-content/uploads/2021/10/shutterstock_292640861.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Dec 10, 2024</li>
                                <li><i class="fa fa-comment-o"></i> 8</li>
                            </ul>
                            <h5><a href="#">The Benefits of Organic Dried Fruits for Your Skin</a></h5>
                            <p>Discover how organic dried fruits can improve your skin health and how to incorporate them into your daily routine.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section End -->
    <!-- Footer Section Begin -->

    @include('temp.layouts.footer')

     <!-- Js Plugins -->
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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name='copyright' content=''>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Nutstree</title>
        <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <!-- nice-select CDN (Si vous l'utilisez) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select@1.1.0/dist/css/nice-select.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/nice-select@1.1.0/dist/js/nice-select.js"></script>

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/niceselect.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flex-slider.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color1.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color3.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color4.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color5.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color6.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color7.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color8.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color9.css') }}">
        <link rel="stylesheet" href="{{ asset('css/color/color10.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="#" id="colors">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </head>
<body class="js">

	<!-- Preloader -->
	{{--  <div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div> --}}
	<!-- End Preloader -->

	<header class="header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-email"></i> support@shophub.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-location-pin"></i> Store location</li>
								<li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
								<li><i class="ti-user"></i> <a href="#">My account</a></li>
								<li><i class="ti-power-off"></i><a href="login.html#">Login</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="{{route('main.index')}}">
                                <h5>NUTSTREE</h5>
                            </a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
								<form class="search-form">
									<input type="text" placeholder="Search here..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
							<!--/ End Search Form -->
						</div>
						<!--/ End Search Form -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-8 col-md-7 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <!-- Dropdown avec les catégories -->
                                <select>
                                    <option selected="selected" value="">All Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->type }}</option>
                                    @endforeach
                                </select>
                                <!-- Formulaire de recherche -->
                                <form action="{{ route('products.search') }}" method="GET">
                                    <input name="search" placeholder="Search Products Here....." type="search">
                                    <button class="btnn" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

					<div class="col-lg-2 col-md-3 col-12">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="sinlge-bar">
                                <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="sinlge-bar">
                                <a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="sinlge-bar shopping">
                                <a href="#" class="single-icon">
                                    <i class="ti-bag"></i>
                                    <span class="total-count">{{ $cartItems->count() }}</span>
                                </a>
                                <!-- Shopping Item Auth -->
                                @if(auth()->check() && $cartItems)
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ $cartItems->count() }} Items</span>
                                        <a href="{{ route('cart.show') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach($cartItems as $item)
                                            <li>
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-bold">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </form>
                                                <a class="cart-img" href="{{ route('prod.details', $item->product->id) }}">
                                                    <img src="{{ asset('storage/' . ($item->product->firstImage?->images ?? 'default-image.jpg')) }}" alt="{{ $item->product->nom }}">
                                                </a>
                                                <h4><a href="#">{{ $item->product->nom }}</a></h4>
                                                <p class="quantity">{{ $item->quantity }}x - <span class="amount">{{ number_format($item->product->prix, 2) }} MAD</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">
                                                {{ number_format($cartItems->sum(fn($item) => $item->product ? $item->quantity * $item->product->prix : 0), 2) }} MAD
                                            </span>
                                        </div>
                                        <a href="" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            @elseif(!auth()->check() && session('cart'))
                                <!-- Panier pour utilisateur non connecté -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ count(session('cart')) }} Items</span>
                                        <a href="{{ route('cart.show') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(session('cart') as $item)
                                            <li>
                                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-bold">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </form>
                                                <a class="cart-img" href="{{ route('prod.details', $item['id']) }}">
                                                    <img src="{{ asset('storage/' . ($item['image'] ?? 'default-image.jpg')) }}" alt="{{ $item['name'] }}">
                                                </a>
                                                <h4><a href="#">{{ $item['name'] }}</a></h4>
                                                <p class="quantity">{{ $item['quantity'] }}x - <span class="amount">{{ number_format($item['price'], 2) }} MAD</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">
                                                {{ number_format(array_sum(array_map(fn($item) => $item['quantity'] * $item['price'], session('cart'))), 2) }} MAD
                                            </span>
                                        </div>
                                        <a href="" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									<li><a href="#">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="sub-category">
											<li><a href="#">accessories</a></li>
											<li><a href="#">best selling</a></li>
											<li><a href="#">top 100 offer</a></li>
											<li><a href="#">sunglass</a></li>
											<li><a href="#">watch</a></li>
											<li><a href="#">man’s product</a></li>
										</ul>
									</li>
									<li class="main-mega"><a href="#">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="mega-menu">
											<li class="single-menu">
												<a href="#" class="title-link">Shop Kid's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Kids Toys</a>
													<a href="#">Kids Travel Car</a>
													<a href="#">Kids Color Shape</a>
													<a href="#">Kids Tent</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="#" class="title-link">Shop Men's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Watch</a>
													<a href="#">T-shirt</a>
													<a href="#">Hoodies</a>
													<a href="#">Formal Pant</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="#" class="title-link">Shop Women's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Ladies Shirt</a>
													<a href="#">Ladies Frog</a>
													<a href="#">Ladies Sun Glass</a>
													<a href="#">Ladies Watch</a>
												</div>
											</li>
										</ul>
									</li>
									<li><a href="#">accessories</a></li>
									<li><a href="#">top 100 offer</a></li>
									<li><a href="#">sunglass</a></li>
									<li><a href="#">watch</a></li>
									<li><a href="#">man’s product</a></li>
									<li><a href="#">ladies</a></li>
									<li><a href="#">westrn dress</a></li>
									<li><a href="#">denim </a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">
										<div class="nav-inner">
											<ul class="nav main-menu menu navbar-nav">
												<li class="active"><a href="#">Home<i class="ti-angle-down"></i></a>
													<ul class="dropdown">
														<li><a href="#">Home Ecommerce V1</a></li>
													</ul>
												</li>
												<li><a href="#">Product</a></li>
												<li><a href="#">Service</a></li>
												<li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
													<ul class="dropdown">
														<li><a href="shop-list.html">Shop List</a></li>
														<li><a href="#">Cart</a></li>
														<li><a href="#">Checkout</a></li>
													</ul>
												</li>
												<li><a href="#">Pages<i class="ti-angle-down"></i></a>
													<ul class="dropdown">
														<li><a href="#">About Us</a></li>
														<li><a href="#">Login</a></li>
														<li><a href="#">Register</a></li>
													</ul>
												</li>
												<li><a href="#">Blog<i class="ti-angle-down"></i></a>
													<ul class="dropdown">
														<li><a href="blog-grid.html">Blog Grid</a></li>
													</ul>
												</li>
												<li><a href="#">Contact Us</a></li>
											</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->

	<!-- Start Small Banner  -->
	<section class="hero-slider">
        <!-- Single Slider -->
        <div class="single-slider">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="slider-wrapper">
                            <!-- Partie Texte -->
                            <div class="hero-text-wrapper">
                                <div class="hero-text">
                                    <h1><span>JUSQU'À 50% DE RÉDUCTION</span> sur les fruits secs</h1>
                                    <p>Découvrez une sélection exceptionnelle de fruits secs, <br> riches en saveurs et bienfaits pour votre santé. <br> Profitez d'offres exclusives dès maintenant !</p>
                                    <div class="button">
                                        <a href="#" class="btn">Achetez Maintenant!</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Partie Image -->
                            <div class="slider-image">
                                <!-- L'image de fond est contrôlée ici -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Single Slider -->
    </section>


	<!-- Start Product Area -->
    <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Trending Item</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="tab-content" id="myTabContent">
								<!-- Start Single Tab -->
								<div class="tab-pane fade show active" id="man" role="tabpanel">
                                    <div class="tab-single">
                                        <div class="row">
                                            @foreach($produits as $produit)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <a href="{{ route('prod.details', $produit->id) }}">
                                                            <img class="default-img" src="{{ asset('storage/' . ($produit->firstImage?->images ?? 'default-image.jpg')) }}" alt="{{ $produit->nom }}">
                                                            <img class="hover-img" src="{{ asset('storage/' . ($produit->secondImage?->images ?? 'default-image.jpg')) }}" alt="{{ $produit->nom }}">
                                                        </a>
                                                        <div class="button-head">
                                                            <div class="product-action">
                                                                <a title="Quick View" href="#"><i class="ti-shopping-cart"></i><span>Quick Shop</span></a>
                                                            </div>
                                                            <div class="product-action-2">
                                                                @if ($produit->quantite > 0)
                                                                <button
                                                                    onclick="addToCart({{ $produit->id }})"
                                                                    title="Add to cart"
                                                                    class="add-to-cart-button"
                                                                    >
                                                                    Add to cart
                                                                </button>
                                                                @else
                                                                <p class="w-full py-3 text-center bg-red-500 text-white font-semibold rounded-lg">
                                                                    Rupture de stock
                                                                </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        {{-- script to add cart --}}
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

                                                        {{-- end script --}}
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="{{ route('prod.details', $produit->id) }}">{{ $produit->nom }}</a></h3>
                                                        <div class="product-price">
                                                            <span>{{ number_format($produit->prix, 2) }} MAD</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
								<!--/ End Single Tab -->
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->

	<!-- Start Midium Banner  -->
	<section class="midium-banner">
        <div class="container">
            <div class="row">
                <!-- Bannière Fruits Secs -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="https://images.pexels.com/photos/7420937/pexels-photo-7420937.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Fruits Secs">
                        <div class="content">
                            <p>Collection Fruits Secs</p>
                            <h3>Offres Exclusives <br>Jusqu'à <span>50%</span></h3>
                            <a href="#">Achetez Maintenant</a>
                        </div>
                    </div>
                </div>
                <!-- /Fin Bannière Fruits Secs -->
                <!-- Bannière Fruits Exotiques -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="https://images.pexels.com/photos/3108193/pexels-photo-3108193.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Fruits Exotiques">
                        <div class="content">
                            <p>Fruits Exotiques</p>
                            <h3>Promo de Saison <br> Jusqu'à <span>70%</span></h3>
                            <a href="#" class="btn">Achetez Maintenant</a>
                        </div>
                    </div>
                </div>
                <!-- /Fin Bannière Fruits Exotiques -->
            </div>
        </div>
    </section>
	<!-- End Midium Banner -->

	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Produits Populaires</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
                        @foreach ($produits as $produit)
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('prod.details', $produit->id) }}">
                                        <img class="default-img" src="{{ asset('storage/' . $produit->firstImage?->images ?? 'default-image.jpg') }}" alt="{{ $produit->nom }}">
                                        <img class="hover-img" src="{{ asset('storage/' . $produit->secondImage?->images ?? 'default-image.jpg') }}" alt="{{ $produit->nom }}">
                                        <span class="{{ $produit->is_hot ? 'out-of-stock' : '' }}">
                                            {{ $produit->is_hot ? 'Hot' : '' }}
                                        </span>
                                        <span class="{{ $produit->is_new ? 'new' : '' }}">
                                            {{ $produit->is_new ? 'Nouveau' : '' }}
                                        </span>
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class="ti-eye"></i><span>Voir rapidement</span></a>
                                            <a title="Wishlist" href="#"><i class="ti-heart"></i><span>Ajouter à la liste d'envies</span></a>
                                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Comparer</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            @if ($produit->quantite > 0)
                                            <button
                                                onclick="addToCart({{ $produit->id }})"
                                                title="Add to cart"
                                                class="add-to-cart-button"
                                                >
                                                Add to cart
                                            </button>
                                            @else
                                            <p class="w-full py-3 text-center bg-red-500 text-white font-semibold rounded-lg">
                                                Rupture de stock
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{ route('prod.details', $produit->id) }}">{{ $produit->nom }}</a></h3>
                                    <div class="product-price">
                                        @if ($produit->old_price)
                                            <span class="old">{{ number_format($produit->old_price, 2) }} MAD</span>
                                        @endif
                                        <span>{{ number_format($produit->prix, 2) }} MAD</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- End Most Popular Area -->

	<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>On sale</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1598111388756-b2285cca0458?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
									<p class="price with-discount">$59</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$44</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1597608578202-34e8e4f76deb?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$89</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Best Seller</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$65</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$33</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$77</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top viewed</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$22</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$35</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://images.unsplash.com/photo-1602948750761-97ea79ee42ec?q=80&w=2541&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$99</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Home List  -->

	<!-- Start Cowndown Area -->
    <section class="cown-down">
		<div class="section-inner ">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-12 padding-right">
						<div class="image">
							<img src="https://www.bioalaune.com/img/article/2021/10674-faut-il-manger-plus-de-fruits-secs.png" alt="#">
						</div>
					</div>
					<div class="col-lg-6 col-12 padding-left">
						<div class="content">
							<div class="heading-block">
								<p class="small-title">Deal of day</p>
								<h3 class="title">Beatutyful dress for women</h3>
								<p class="text">Suspendisse massa leo, vestibulum cursus nulla sit amet, frungilla placerat lorem. Cars fermentum, sapien. </p>
								<h1 class="price">120 MAD <s>290 MAD</s></h1>
								<div class="coming-time">
									<div class="clearfix" data-countdown="2026/12/30"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /End Cowndown Area -->
	<!-- Start Shop Blog  -->
	<section class="shop-blog section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>From Our Blog</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="https://media.istockphoto.com/id/523458571/fr/photo/des-assortiments-de-fruits-secs-bio.jpg?s=612x612&w=0&k=20&c=QTJNyWYJSaUnU4hqmxr7BTjRdjaj4QblLQyx2UuAplM=" alt="#">
						<div class="content">
							<p class="date">10 Décembre, 2024. Lundi</p>
                                <a href="#" class="title">
                                    Les Bienfaits des Fruits Secs pour votre Santé
                                </a>
                                <a href="#" class="more-btn">Lire la suite</a>
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="https://medias.toutelanutrition.com/ressource/104/Fruits%20secs%20et%20noix.jpg" alt="#">
						<div class="content">
							<p class="date">10 Décembre, 2024. Lundi</p>
                            <a href="#" class="title">
                                Les Bienfaits des Fruits Secs pour votre Santé
                            </a>
                            <a href="#" class="more-btn">Lire la suite</a>
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Start Single Blog  -->
					<div class="shop-single-blog">
						<img src="https://img-3.journaldesfemmes.fr/klQXxQDCaHGIjU2rDYHs2Y7sR_w=/1500x/smart/1be07b6379f941f484764e5f4693a067/ccmcms-jdf/16962606.jpg" alt="#">
						<div class="content">
                            <p class="date">10 Décembre, 2024. Lundi</p>
                            <a href="#" class="title">
                                Les Bienfaits des Fruits Secs pour votre Santé
                            </a>
                            <a href="#" class="more-btn">Lire la suite</a>
						</div>
					</div>
					<!-- End Single Blog  -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Blog  -->

	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <sapn class="ic"><i class="ti-package"></i></sapn>
                        <h4>Livraison Gratuite</h4>
                        <p>Pour les commandes supérieures à 500 MAD</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <span class="ic"><i class="ti-loop"></i></span>
                        <h4>Retour Gratuit</h4>
                        <p>Retour sous 15 jours</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <span class="ic"><i class="ti-shield"></i></span>
                        <h4>Paiement Sécurisé</h4>
                        <p>100% sécurisé</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <span class="ic"><i class="ti-star"></i></span>
                        <h4>Meilleur Prix</h4>
                        <p>Prix garanti pour nos produits</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>

	<!-- End Shop Services Area -->

	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

	<!-- Start Footer Area -->
	<footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo2.png" alt="Nutstree"></a>
                            </div>
                            <p class="text">Nutstree, votre destination pour les meilleurs fruits secs, soigneusement sélectionnés pour une qualité exceptionnelle et un goût inégalé.</p>
                            <p class="call">Une question ? Appelez-nous 24/7<span><a href="tel:212612345678">+212 6 12 34 56 78</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Informations</h4>
                            <ul>
                                <li><a href="#">À propos</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Conditions Générales</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Aide</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Service Client</h4>
                            <ul>
                                <li><a href="#">Modes de Paiement</a></li>
                                <li><a href="#">Garantie de Remboursement</a></li>
                                <li><a href="#">Politique de Retour</a></li>
                                <li><a href="#">Livraison</a></li>
                                <li><a href="#">Politique de Confidentialité</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Contactez-Nous</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>123 Rue des Fruits Secs</li>
                                    <li>Casablanca, Maroc</li>
                                    <li>contact@nutstree.com</li>
                                    <li>+212 6 12 34 56 78</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <div class="copyright">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <p>Copyright © 2024 <a href="http://www.nutstree.com" target="_blank">Nutstree</a> - Tous Droits Réservés.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right">
                                <img src="{{asset('img/payments.png')}}" alt="Méthodes de Paiement">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="{{ asset('js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/colors.js') }}"></script>
<script src="{{ asset('js/slicknav.min.js') }}"></script>
<script src="{{ asset('js/owl-carousel.js') }}"></script>
<script src="{{ asset('js/magnific-popup.js') }}"></script>
<script src="{{ asset('js/facnybox.min.js') }}"></script>
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<script src="{{ asset('js/finalcountdown.min.js') }}"></script>
<script src="{{ asset('js/nicesellect.js') }}"></script>
<script src="{{ asset('js/ytplayer.min.js') }}"></script>
<script src="{{ asset('js/flex-slider.js') }}"></script>
<script src="{{ asset('js/scrollup.js') }}"></script>
<script src="{{ asset('js/onepage-nav.min.js') }}"></script>
<script src="{{ asset('js/easing.js') }}"></script>
<script src="{{ asset('js/active.js') }}"></script>

</body>
</html>

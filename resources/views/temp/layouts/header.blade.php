<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                            <li>Livraison gratuite pour toute commande de 99 MAD</li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <div>Français</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Arabe</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            @guest
                            <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
                            @endguest
                            @auth
                            <a href="{{route('auth.logout')}}"><i class="fa fa-sign-out"></i> Deconnexion</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{route('layouts.home')}}">
                       {{--  <img src="/images/logo.png" alt=""> --}}
                       <h4><strong>NUTSTREE</strong> </h4>

                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{route('layouts.home')}}">Accueil</a></li>
                        <li><a href="{{route('prod.index')}}">Boutique</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{route('cart.show')}}">Panier</a></li>
                                <li><a href="#">Paiement</a></li>
                                <li><a href="#">Détails du blog</a></li>
                                <li><a href="{{route('layouts.contact')}}">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin()))
                        <li><a href="{{ route('dash.home') }}">Dashboard</a>
                        </li>
                         @endif
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <!-- Cart Icon and Link -->
                            <a href="{{ route('cart.show') }}">
                                <i class="fa fa-shopping-bag"></i>
                                <span>
                                    {{ auth()->check()
                                        ? collect($cartItems)->count()
                                        : collect(session('cart', []))->count()
                                    }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <!-- User Icon and Link -->
                            <a href="{{ auth()->check() ? route('auth.profile', auth()->user()->id) : route('login') }}">
                                <i class="fa fa-user text-gray-500 text-xl"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Total Cart Price -->
                    <div class="header__cart__price">
                        Item:
                        <span>
                            {{ number_format(
                                (auth()->check()
                                    ? $cartItems->sum(function($item) {
                                        return $item->product ? $item->quantity * $item->product->prix : 0;
                                    })
                                    : (is_array(session('cart')) ? array_sum(array_map(function($item) {
                                        return $item['quantity'] * $item['price'];
                                    }, session('cart'))) : 0)
                                ), 2)
                            }} MAD
                        </span>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
</header>

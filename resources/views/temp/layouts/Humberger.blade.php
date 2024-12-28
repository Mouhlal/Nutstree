<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="/">
        <h5>NUTSTREE </h5>
        </a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('cart.show') }}">
                <i class="fa fa-shopping-bag"></i>
                <span>
                    {{ auth()->check()
                        ? collect($cartItems)->count()
                        : collect(session('cart', []))->count()
                    }}
                </span>
            </a></li>
        </ul>
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
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <div>Maroc</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">English</a></li>
                <li><a href="#">Français</a></li>
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
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{route('layouts.home')}}">Home</a></li>
            <li><a href="{{route('prod.index')}}">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{route('cart.show')}}">Panier</a></li>
                    <li><a href="{{route('pay.check')}}">Check Out</a></li>
                    <li><a href="#">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="#">Blog</a></li>
            <li><a href="{{route('layouts.contact')}}">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

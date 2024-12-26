<section class="hero">
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
                                Catégories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="De quoi avez-vous besoin ?">
                            <button type="submit" class="site-btn">CHERCHER</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+212 6 00 00 00 00</h5>
                            <span>Support 24/7</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="https://img.freepik.com/photos-premium/noix-fruits-secs-isoles-fond-blanc_88281-5393.jpg?w=1800">
                    <div class="hero__text">
                        <span>Fruits Secs</span>
                        <h2>Produits <br />100% Naturels</h2>
                        <p>Livraison rapide et gratuite</p>
                        <a href="{{route('prod.index')}}" class="primary-btn">ACHETER MAINTENANT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

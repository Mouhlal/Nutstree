<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Commande {{$commande->numCom}} </title>
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


    <div class="container my-5">
        <div class="row">
            <!-- Section Commande -->
            <div class="col-lg-12">
                <h2 class="mb-4">Détails de la Commande N°{{ $commande->numCom }}</h2>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Informations Commande</h5>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Numéro Commande</th>
                                    <td>{{ $commande->numCom }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date de Commande</th>
                                    <td>{{ $commande->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Client</th>
                                    <td>{{ $commande->User->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Statut</th>
                                    <td>{{ ucfirst($commande->status) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Méthode de Paiement</th>
                                    <td>{{ ucfirst($billingInfo['payment_method']) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total</th>
                                    <td>{{ number_format($billingInfo['total'], 2) }}MAD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Section Produits Commandés -->
            <div class="col-lg-12">
                <h4 class="mb-4">Produits Commandés</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nom du Produit</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Prix Unitaire</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commande->products as $product)
                            <tr>
                                <td>{{ $product->nom }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ number_format($product->pivot->prix, 2) }}MAD</td>
                                <td>{{ number_format($product->pivot->quantity * $product->pivot->prix, 2) }}MAD</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Informations de Facturation -->
            <div class="col-lg-12 mt-4">
                <h4 class="mb-4">Informations de Facturation</h4>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Nom :</strong> {{ $billingInfo['name'] }}</p>
                        <p><strong>Adresse :</strong> {{ $commande->location }}</p>
                        <p><strong>Méthode de Paiement :</strong> {{ $billingInfo['payment_method'] }}</p>
                        <p><strong>Status de Paiement :</strong> {{ $billingInfo['payment_status'] }}</p>
                        <p><strong>Total :</strong> {{ number_format($billingInfo['total'], 2) }} MAD</p>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 'admin' || Auth::user()->role =='superadmin')
            <div class="col-lg-12 mt-4">
                <a href="{{ route('commande.pdf', $commande->id) }}" class="btn btn-primary">Télécharger la Commande</a>
            </div>
            @endif

        </div>
    </div>
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">
    <title>Mon Profil</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    @include('temp.layouts.Humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    @include('temp.layouts.header')
    <!-- Header Section End -->
    @if(session('update'))
    <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-md text-center">
    {{ session('update') }}
    </div>
    @endif
    <!-- Profile Section Begin -->
    <section class="profile-section spad">
        <div class="container">
            <h2 class="text-center mb-4">Mon Profil</h2>

            <!-- User Information Table -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Mes Informations</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nom</th>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Téléphone</th>
                                @if(!empty(auth()->user()->tel))
                                <td>{{ auth()->user()->tel }}</td>
                                @else
                                <td>Non renseigné</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Ville</th>
                                @if(!empty(auth()->user()->ville))
                                <td>{{ auth()->user()->ville }}</td>
                                @else
                                <td>Non renseigné</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Date d'inscription</th>
                                <td>{{ auth()->user()->created_at->format('d/m/Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a href="{{ route('auth.editp',$user->id) }}" class="btn btn-warning">
                            <i class="fa fa-edit"></i> Modifier mon profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card">
                <div class="card-header">
                    <h4>Mes Commandes</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                @foreach($commande->products as $product)
                                <td>{{ number_format($product->pivot->quantity * $product->pivot->prix, 2) }}MAD</td>
                                @endforeach
                                <td>
                                    <span class="badge badge-{{ $order->status === 'livrée' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('commande.details', $order->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> Voir
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Vous n'avez passé aucune commande pour l'instant.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile Section End -->

    <!-- Footer Section Begin -->
    @include('temp.layouts.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/home/js/jquery-3.3.1.min.js"></script>
    <script src="/home/js/bootstrap.min.js"></script>
    <script src="/home/js/jquery.nice-select.min.js"></script>
    <script src="/home/js/jquery-ui.min.js"></script>
    <script src="/home/js/jquery.slicknav.js"></script>
    <script src="/home/js/main.js"></script>

</body>

</html>





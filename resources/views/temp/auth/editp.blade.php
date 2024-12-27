@auth
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

    <title>Modifier Profil</title>

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

    <section class="profile-section spad">
        <div class="container">
            <h2 class="text-center mb-4">Modifier mon Profil</h2>

            <!-- Form to Update Profile -->
            <form action="{{ route('auth.updatep',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h4>Mes Informations</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" >
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" >
                        </div>

                        <div class="form-group">
                            <label for="cin">CIN</label>
                            <input type="text" id="cin" name="cin" class="form-control" value="{{$user->cin}}" >
                        </div>

                        <div class="form-group">
                            <label for="city">Ville</label>
                            <input type="text" id="city" name="ville" class="form-control" value="{{$user->ville }}" >
                        </div>

                        <div class="form-group">
                            <label for="country">Pays</label>
                            <input type="text" id="country" name="pays" class="form-control" value="{{$user->pays}}" >
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Code Postal</label>
                            <input type="text" id="postal_code" name="codepostal" class="form-control" value="{{$user->codepostal}}" >
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="text" id="phone" name="tel" class="form-control" value="{{$user->tel}}" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image de Profil</label>
                            <input type="file" id="image" name="image" class="form-control">
                            @if(auth()->user()->image)
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Image" class="img-fluid mt-2" style="max-width: 150px;">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de Passe</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Laissez vide si vous ne voulez pas changer le mot de passe">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de Passe</label>
                            <input type="password" id="password" name="password_confirmed" class="form-control" placeholder="confirmer nouveau mot de passe">
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Mettre à jour mon profil</button>
                </div>
            </form>
        </div>
    </section>

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
@endauth

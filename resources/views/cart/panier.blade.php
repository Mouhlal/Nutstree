<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
</head>
<body class="bg-gray-100">

    @include('layouts.nav')

    <br><br>

    <main class="container mx-auto p-6 mt-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Votre Panier</h1>

        <!-- Message de confirmation -->
        @if(session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Vérification du contenu du panier -->
        @if($cartItems->count() > 0)
        <div class="space-y-6">
            @foreach($cartItems as $item)
            <div class="flex justify-between items-center">
                <div>
                    @if($item->product)
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->nom }}" width="50">
                        {{ $item->product->nom }} -
                        {{ number_format($item->product->prix, 2) }} MAD
                    @else
                        <span class="text-gray-500">Produit non disponible</span>
                    @endif
                </div>
                <div class="flex items-center">
                    <!-- Formulaire pour mettre à jour la quantité -->
                    @if($item->product)
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 p-1 border rounded-md">
                            <button type="submit" class="ml-2 px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mettre à jour</button>
                        </form>
                    @endif

                    <!-- Bouton Supprimer -->
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="ml-4 text-red-600 hover:text-red-800 font-bold">X</button>
                    </form>
                </div>
            </div>

            @endforeach
        </div>

        <div class="flex justify-between items-center mt-6">
            <div class="text-xl font-semibold text-gray-800">
                <p>Total :
                    <span class="text-green-600">
                        {{ number_format($cartItems->sum(function($item) {
                            return $item->product ? $item->quantity * $item->product->prix : 0;
                        }), 2) }} MAD
                    </span>
                </p>
            </div>
            <a href="" class="btn-primary py-2 px-6 text-black bg-yellow-400 hover:bg-yellow-300 rounded-md">
                Passer à la caisse
            </a>
        </div>
        @else
            <p class="text-center text-gray-600">Votre panier est vide. Vous pouvez commencer à ajouter des produits.</p>
        @endif
    </main>

    <br><br>

    @include('layouts.footer')

</body>
</html>

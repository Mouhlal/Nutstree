<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commandes - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('layouts.nav')

<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Mes Commandes</h1>
    @if(session('success'))
    <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-md text-center">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-md text-center">
        {{ session('error') }}
    </div>
    @endif
    @if($commandes && $commandes->isNotEmpty())
        @foreach($commandes as $commande)
            <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                <h2 class="text-lg font-bold mb-2">Commande #{{ $commande->numCom }}</h2>
                <p>Date : {{ $commande->dateCom->format('d/m/Y') }}</p>
                <p>Statut : {{ ucfirst($commande->status) }}</p>
                <p>Total : {{ number_format($commande->totalPrix, 2) }} MAD</p>
                <h3 class="mt-4 font-semibold">Produits :</h3>
                <ul>
                    @foreach($commande->products as $product)
                        <li>{{ $product->nom }} x {{ $product->pivot->quantity }} ({{ number_format($product->pivot->prix, 2) }} MAD)</li>
                    @endforeach
                </ul>

                <!-- Bouton Annuler la commande -->
                @if($commande->status !== 'cancelled')
                    <form action="{{ route('commandes.cancel', $commande->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">Annuler la commande</button>
                    </form>
                @else
                    <p class="text-red-500 mt-2">Commande annulée</p>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-gray-600">Vous n'avez pas de commandes pour le moment.</p>
    @endif
</div>

@include('layouts.footer')
</body>
</html>

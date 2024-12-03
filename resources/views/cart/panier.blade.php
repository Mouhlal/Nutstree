<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Nutstree</title>
    @vite('resources/css/app.css')
    <title>NUTSTREE</title>
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">
</head>
<body class="bg-gray-100">

    @include('layouts.nav')

    <main class="container mx-auto p-6 mt-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Votre Panier</h1>

        @if(session('cart'))
            <div class="space-y-4">
                @foreach(session('cart') as $productId => $details)
                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/products/' . $details['image']) }}" alt="{{ $details['nom'] }}" class="w-16 h-16 object-cover rounded-md mr-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $details['nom'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $details['quantite'] }} x {{ number_format($details['prix'], 2) }} MAD</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-green-600">{{ number_format($details['prix'] * $details['quantite'], 2) }} MAD</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end mt-6">
                <div class="text-xl font-semibold text-gray-800">
                    <p>Total:
                        <span class="text-green-600">{{ number_format(array_reduce(session('cart'), function($carry, $item) {
                            return $carry + ($item['prix'] * $item['quantite']);
                        }, 0), 2) }} MAD</span>
                    </p>
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('prod.index') }}" class="btn-primary py-2 px-6 text-white bg-blue-600 hover:bg-blue-700 rounded-md">Continuer vos achats</a>
                <a href="" class="btn-primary py-2 px-6 text-white bg-green-600 hover:bg-green-700 rounded-md">Passer à la caisse</a>
            </div>
        @else
            <p class="text-center text-gray-600">Votre panier est vide.</p>
        @endif
    </main>

    @include('layouts.footer')

</body>
</html>

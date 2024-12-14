<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('layouts.nav')

    <!-- Contenu principal -->
    <main class="flex-grow container mx-auto py-12 px-4 lg:px-8">
        <div class="bg-white p-8 shadow-lg rounded-lg">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Votre Panier</h1>

            <!-- Message de confirmation -->
            @if(session('success'))
                <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-md text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('delP'))
                <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-md text-center">
                    {{ session('delP') }}
                </div>
            @endif
            @if(session('error'))
    <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-md text-center">
        {{ session('error') }}
    </div>
@endif


            <!-- Vérification du contenu du panier -->
            @if(auth()->check() && $cartItems->count() > 0)
            <div class="space-y-8">
                    @foreach($cartItems as $item)
                    <div class="flex flex-col sm:flex-row sm:justify-between items-center border-b pb-6">
                        <div class="flex items-center space-x-4">
                            @if($item->product)
                            <img src="{{ asset('storage/' . ($item->product->firstImage?->images ?? 'default-image.jpg')) }}"
                            alt="{{ $item->product->nom }}"
                            class="w-16 h-16 rounded-md object-cover">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $item->product->nom }}</h2>
                            <p class="text-sm text-gray-600">{{ number_format($item->product->prix, 2) }} MAD</p>
                        </div>
                            @else
                                <span class="text-gray-500">Produit non disponible</span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                            <!-- Formulaire pour mettre à jour la quantité -->
                            @if($item->product)
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 p-2 border rounded-md text-center">
                                    <button type="submit" class="ml-2 px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                        Mettre à jour
                                    </button>
                                </form>
                            @endif

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-bold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @elseif(!auth()->check() && session('cart'))
                <div class="space-y-8">
                    @foreach(session('cart') as $item)
                    <div class="flex flex-col sm:flex-row sm:justify-between items-center border-b pb-6">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . ($item['images'] ?? 'default-image.jpg')) }}"
                         alt="{{ $item['name'] }}"
                         class="w-16 h-16 rounded-md object-cover">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h2>
                                <p class="text-sm text-gray-600">{{ number_format($item['price'], 2) }} MAD</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                            <!-- Formulaire pour mettre à jour la quantité -->
                            <form action="{{ route('cart.updateSession', $item['id']) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 p-2 border rounded-md text-center">
                                <button type="submit" class="ml-2 px-3 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                    Mettre à jour
                                </button>
                            </form>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('cart.removeSession', $item['id']) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-bold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">Votre panier est vide. Vous pouvez commencer à ajouter des produits.</p>
            @endif

            <!-- Total et bouton Passer à la caisse -->
            <div class="mt-8 flex flex-col sm:flex-row sm:justify-between items-center">
                <div class="text-xl font-semibold text-gray-800">
                    <p>Total :
                        <span class="text-green-600">
                            {{ number_format(
                                (auth()->check()
                                    ? $cartItems->sum(function($item) {
                                        return $item->product ? $item->quantity * $item->product->prix : 0;
                                    })
                                    : (is_array(session('cart')) ? array_sum(array_map(function($item) {
                                        return $item['quantity'] * $item['price'];
                                    }, session('cart'))) : 0)
                                ), 2) }} MAD
                        </span>
                    </p>
                </div>

                <form action="{{ route('commande.store') }}" method="POST" class="mt-4 sm:mt-0">
                    @csrf
                    <!-- Champ pour la localisation -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Adresse de livraison :</label>
                        <input type="text" placeholder="Localisation" id="location" name="location" required
                               class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Champ pour le téléphone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone :</label>
                        <input type="tel" id="phone" name="tel" required pattern="[0-9]{10}"
                               class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Numéro de téléphone">
                    </div>

                    <!-- Bouton pour passer la commande -->
                    <button type="submit" class="inline-block px-6 py-3 bg-yellow-500 text-black font-semibold rounded-md shadow hover:bg-yellow-400 transition duration-200">
                        Passer à la commande
                    </button>
                </form>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        @include('layouts.footer')
    </footer>
</body>

<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
</html>

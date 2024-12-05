<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les Produits - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    @include('layouts.nav')

    <!-- Main Content -->
    <main class="container mx-auto my-8 px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Découvrez Nos Produits</h1>

        <!-- Filtre par catégorie -->
        <div class="flex justify-center mb-6">
            <form method="GET" action="{{ route('prod.index') }}" class="flex items-center space-x-4 w-full sm:w-auto">
                <select name="category_id" class="p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-auto">
                    <option value="">Toutes les catégories</option>
                    @foreach($categorie as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}>
                            {{ $category->type }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="py-2 px-4 border-2 border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition duration-300 mt-2 sm:mt-0 w-full sm:w-auto">
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Produits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($produits as $product)
            <div class="bg-gray-200 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <a href="{{ route('prod.details', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image de {{ $product->nom }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ $product->nom }}</h3>
                        <p class="text-sm text-gray-600 mt-2">{{ Str::limit($product->description, 80) }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-green-600 font-bold">{{ number_format($product->prix, 2) }} MAD</span>
                        </div>
                    </div>
                </a>
                <button id="add-to-cart-btn-{{ $product->id }}"
                    class="w-full mt-3 py-2 border-2 border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition duration-300"
                    onclick="addToCart({{ $product->id }})">
                Ajouter au panier
            </button>
            </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Scripts -->
    <script>
   function addToCart(productId) {
    fetch(`/cart/add/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);  // Afficher le message de succès
    })
    .catch(error => {
        alert('Erreur lors de l\'ajout au panier.');
    });
}

    </script>

</body>
</html>

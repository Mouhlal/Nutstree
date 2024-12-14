<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les Produits - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navigation -->
    @include('layouts.nav')

    <!-- Message d'ajout au panier -->
    @if (session('addP'))
    <script>
        Swal.fire({
            html: "<h3>{{ session('addP') }}</h3>",
            icon: "success",
        });
    </script>
    @endif

    @if(session('error'))
    <div class="p-4 mb-6 text-red-700 bg-red-100 rounded-md text-center">
        {{ session('error') }}
    </div>
@endif


    <!-- Main Content -->
    <main class="container mx-auto py-16 px-6 lg:px-12">
        <h1 class="text-4xl font-extrabold text-center text-gray-900 mb-12">
            Découvrez Nos Produits
        </h1>

        <!-- Filtre par catégorie -->
        <div class="flex justify-center mb-12">
            <form method="GET" action="{{ route('prod.index') }}" class="flex items-center space-x-6 bg-white p-4 rounded-lg shadow-lg">
                <select name="category_id"
                        class="p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 text-gray-700">
                    <option value="">Toutes les catégories</option>
                    @foreach($categorie as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}>
                            {{ $category->type }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                        class="py-3 px-6 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-300">
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Produits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-6">
            @foreach ($produits as $product)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 border">
                <!-- Lien vers les détails du produit -->
                <a href="{{ route('prod.details', $product->id) }}" class="block">
                    <!-- Image du produit -->
                    <img
                        src="{{ $product->firstImage ? asset('storage/' . $product->firstImage->images) : asset('storage/default.jpg') }}"
                        alt="Image du produit"
                        class="w-full h-48 object-cover rounded-t-lg">
                </a>

                <!-- Informations du produit -->
                <div class="p-4">
                    <!-- Titre -->
                    <h3 class="text-lg font-semibold text-gray-800 hover:text-green-600 transition-colors duration-200">
                        {{ $product->nom }}
                    </h3>

                    <!-- Description courte -->
                    <p class="text-sm text-gray-500 mt-2">
                        {{ Str::limit($product->description, 80, '...') }}
                    </p>

                    <!-- Prix et disponibilité -->
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-green-600 font-bold text-lg">
                            {{ number_format($product->prix, 2) }} MAD
                        </span>
                        @if ($product->quantite > 0)
                            <span class="text-sm text-gray-600">En stock</span>
                        @else
                            <span class="text-sm text-red-500">Rupture de stock</span>
                        @endif
                    </div>
                </div>

                <!-- Bouton Ajouter au panier -->
                @if ($product->quantite > 0)
                <button
                    id="add-to-cart-btn-{{ $product->id }}"
                    class="w-full py-3 bg-blue-600 text-white font-semibold rounded-b-lg hover:bg-blue-700 transition duration-300"
                    onclick="addToCart({{ $product->id }})">
                    Ajouter au panier
                </button>
                @else
                <p class="w-full py-3 text-center bg-red-500 text-white font-semibold rounded-b-lg">
                    Rupture de stock
                </p>
                @endif
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
                if (data.success) {
                    Swal.fire({
                        html: `<h3>${data.message}</h3>`,
                        icon: 'success',
                    });
                } else {
                    Swal.fire({
                        html: `<h3>${data.message || 'Une erreur est survenue.'}</h3>`,
                        icon: 'success',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    html: `<h3>Erreur lors de l'ajout au panier.</h3>`,
                    icon: 'error',
                });
            });
        }

        // Toggle navigation menu (if applicable)
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>

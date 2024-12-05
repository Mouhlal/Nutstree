<!DOCTYPE html>
<html lang="en">
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

    <!-- Main Content -->
    <main class="container mx-auto py-8 px-4 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-8">
            Découvrez Nos Produits
        </h1>

        <!-- Filtre par catégorie -->
        <div class="flex justify-center mb-8">
            <form method="GET" action="{{ route('prod.index') }}" class="flex items-center space-x-4">
                <select
                    name="category_id"
                    class="p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Toutes les catégories</option>
                    @foreach($categorie as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ $category->id == $category_id ? 'selected' : '' }}>
                            {{ $category->type }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="py-2 px-4 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600 transition duration-300">
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Produits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($produits as $product)
            <div
                class="bg-white rounded-lg shadow-md hover:shadow-lg transform transition-transform hover:scale-105">
                <a href="{{ route('prod.details', $product->id) }}">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="Image de {{ $product->nom }}"
                        class="w-full h-48 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-700">
                            {{ $product->nom }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-2">
                            {{ Str::limit($product->description, 80) }}
                        </p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-green-600 font-bold">
                                {{ number_format($product->prix, 2) }} MAD
                            </span>
                        </div>
                    </div>
                </a>
                <button
                    id="add-to-cart-btn-{{ $product->id }}"
                    class="w-full mt-3 py-2 bg-blue-500 text-white rounded-b-lg hover:bg-blue-600 transition duration-300"
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
                if (data.success) {
                    Swal.fire({
                        html: `<h3>${data.message}</h3>`,
                        icon: 'success',
                    });
                } else {
                    Swal.fire({
                        html: `<h3>${data.message || 'Une erreur est survenue.'}</h3>`,
                        icon: 'error',
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

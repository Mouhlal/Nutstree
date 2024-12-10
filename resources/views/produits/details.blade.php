<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $produit->nom }} - Nutstree</title>
        @vite('resources/css/app.css')
        <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('layouts.nav')

    <!-- Contenu principal -->
    <main class="container mx-auto py-12 px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 shadow-lg rounded-lg">
            <!-- Image du produit -->
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-auto max-w-md rounded-lg shadow-md">
            </div>

            <!-- Détails du produit -->
            <div class="flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $produit->nom }}</h1>
                    <p class="text-xl text-green-600 font-semibold mb-6">{{ number_format($produit->prix, 2) }} MAD</p>

                    <!-- Description -->
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Description :</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $produit->description }}</p>

                    <!-- Catégories -->
                    @if($produit->categories && $produit->categories->count() > 0)
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Catégories :</h3>
                        <ul class="list-disc list-inside text-gray-600">
                            @foreach($produit->categories as $categorie)
                                <li>{{ $categorie->nom }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex space-x-4">
                        <button
                        onclick="addToCart({{ $produit->id }})"
                        type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition duration-200">
                            Ajouter au panier
                        </button>
                    </form>
                    <a href="{{ route('prod.index') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-md font-semibold shadow hover:bg-gray-300 transition duration-200">
                        Retour
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-white p-8 shadow-lg rounded-lg mt-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Avis des clients</h2>

            <!-- Formulaire pour laisser un avis -->
            @auth
            <form action="{{ route('reviews.store', $produit->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700">Évaluation</label>
                    <select name="rating" id="rating" class="w-full p-2 border rounded">
                        <option value="1">1 - Très mauvais</option>
                        <option value="2">2 - Mauvais</option>
                        <option value="3">3 - Moyen</option>
                        <option value="4">4 - Bon</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-gray-700">Commentaire</label>
                    <textarea name="content" id="content" rows="4" class="w-full p-2 border rounded" required></textarea>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Soumettre</button>
            </form>
            <br>
            @endauth

            @guest
            Veuillez <a href="{{ route('auth.login') }}" class="text-blue-600"> vous connecter </a> pour laisser un avis.</p>
            <br>
            @endguest

            <!-- Liste des avis -->
            <div class="space-y-6">
                @forelse($produit->reviews as $review)
                    <div class="border-t pt-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-700">
                                <strong>{{ $review->user->name }}</strong> -
                                <span class="text-yellow-500">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                            </p>
                            <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-800 mt-2">{{ $review->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">Aucun avis pour ce produit pour l'instant. Soyez le premier à laisser un avis !</p>
                @endforelse
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        @include('layouts.footer')
    </footer>
</body>

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
</script>
<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>


</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier {{ $produit->nom }} - Nutstree</title>
        @vite('resources/css/app.css')
        <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
        <!-- Css Styles -->
        <link rel="stylesheet" href="/home/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/home/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="/home/css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="/home/css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="/home/css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="/home/css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="/home/css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="/home/css/style.css" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.default.min.css">

    </head>
<body>

    @include('temp.layouts.Humberger')

    @include('temp.layouts.header')

    <main class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-green-700 mb-6">Modifier le Produit</h1>

        <form action="{{ route('prod.update', $produit->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-8">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom du produit -->
                <div>
                    <label for="nom" class="block text-lg font-medium text-gray-700">Nom du Produit</label>
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        value="{{ $produit->nom }}"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        placeholder="Entrez le nom du produit"
                        required>
                </div>

                <!-- Prix du produit -->
                <div>
                    <label for="prix" class="block text-lg font-medium text-gray-700">Prix (dhs)</label>
                    <input
                        type="number"
                        step="0.01"
                        id="prix"
                        name="prix"
                        value="{{ $produit->prix }}"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        placeholder="Entrez le prix"
                        >
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="categorie_id" class="block text-lg font-medium text-gray-700">Catégorie</label>
                    <select
                        id="categorie_id"
                        name="categorie_id"
                        class="w-full mt-2  border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required>
                        @foreach($categ as $categorie)
                            <option
                                value="{{ $categorie->id }}"
                                {{ $categorie->id == $produit->categorie_id ? 'selected' : '' }}>
                                {{ $categorie->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="mesure" class="block text-lg font-medium text-gray-700">Mesure</label>
                    <select name="mesure" id="mesure" class="w-full  border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="kg" {{ old('mesure', $produit->mesure ?? 'kg') == 'kg' ? 'selected' : '' }}>Kg</option>
                        <option value="g" {{ old('mesure', $produit->mesure ?? 'kg') == 'g' ? 'selected' : '' }}>Gramme</option>
                        <option value="L" {{ old('mesure', $produit->mesure ?? 'kg') == 'L' ? 'selected' : '' }}>Litre</option>
                        <option value="packet" {{ old('mesure', $produit->mesure ?? 'kg') == 'packet' ? 'selected' : '' }}>Paquet</option>
                    </select>
                </div>

                <!-- Quantité -->
                <div>
                    <label for="quantite" class="block text-lg font-medium text-gray-700">Quantité</label>
                    <input
                        type="number"
                        id="quantite"
                        name="quantite"
                        value="{{ $produit->quantite }}"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        placeholder="Entrez la quantité"
                        >
                </div>

                <div>
                    <label for="quantite" class="block text-lg font-medium text-gray-700">Rabais (%)</label>
                    <input
                        type="number"
                        id="discount"
                        name="discount"
                        value="{{ $produit->discount }}"
                        step="0.01" min="0" max="100"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        placeholder="Entrez le rabais"
                        >
                </div>

                <!-- Image -->
                <div class="col-span-1 md:col-span-2">
                    <label for="image" class="block text-lg font-medium text-gray-700">Image</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>
            </div>

            <div class="mt-6">
                <label for="status" class="block text-lg font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full  border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="normal" {{ old('status', $produit->status) == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="new" {{ old('status', $produit->status) == 'new' ? 'selected' : '' }}>Nouveau</option>
                    <option value="hot" {{ old('status', $produit->status) == 'hot' ? 'selected' : '' }}>Chaud</option>
                    <option value="best" {{ old('status', $produit->status) == 'best' ? 'selected' : '' }}>Meilleur</option>
                </select>
            </div>
<br>
            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                    placeholder="Entrez une description">{{ $produit->description }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('dash.tables') }}" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg shadow hover:bg-gray-400 transition duration-300">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition duration-300">
                    Enregistrer
                </button>
            </div>
        </form>
    </main>

    @include('temp.layouts.footer')

</body>

<script src="/home/js/jquery-3.3.1.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script src="/home/js/jquery.nice-select.min.js"></script>
<script src="/home/js/jquery-ui.min.js"></script>
<script src="/home/js/jquery.slicknav.js"></script>
<script src="/home/js/mixitup.min.js"></script>
<script src="/home/js/owl.carousel.min.js"></script>
<script src="/home/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

</html>

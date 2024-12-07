<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier {{ $produit->nom }} - Nutstree</title>
        @vite('resources/css/app.css')
        <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    </head>
<body class="bg-gray-50 text-gray-800 font-sans">

    @include('layouts.nav')

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
                        required>
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="categorie_id" class="block text-lg font-medium text-gray-700">Catégorie</label>
                    <select
                        id="categorie_id"
                        name="categorie_id"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
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
                        required>
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

            <!-- Boutons d'action -->
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

    @include('layouts.footer')

</body>
</html>

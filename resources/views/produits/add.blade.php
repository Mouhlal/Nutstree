<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un Produit - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">
</head>
<body class="bg-gray-100">

    @include('layouts.nav')

    <main class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Ajouter un Nouveau Produit</h1>

        <form action="{{ route('prod.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nom du produit -->
                <div class="form-group">
                    <label for="nom" class="block text-gray-700 font-semibold">Nom du Produit</label>
                    <input type="text" id="nom" name="nom" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Prix du produit -->
                <div class="form-group">
                    <label for="prix" class="block text-gray-700 font-semibold">Prix (MAD)</label>
                    <input type="number" id="prix" name="prix" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <!-- Description du produit -->
                <div class="form-group">
                    <label for="description" class="block text-gray-700 font-semibold">Description du Produit</label>
                    <textarea id="description" name="description" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
                </div>

                <!-- Catégorie du produit -->
                <div class="form-group">
                    <label for="categorie_id" class="block text-gray-700 font-semibold">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" selected disabled>Sélectionner une catégorie</option>
                        @foreach($categorie as $category)
                            <option value="{{ $category->id }}">{{ $category->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <!-- Image du produit -->
                <div class="form-group">
                    <label for="image" class="block text-gray-700 font-semibold">Image du Produit</label>
                    <input type="file" id="image" name="image" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="w-full py-2 px-6 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">
                    Ajouter le Produit
                </button>
            </div>
        </form>
    </main>

    @include('layouts.footer')

</body>
</html>

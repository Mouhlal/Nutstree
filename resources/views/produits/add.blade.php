<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un Produit - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
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

    <main class="container m-6 border mx-auto p-6 bg-white shadow-md rounded-md mt-8 max-w-4xl">
        <h1 class="text-3xl font-semibold text-center text-green-700 mb-6">Ajouter un Nouveau Produit</h1>

        <form action="{{ route('prod.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nom du produit -->
                <div class="form-group">
                    <label for="nom" class="block text-gray-700 font-medium">Nom du Produit</label>
                    <input type="text" value="{{ old('nom') }}" name="nom" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Prix du produit -->
                <div class="form-group">
                    <label for="prix" class="block text-gray-700 font-medium">Prix (MAD)</label>
                    <input type="number" value="{{ old('prix') }}" name="prix" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('prix') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <!-- Description du produit -->
                <div class="form-group">
                    <label for="description" class="block text-gray-700 font-medium">Description du Produit</label>
                    <textarea name="description" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
                </div>

                <!-- Catégorie -->
                <div class="form-group">
                    <label for="categorie_id" class="block text-gray-700 font-medium">Catégorie</label>
                    <select name="categorie_id" class="w-full  border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" selected disabled>Sélectionner une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <!-- Images du produit -->
                <div class="form-group">
                    <label for="images" class="block text-gray-700 font-medium">Images du Produit</label>
                    <input type="file" name="image[]" accept="image/*" class="w-full p-3 border border-gray-300 rounded-md" multiple>
                    @error('image.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <div id="image-preview" class="mt-4 flex gap-4"></div>
                </div>

                <!-- Statut du produit -->
                <div class="form-group">
                    <label for="status" class="block text-gray-700 font-medium">Statut du Produit</label>
                    <select name="status" class="w-full  border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" selected disabled>Choisissez le statut</option>
                        <option value="normal">Normal</option>
                        <option value="new">Nouveau</option>
                        <option value="hot">Chaud</option>
                        <option value="best">Meilleur</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <!-- Unité de mesure -->
                <div class="form-group">
                    <label for="mesure" class="block text-gray-700 font-medium">Unité de Mesure</label>
                    <select name="mesure" class="w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="kg">Kg</option>
                        <option value="g">Gramme</option>
                        <option value="L">Litre</option>
                        <option value="packet">Paquet</option>
                    </select>
                </div>

                <!-- Quantité -->
                <div class="form-group">
                    <label for="quantite" class="block text-gray-700 font-medium">Quantité</label>
                    <input type="number" value="{{ old('quantite') }}" name="quantite" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('quantite') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group mt-6">
                <label for="discount" class="block text-gray-700 font-medium">Rabais (%)</label>
                <input type="number" name="discount" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" min="0" max="100" required>
                @error('discount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">
                    Ajouter le Produit
                </button>
            </div>
        </form>
    </main>

    @include('temp.layouts.footer')

    <script>
        const imageInput = document.querySelector('input[name="image[]"]');
        const previewContainer = document.getElementById('image-preview');

        imageInput.addEventListener('change', (event) => {
            previewContainer.innerHTML = ''; // Effacer les aperçus existants
            const files = event.target.files;

            Array.from(files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-24', 'h-24', 'object-cover', 'rounded-md');
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

    <script src="/home/js/jquery-3.3.1.min.js"></script>
    <script src="/home/js/bootstrap.min.js"></script>
    <script src="/home/js/jquery.nice-select.min.js"></script>
    <script src="/home/js/jquery-ui.min.js"></script>
    <script src="/home/js/jquery.slicknav.js"></script>
    <script src="/home/js/mixitup.min.js"></script>
    <script src="/home/js/owl.carousel.min.js"></script>
    <script src="/home/js/main.js"></script>
</body>
</html>

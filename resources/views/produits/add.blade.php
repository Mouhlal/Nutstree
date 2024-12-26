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
                    <input type="text" value="{{old('nom')}}" name="nom" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('nom')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                </div>

                <!-- Prix du produit -->
                <div class="form-group">
                    <label for="prix" class="block text-gray-700 font-semibold">Prix (MAD)</label>
                    <input type="number" value="{{old('prix')}}" name="prix" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('prix')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <!-- Description du produit -->
                <div class="form-group">
                    <label for="description" class="block text-gray-700 font-semibold">Description du Produit</label>
                    <textarea  name="description" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" ></textarea>
                </div>

                <!-- Catégorie du produit -->
                <div class="form-group">
                    <label for="categorie_id" class="block text-gray-700 font-semibold">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" selected disabled>Sélectionner une catégorie</option>
                        @foreach($categ as $category)
                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                <div class="mb-4">
                    <label for="images" class="block text-gray-700">Images du produit</label>
                    <input type="file" name="image[]" accept="image/*" class="border border-gray-300 rounded-lg w-full p-2" multiple>
                    @error('image.*')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="block text-gray-700 font-semibold">Statut du Produit</label>
                <select name="status" id="status" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" selected disabled>Choisissez le statut</option>
                    <option value="normal">Normal</option>
                    <option value="new">Nouveau</option>
                    <option value="hot">Chaud</option>
                    <option value="best">Meilleur</option>
                </select>
            </div>

<br>
            <div class="form-group">
                <label for="measurement" class="block text-gray-700 font-semibold">Unité de mesure</label>
                <select name="mesure" id="mesure" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="kg" {{ old('measurement', $produit->mesure ?? 'kg') == 'kg' ? 'selected' : '' }}>Kg</option>
                    <option value="g" {{ old('measurement', $produit->mesure ?? 'kg') == 'g' ? 'selected' : '' }}>Gramme</option>
                    <option value="L" {{ old('measurement', $produit->mesure ?? 'kg') == 'L' ? 'selected' : '' }}>Litre</option>
                    <option value="packet" {{ old('measurement', $produit->mesure ?? 'kg') == 'packet' ? 'selected' : '' }}>Paquet</option>
                </select>
            </div>

            <!-- Quantité -->
            <div class="form-group mt-6">
                <label for="quantite" class="block text-gray-700 font-semibold">Quantité</label>
                <input type="number" value="{{old('quantite')}}" name="quantite" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('quantite')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-group mt-6">
                <label class="block text-gray-700 font-semibold" for="discount">Rabais (%)</label>
                <input type="number" name="discount" class="w-full p-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" min="0" max="100" required>
                @error('discount')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>


            <div id="image-preview" class="mt-4 flex flex-wrap gap-2"></div>

<script>
    const imageInput = document.querySelector('input[name="image[]"]');
    const previewContainer = document.getElementById('image-preview');

    imageInput.addEventListener('change', (event) => {
        previewContainer.innerHTML = ''; // Effacez les aperçus existants
        const files = event.target.files;

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-20', 'h-20', 'rounded-md', 'shadow-md');
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>


            <div class="mt-6 text-center">
                <button type="submit" class="w-full py-2 px-6 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">
                    Ajouter le Produit
                </button>
            </div>
        </form>
    </main>

    @include('layouts.footer')

</body>
<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
</html>

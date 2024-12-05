<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    @include('layouts.nav')

    <!-- Contenu principal -->
    <main class="container mx-auto py-12 px-4 lg:px-8">
        <div class="bg-white p-8 shadow-lg rounded-lg mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestion des catégories</h1>

            <!-- Formulaire pour ajouter une nouvelle catégorie -->
            <form action="{{ route('cat.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="flex space-x-4">
                    <div class="w-1/2">
                        <label for="nom" class="block text-gray-700">Nom de la catégorie</label>
                        <input type="text" name="type" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md font-semibold shadow hover:bg-blue-700 transition duration-200">
                            Ajouter
                        </button>
                    </div>
                </div>
            </form>

            <!-- Liste des catégories -->
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Catégories existantes</h2>
            @if(session('catAdd'))
            <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-md text-center">
                {{ session('catAdd') }}
            </div>
        @endif
        @if(session('catDelete'))
            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-md text-center">
                {{ session('catDelete') }}
            </div>
        @endif
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left py-2 px-4">Nom</th>
                        <th class="text-left py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $categorie)
                        <tr>
                            <td class="py-2 px-4">{{ $categorie->type }}</td>
                            <td class="py-2 px-4 space-x-2">
                                <a href="{{ route('cat.edit', $categorie->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Modifier</a>
                                    <a href="{{ route('cat.delete', $categorie->id) }}">
                                        <button
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                                        >
                                            Supprimer
                                        </button>
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        @include('layouts.footer')
    </footer>

</body>
</html>

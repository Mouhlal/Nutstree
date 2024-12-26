<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - TABLES</title>
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">

    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{route('dash.home')}}"  class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <a href="{{route('prod.add')}}">
                    <i class="fas fa-plus mr-3"></i> Ajouter Produit
                </a>
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{route('dash.home')}}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{route('dash.commandes')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-shopping-cart mr-3"></i>
                Commandes
            </a>
            <a href="{{route('dash.clients')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-users mr-3"></i>
                Clients
            </a>
            <a href="{{route('dash.tables')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Produits
            </a>
            <a href="{{route('dash.cat')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Categories
            </a>
            <a href="{{route('delivery_fees.index')}}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-truck mr-3"></i>
                Frais Livrasion
            </a>
            <a href="{{route('dash.forms')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Forms
            </a>
            </a>
            <a href="{{route('dash.calendar')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-calendar mr-3"></i>
                Calendar
            </a>
        </nav>
        {{-- <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Upgrade to Pro!
        </a> --}}
    </aside>


    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <a class="inline-block no-underline hover:text-black">
                        <svg class="fill-current text-yellow-400 hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <circle fill="none" cx="12" cy="7" r="3" />
                            <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                        </svg>
                    </a>
                 </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="/" class="block px-4 py-2 account-link hover:text-white">Acceuil</a>
                    <a href="{{ auth()->check() ? route('auth.profile', auth()->user()->id) : route('auth.showLogin') }}" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="{{ auth()->check() ? route('auth.logout') : route('layouts.home') }} "class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{route('dash.home')}}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="{{route('dash.home')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{route('dash.commandes')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Commandes
                </a>
                <a href="{{route('dash.clients')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Clients
                </a>
                <a href="{{route('dash.tables')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Produits
                </a>
                <a href="{{route('dash.cat')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-truck mr-3"></i>
                    Categories
                </a>
                <a href="{{route('delivery_fees.index')}}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Frais Livrasion
                </a>
                <a href="{{route('dash.forms')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-align-left mr-3"></i>
                    Forms
                </a>
                <a href="{{route('dash.calendar')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-calendar mr-3"></i>
                    Calendar
                </a>
                <a href="/" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-home mr-2"></i>
                    Acceuil
                </a>
                <a href="{{ auth()->check() ? route('auth.profile', auth()->user()->id) : '/login' }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    Mon Compte
                </a>
                <a href="{{route('auth.logout')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Deconnexion
                </a>
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-gray-800 font-bold pb-6">Gestion des Categories</h1>

                <form action="{{ route('cat.store') }}" enctype="multipart/form-data" method="POST" class="mb-6 bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    @csrf
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter une catégorie</h2>
                    <div class="flex flex-wrap space-y-4 md:space-y-0 md:space-x-4">
                        <!-- Input Field -->
                        <div class="w-full md:w-2/3">
                            <label for="type" class="block text-gray-700 font-medium mb-2">Nom de la catégorie</label>
                            <input
                                type="text"
                                name="type"
                                id="type"
                                placeholder="Entrez le nom de la catégorie"
                                class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-green-300 focus:outline-none"
                                required>
                        </div>

                        <div class="w-full md:w-2/3">
                            <label for="type" class="block text-gray-700 font-medium mb-2">Image de catégorie</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                placeholder="Entrez l'image de la catégorie"
                                class="w-full p-3 border border-gray-300 rounded-md focus:ring focus:ring-green-300 focus:outline-none"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="w-full relative top-4  md:w-1/3 flex items-end">
                            <button
                                type="submit"
                                class="w-full px-4 py-3 bg-green-600 text-white font-semibold rounded-md shadow hover:bg-green-700 transition duration-200">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>

                <div class="w-full mt-6">
                    <p class="text-xl pb-3 flex items-center text-gray-700">
                        <i class="fas fa-list mr-3 text-green-600"></i> Liste des Categories
                    </p>
                    <div class="bg-white overflow-auto shadow-md rounded-lg">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            @if(session('catDelete'))
                            <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-md text-center">
                                {{ session('catDelete') }}
                            </div>
                        @endif

                        @if(session('catUpdate'))
                            <div class="p-4 mb-6 text-yellow-600 bg-yellow-100 rounded-md text-center">
                                {{ session('catUpdate') }}
                            </div>
                        @endif

                        @if(session('catAdd'))
                        <div class="p-4 mb-6 text-green-600 bg-green-100 rounded-md text-center">
                            {{ session('catAdd') }}
                        </div>
                    @endif

                            <thead class="bg-green-700 text-white">
                                <tr>
                                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm border-b border-gray-200">
                                        Catégories
                                    </th>
                                    <th class="text-left py-4 px-4 uppercase font-semibold text-sm border-b border-gray-200">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @foreach($categories as $categorie)
                                <tr class="hover:bg-green-50">
                                    <td class="text-left py-4 px-4 border-b border-gray-200">
                                                    <span class="bg-green-200 text-green-700 text-sm px-2 py-1 rounded">
                                                        {{$categorie->type}}
                                                    </span>
                                    </td>
                                    <td class="text-left py-4 px-4 border-b border-gray-200 flex gap-2">
                                        <a href="{{route('cat.edit', $categorie->id) }}" class="px-3 py-2 bg-yellow-500 text-white text-sm font-medium rounded hover:bg-yellow-600">
                                            Modifier
                                        </a>
                                        <a href="{{ route('cat.delete', $categorie->id) }}"  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                            <button type="submit" class="px-3 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
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
        </div>


    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>

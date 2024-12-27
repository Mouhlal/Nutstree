<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - CODE PROMO</title>
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
            <a href="{{route('codepromo.index')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tag mr-3"></i>
                Code Promo
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
                    <i class="fas fa-table mr-3"></i>
                    Categories
                </a>
                <a href="{{route('delivery_fees.index')}}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                    <i class="fas fa-truck mr-3"></i>
                    Frais Livrasion
                </a>
                <a href="{{route('codepromo.index')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-tag mr-3"></i>
                    Code Promo
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
        </header>
        <div class="w-full h-screen overflow-x-hidden flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black font-semibold pb-6">Code Promo</h1>

                <!-- Formulaire d'ajout de code promo -->
                <div class="w-full mb-8">
                    <form action="{{ route('codepromo.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="code" class="block text-gray-700 font-semibold mb-2">Code</label>
                                <input type="text" id="code" name="code" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="discount" class="block text-gray-700 font-semibold mb-2">Réduction (%)</label>
                                <input type="number" id="discount" name="discount" min="1" max="100" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="valid_from" class="block text-gray-700 font-semibold mb-2">Date Début</label>
                                <input type="date" id="valid_from" name="valid_from" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="valid_until" class="block text-gray-700 font-semibold mb-2">Date Fin</label>
                                <input type="date" id="valid_until" name="valid_until" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div class="mb-4">
                                <label for="usage_limit" class="block text-gray-700 font-semibold mb-2">Limite d'Utilisation</label>
                                <input type="number" id="usage_limit" name="usage_limit" min="1" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <div class="flex justify-between mt-6">
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Ajouter Code Promo</button>
                            <!-- Bouton d'annulation -->
                            <a href="{{ route('codepromo.index') }}" class="px-6 py-3 bg-gray-400 text-white rounded-md shadow-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400">Annuler</a>
                        </div>
                    </form>
                </div>

                <!-- Table des codes promo -->
                <div class="w-full mt-6">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg bg-white">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-100 text-gray-900">
                                    <tr class="text-sm font-semibold uppercase tracking-wide border-b border-gray-300">
                                        <th class="px-6 py-3 text-left">Code</th>
                                        <th class="px-6 py-3 text-left">Réduction</th>
                                        <th class="px-6 py-3 text-left">Date Début</th>
                                        <th class="px-6 py-3 text-left">Date Fin</th>
                                        <th class="px-6 py-3 text-left">Limite d'Utilisation</th>
                                        <th class="px-6 py-3 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($codes as $code)
                                    <tr class="text-gray-700 border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 border-t">{{ $code->code }}</td>
                                        <td class="px-6 py-4 border-t">{{ $code->discount }}%</td>
                                        <td class="px-6 py-4 border-t">{{ $code->valid_from }}</td>
                                        <td class="px-6 py-4 border-t">{{ $code->valid_until }}</td>
                                        <td class="px-6 py-4 border-t">{{ $code->usage_limit }}</td>
                                        <td class="px-6 py-4 border-t flex space-x-4">
                                            <a href="{{ route('codepromo.edit', $code->id) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Modifier</a>
                                            <form action="{{ route('codepromo.destroy', $code->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>


    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>

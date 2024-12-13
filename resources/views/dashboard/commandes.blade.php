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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="{{route('dash.tables')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Produits
            </a>
            <a href="{{route('dash.cat')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Categories
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
                    <a href="{{ auth()->check() ? route('auth.profile', auth()->user()->id) : route('auth.showLogin') }}" class="block px-4 py-2 account-link hover:text-white">Mon Compte</a>
                    <a href="{{ auth()->check() ? route('auth.logout') : route('layouts.home') }} "class="block px-4 py-2 account-link hover:text-white">Deconnexion</a>
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
                <a href="{{route('dash.tables')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Produits
                </a>
                <a href="{{route('dash.cat')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Categories
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
                <div class="container mx-auto py-8">
                    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Gestion des Commandes</h1>

                    @if(session('deletedC'))
                        <div class="p-4 mb-6 text-red-600 bg-red-100 rounded-md text-center">
                            {{ session('deletedC') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="p-4 mb-6 text-green-600 bg-green-100 rounded-md text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulaire de recherche et filtre -->
                    <div class="mb-6">
                        <form action="{{ route('dash.commandes') }}" method="GET" class="flex items-center justify-between bg-white shadow-md rounded-lg p-6">
                            <!-- Recherche par nom ou numéro de commande -->
                            <div class="flex items-center w-full md:w-2/3">
                                <input type="text" name="search" placeholder="Rechercher par nom ou numéro de commande"
                                       class="w-full p-2 border rounded-lg text-gray-700"
                                       value="{{ request('search') }}">
                            </div>

                            <!-- Filtre par statut -->
                            <div class="ml-4">
                                <select name="status" class="p-2 border rounded-lg text-gray-700">
                                    <option value="">-- Filtrer par statut --</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En cours</option>
                                    <option value="pending-cash" {{ request('status') === 'pending-cash' ? 'selected' : '' }}>En attente de paiement</option>
                                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Livrée</option>
                                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                </select>
                            </div>

                            <!-- Bouton de recherche -->
                            <button type="submit" class="ml-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                                Rechercher
                            </button>
                        </form>
                    </div>

                    <!-- Table des commandes -->
                    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                        <div>
                            <h2 class="text-lg p-5 font-bold text-gray-800 mb-4">Liste des Commandes</h2>
                            <table class="min-w-full bg-white table-auto overflow-x-auto">
                                <thead>
                                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">N°Commande</th>
                                        <th class="py-3 px-6 text-left">Client</th>
                                        <th class="py-3 px-6 text-center">Total</th>
                                        <th class="py-3 px-6 text-center">Statut</th>
                                        <th class="py-3 px-6 text-center">Tel Client</th>
                                        <th class="py-3 px-6 text-center">Localisation</th>
                                        <th class="py-3 px-6 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach($commandes as $commande)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $commande->numCom }}</td>
                                            <td class="py-3 px-6 text-left">{{ $commande->user->name }}</td>
                                            <td class="py-3 px-6 text-center">{{ number_format($commande->totalPrix, 2) }} MAD</td>
                                            <td class="py-3 px-6 text-center">
                                                <span class="px-3 py-1 rounded-full text-white
                                                    {{ $commande->status === 'pending' ? 'bg-yellow-500' :
                                                    ($commande->status === 'completed' ? 'bg-green-500' :
                                                    ($commande->status === 'failed' ? 'bg-red-500' :
                                                    ($commande->status === 'pending-cash' ? 'bg-blue-500 text-nowrap truncate' : 'bg-gray-500'))) }}">
                                                    {{ ucfirst(str_replace('-', ' ', $commande->status)) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-6 text-center">{{ $commande->user->tel }}</td>
                                            <td class="py-3 px-6 text-center">{{ $commande->user->adresse }}</td>
                                            <td class="py-3 px-6 text-center">
                                                <form action="{{ route('dash.commandes.update', $commande->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="bg-gray-50 border text-gray-600 py-1 px-2 rounded">
                                                        <option value="pending" {{ $commande->status === 'pending' ? 'selected' : '' }}>En cours</option>
                                                        <option value="pending-cash" {{ $commande->status === 'pending-cash' ? 'selected' : '' }}>En attente de paiement</option>
                                                        <option value="completed" {{ $commande->status === 'completed' ? 'selected' : '' }}>Livrée</option>
                                                        <option value="cancelled" {{ $commande->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                                    </select>
                                                    <button type="submit" class="ml-2 bg-blue-500 relative top-1 text-white py-1 px-2 rounded">Mettre à jour</button>
                                                </form>
                                                <form action="{{ route('dash.commandes.destroy', $commande->id) }}" class="inline-block p-2" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-2 bg-red-500 text-white py-1 px-2 rounded">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $commandes->links() }}
                    </div>
                </div>
            </main>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
    function confirmDelete(commandeId) {
        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Vous ne pouvez pas annuler cette action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirms
                document.getElementById('delete-form-' + commandeId).submit();
            }
        });
    }
    </script>

</body>
</html>

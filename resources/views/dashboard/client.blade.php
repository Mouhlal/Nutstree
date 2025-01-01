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
                commandes
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
                <i class="fas fa-tachometer-alt mr-3"></i>
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
                    Commande
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
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="container mx-auto py-8">
                    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Gestion des Clients</h1>

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

                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <div class="mb-6">
                        <form action="{{ route('dash.clients') }}" method="GET" class="flex flex-wrap items-center bg-white shadow-md rounded-lg p-6 space-y-4 md:space-y-0">
                            <!-- Input de recherche -->
                            <div class="w-full md:w-2/3">
                                <input type="text" name="search" placeholder="Rechercher par le nom ou numéro de téléphone"
                                       class="w-full p-2 border rounded-lg text-gray-700"
                                       value="{{ request('search') }}">
                            </div>

                            <!-- Select pour le filtre -->
                            <div class="w-full md:w-auto md:ml-4">
                                <select name="status" class="w-full md:w-auto p-2 border rounded-lg text-gray-700">
                                    <option value="">-- Filtrer par statut --</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Bon client</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Mauvais Client</option>
                                </select>
                            </div>

                            <!-- Bouton de recherche -->
                            <div class="w-full md:w-auto md:ml-4">
                                <button type="submit" class="w-full md:w-auto bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>


                    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                        <div>
                            <h2 class="text-lg p-5 font-bold text-gray-800 mb-4">Liste des Clients</h2>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            N°Client
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nom Complet
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ville
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tel
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Modifier Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Modifier Role
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                           Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $client)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $client->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $client->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $client->ville }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $client->tel }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 rounded-full text-white
                                                    {{ $client->status === 0 ? 'bg-green-500' :
                                                    ($client->status === 1 ? 'bg-red-500' : 'bg-gray-500') }}">
                                                    {{ $client->status === 0 ? 'Bon client' : 'Mauvaix Client' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('dash.client.update', $client->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="ml-2 bg-gray-50 border text-gray-600 py-1 px-2 rounded">
                                                        <option value="0" {{ $client->status === 0 ? 'selected' : '' }}>Bon client</option>
                                                        <option value="1" {{ $client->status === 1 ? 'selected' : '' }}>Mauvais client</option>
                                                    </select>
                                                    <button type="submit" class="ml-2 bg-blue-500 relative top-1 text-white py-1 px-2 rounded">Mettre à jour</button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 rounded-full text-white
                                                    {{ $client->role == 'user' ? 'bg-green-500' :
                                                    ($client->role == 'admin' ? 'bg-red-500' :
                                                    ($client->role == 'superadmin' ? 'bg-blue-500' : 'bg-gray-500')) }}">
                                                    {{ $client->role == 'user' ? 'Client' :
                                                    ($client->role == 'admin' ? 'Admin' :
                                                    ($client->role == 'superadmin' ? 'Super Admin' : 'Inconnu')) }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('dash.client.role', $client->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="role" class="ml-2 bg-gray-50 border text-gray-600 py-1 px-2 rounded">
                                                        <option value="user" {{ $client->role == 'user' ? 'selected' : '' }}>client</option>
                                                        <option value="admin" {{ $client->role == 'admin' ? 'selected' : '' }}>admin</option>
                                                    </select>
                                                    <button type="submit" class="ml-2 bg-blue-500 relative top-1 text-white py-1 px-2 rounded">Mettre à jour</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('dash.client.destroy', $client->id) }}" class="inline-block p-2" method="POST">
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

                    <div class="mt-6">
                        {{ $users->links() }}
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
    function confirmDelete(clientId) {
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
                document.getElementById('delete-form-' + clientId).submit();
            }
        });
    }
    </script>

</body>
</html>

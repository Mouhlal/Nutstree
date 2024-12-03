<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUTSTREE|PROFILE</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    @include('layouts.nav')

    <div class="container mx-auto py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">{{$user->name}}</h2>
                <!-- Bouton pour modifier le profil -->
                <a href="{{ route('auth.editp', $user->id) }}"
                    class="bg-yellow-500 text-black px-4 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none">
                    Modifier le profil
                </a>
            </div>

            <!-- Informations personnelles -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold">Informations personnelles</h3>
                <p><strong>Nom :</strong> {{ $user->name }}</p>
                <p><strong>Email :</strong> {{ $user->email }}</p>
                <p><strong>Téléphone :</strong> {{ $user->tel ?? 'Non renseigné' }}</p>
                <p><strong>Date d'inscription :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            </div>

            <!-- Liste des commandes -->
            <div>
                <h3 class="text-lg font-semibold">Commandes</h3>
                @if ($user->Commandes->isEmpty())
                    <p class="text-gray-500">Aucune commande trouvée.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left border-collapse">
                            <thead>
                                <tr>
                                    <th class="border-b px-4 py-2">N° Commande</th>
                                    <th class="border-b px-4 py-2">Date</th>
                                    <th class="border-b px-4 py-2">Montant</th>
                                    <th class="border-b px-4 py-2">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->Commandes as $order)
                                    <tr>
                                        <td class="border-b px-4 py-2">{{ $order->id }}</td>
                                        <td class="border-b px-4 py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td class="border-b px-4 py-2">{{ $order->totalPrix }} MAD</td>
                                        <td class="border-b px-4 py-2">{{ $order->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>

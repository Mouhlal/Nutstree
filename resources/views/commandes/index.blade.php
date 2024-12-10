<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes Commandes - Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('layouts.nav')

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Mes Commandes</h1>

        @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 rounded-md text-center">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="p-4 mb-6 text-red-800 bg-red-100 rounded-md text-center">
            {{ session('error') }}
        </div>
        @endif

        @if($commandes && $commandes->isNotEmpty())
            @foreach($commandes as $commande)
            <div class="card {{ 'status-' . $commande->status }}">
                <h2 class="text-2xl font-bold mb-2">Commande #{{ $commande->numCom }}</h2>
                <p class="text-sm text-gray-600">Date : {{ $commande->dateCom->format('d/m/Y') }}</p>
                <p class="text-sm text-gray-600 mb-4">Statut :
                    <span class="{{ $commande->status === 'pending' ? 'text-orange-600' : ($commande->status === 'completed' ? 'text-green-600' : 'text-red-600') }}">
                        {{ ucfirst($commande->status) }}
                    </span>
                </p>
                <p class="text-lg font-semibold mb-4">Total : {{ number_format($commande->totalPrix, 2) }} MAD</p>

                <h3 class="font-semibold mb-2">Produits :</h3>
                <ul class="list-disc pl-6 mb-4">
                    @foreach($commande->products as $product)
                        <li>{{ $product->nom }} x {{ $product->pivot->quantity }} ({{ number_format($product->pivot->prix, 2) }} MAD)</li>
                    @endforeach
                </ul>

                <!-- Annuler la commande -->
                @if($commande->status !== 'cancelled')
                <form id="cancel-form-{{ $commande->id }}" action="{{ route('commandes.cancel', $commande->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="button" class="btn btn-warning" onclick="confirmCancel({{ $commande->id }})">
                        Annuler la commande
                    </button>
                </form>
                @else
                <p class="text-red-500 mt-4">Commande annulée</p>
                @endif

                <!-- Supprimer la commande -->
                <form action="{{ route('orders.delete', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Supprimer la commande
                    </button>
                </form>
            </div>
            @endforeach
        @else
            <p class="text-center text-gray-600">Vous n'avez pas de commandes pour le moment.</p>
        @endif
    </div>

    @include('layouts.footer')

    <script>
        function confirmCancel(commandeId) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, annulez !',
                cancelButtonText: 'Non'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`cancel-form-${commandeId}`).submit();
                }
            });
        }
    </script>
</body>
</html>

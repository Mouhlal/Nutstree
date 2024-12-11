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
        /* Custom styles for your orders page */
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
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Modal Styles */
        #payment-method-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .modal-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .modal-body {
            font-size: 1rem;
            margin-bottom: 20px;
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

                <!-- Modal for Payment Method -->
                @if($commande->status !== 'completed')
                <div class="mt-4 flex flex-col md:flex-row gap-4 md:space-x-4">
                    <!-- Button for Cash on Delivery -->
                    <form action="{{ route('pay.cash', $commande->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            Paiement Cash (à livraison)
                        </button>
                    </form>

                    <!-- Button for Carte Bancaire -->
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            Payer par Carte Bancaire
                        </button>
                    </form>
                </div>
                @endif
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
        document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commande N°{{ $commande->numCom }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .section { margin-bottom: 40px; }
        .divider { border-top: 2px dashed black; margin: 40px 0; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <!-- Partie 1: Admin -->
    <div class="section">
        <h1 class="header">Commande N°{{ $commande->numCom }}</h1>

        <h3>Informations Commande</h3>
        <table>
            <tr>
                <th>Numéro Commande</th>
                <td>{{ $commande->numCom }}</td>
            </tr>
            <tr>
                <th>Date de Commande</th>
                <td>{{ $commande->created_at }}</td>
            </tr>
            <tr>
                <th>Client</th>
                <td>{{ $commande->User->name }}</td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td>{{ $commande->tel }}</td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>{{ ucfirst($commande->status) }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ number_format($commande->totalPrix, 2) }} MAD</td>
            </tr>
        </table>

        <h3>Produits Commandés</h3>
        <table>
            <thead>
                <tr>
                    <th>Nom du Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->products as $product)
                <tr>
                    <td>{{ $product->nom }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->prix, 2) }} MAD</td>
                    <td>{{ number_format($product->pivot->quantity * $product->pivot->prix, 2) }} MAD</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="divider"></div>

    <!-- Partie 2: Livreur -->
    <div class="section">
        <h1 class="header">Commande N°{{ $commande->numCom }}</h1>

        <h3>Informations Commande</h3>
        <p><strong>Numéro Commande :</strong> {{ $commande->numCom }}</p>
        <p><strong>Client :</strong> {{ $commande->User->name }}</p>
        <p><strong>Telephone :</strong> {{ $commande->tel }}</p>
        <p><strong>Adresse de Livraison :</strong> {{ $commande->location }}</p>

        <h3>Produits Commandés</h3>
        <table>
            <thead>
                <tr>
                    <th>Nom du Produit</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->products as $product)
                <tr>
                    <td>{{ $product->nom }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->quantity * $product->pivot->prix, 2) }} MAD</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

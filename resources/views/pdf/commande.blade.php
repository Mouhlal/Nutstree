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
    </style>
</head>
<body>
    <h1>Commande N°{{ $commande->numCom }}</h1>

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

    <h3>Informations de Facturation</h3>
    <p><strong>Nom :</strong> {{ $billingInfo['name'] }}</p>
    <p><strong>Adresse :</strong> {{ $commande->location }}</p>
    <p><strong>Méthode de Paiement :</strong> {{ $billingInfo['payment_method'] }}</p>
    <p><strong>Statut de Paiement :</strong> {{ $commande->status }}</p>
</body>
</html>


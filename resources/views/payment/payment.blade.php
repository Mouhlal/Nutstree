<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paiement - Nutstree</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    @include('layouts.nav')

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Passer à la Caisse</h1>

        <h2 class="text-2xl font-bold mb-4">Détails de la Commande #{{ $commande->numCom }}</h2>
        <p class="text-lg mb-4">Total : {{ number_format($commande->totalPrix, 2) }} MAD</p>

        <h3 class="font-semibold mb-2">Produits :</h3>
        <ul class="list-disc pl-6 mb-4">
            @foreach($commande->products as $product)
                <li>{{ $product->nom }} x {{ $product->pivot->quantity }} ({{ number_format($product->pivot->prix, 2) }} MAD)</li>
            @endforeach
        </ul>

        <!-- Stripe Payment Form -->
        <form id="payment-form" action="{{ route('pay.process', $commande->id) }}" method="POST">
            @csrf
            <div>
                <label for="card-element">Carte bancaire</label>
                <div id="card-element"></div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button type="submit">Payer {{ number_format($commande->totalPrix, 2) }} MAD</button>
        </form>
    </div>

    @include('layouts.footer')

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_51QU53HJPraHe4QRfENEXhwkKfHQIXoC2O4ZOcwvzRYh8iHSZqznh25FsIOXSMUQbJSYwpBELZAm1kBksWQZFjfqN00CnZNtrh4');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createPaymentMethod({
                type: 'card',
                card: card,
            }).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>

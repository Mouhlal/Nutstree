<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pay</title>
</head>
<body>


    <!-- Inclure les scripts Stripe -->
<script src="https://js.stripe.com/v3/"></script>

@include('layouts.nav')

<form id="payment-form">
    <div>
        <label for="card-element">Carte bancaire</label>
        <div id="card-element">
            <!-- Un champ Stripe pour la carte -->
        </div>
        <div id="card-errors" role="alert"></div>
    </div>

    <button type="submit">Payer</button>
</form>

<script>
    var stripe = Stripe('pk_test_51QU53HJPraHe4QRfENEXhwkKfHQIXoC2O4ZOcwvzRYh8iHSZqznh25FsIOXSMUQbJSYwpBELZAm1kBksWQZFjfqN00CnZNtrh4');
    // Remplacez par votre clé publique Stripe
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    // Gérer l'envoi du formulaire
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod({
            type: 'card',
            card: card,
        }).then(function(result) {
            if (result.error) {
                // Affichez l'erreur dans le formulaire
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Envoyer l'ID de paiement au backend pour traitement
                fetch('/pay', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        payment_method_id: result.paymentMethod.id,
                        amount: {{ $orderTotal }}, // Remplacez par le montant réel de la commande
                    }),
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(paymentResult) {
                    // Gérer la réponse du backend (par exemple, affichage d'un message de succès)
                    if (paymentResult.success) {
                        alert('Paiement réussi!');
                    } else {
                        alert('Échec du paiement');
                    }
                });
            }
        });
    });
</script>


@include('layouts.footer')
</body>
</html>

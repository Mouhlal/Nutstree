<!DOCTYPE html>
<html>
<head>
    <title>Code Promo</title>
</head>
<body>
    <h1>Félicitations !</h1>
    <p>Voici votre code promo pour une réduction sur votre prochain achat : <strong>{{ $promoCode }}</strong></p>
    <p>Valable jusqu'au {{ $promoCode->expires_at->format('d/m/Y') }}</p>
    <p>Utilisez ce code au moment du paiement pour bénéficier de la réduction.</p>
</body>
</html>



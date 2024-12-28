<!-- resources/views/emails/promoCode.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code promo</title>
</head>
<body>
    <h1>Félicitations ! Voici votre code promo :</h1>
    <p>Code promo  est: <strong>{{ $promoCode->code }}</strong></p>
    <p>Utilisez-le avant le {{ \Carbon\Carbon::parse($promoCode->valid_until)->format('d/m/Y') }} pour bénéficier d'une réduction.</p>
</body>
</html>

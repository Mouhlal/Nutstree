<!DOCTYPE html>
<html>
<head>
    <title>Votre Code Promo</title>
</head>
<body>
    <h1>Félicitations !</h1>
    <p>Voici votre code promotionnel :</p>
    <h2>{{ $promoCode->code }}</h2>
    <p>Utilisez ce code pour bénéficier d'une réduction de {{ $promoCode->discount }}% sur votre prochain achat.</p>
    <p>Valable jusqu'au : {{ $promoCode->expiry_date }}</p>
    <p>Merci de nous faire confiance !</p>
</body>
</html>

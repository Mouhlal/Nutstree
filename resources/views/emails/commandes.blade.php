<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation Commandes</title>
</head>
<body>
<div>
    <p>Vous avez bien passé une commande !</p>
    <p>Voici les détails de votre commande :</p>
    <ul>
        <li>Commande : #{{$numCom}}</li>
        <li>Date : {{ $dateCom }}</li>
        <li>Total Prix : {{ $total }} MAD</li>
        </ul>
        <p>Vous allez être redirigé vers la page d'accueil dans quelques
            secondes.</p>
     </div>
</div>
</body>
</html>

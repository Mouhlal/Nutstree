<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paiement Réussi - Nutstree</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    @include('layouts.nav')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 text-center">
            <div class="mb-6">
                <svg class="w-24 h-24 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M9 12l2-2m-2 2h6" />
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"></circle>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Paiement Réussi !</h1>
            <p class="text-gray-600 text-lg mb-6">
                Merci pour votre achat. Votre commande a été confirmée et sera traitée rapidement.
            </p>
            <div class="mt-8">
                <a href="{{ route('commandes.index') }}" class="bg-green-500 text-white py-2 px-6 rounded-lg hover:bg-green-600 transition-all">
                    Voir mes commandes
                </a>
                <a href="{{ route('layouts.home') }}" class="bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 transition-all ml-4">
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>

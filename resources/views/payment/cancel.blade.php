<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paiement Annulé - Nutstree</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    @include('layouts.nav')

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 text-center">
            <div class="mb-6">
                <svg class="w-24 h-24 text-red-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m6.938-3A7.938 7.938 0 0012 4.062m0 0A7.938 7.938 0 005.062 12m6.938 7.938A7.938 7.938 0 0012 19.938m0 0A7.938 7.938 0 0018.938 12m-6.938 7.938A7.938 7.938 0 015.062 12" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Paiement Annulé</h1>
            <p class="text-gray-600 text-lg mb-6">
                Votre commande n'a pas été traitée. Si vous avez des questions, veuillez contacter notre service client.
            </p>
            <div class="mt-8">
                <a href="{{ route('commandes.index') }}" class="bg-red-500 text-white py-2 px-6 rounded-lg hover:bg-red-600 transition-all">
                    Retourner à mes commandes
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

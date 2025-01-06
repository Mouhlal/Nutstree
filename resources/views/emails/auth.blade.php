<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <div class="max-w-md mx-auto mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-center">Vérification de votre email</h2>
            <p class="text-gray-600 text-center mt-4">Nous avons envoyé un lien de réinitialisation à votre adresse e-mail. Veuillez vérifier votre boîte de réception et suivez les instructions.</p>
            <p class="text-sm text-center mt-2">Si vous n'avez pas reçu d'email, vous pouvez <a href="{{ route('password.email') }}" class="text-blue-600">réessayer</a>.</p>
        </div>
    </div>
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

</body>
</html>

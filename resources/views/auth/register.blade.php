<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription - Nutstree</title>
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 dark:from-gray-300 dark:to-gray-700">

    @include('layouts.nav')

    <br> <br> <br>

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-6">
                <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Créer un compte</h2>
                <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                    Remplissez le formulaire ci-dessous pour vous inscrire.
                </p>

                <!-- Formulaire d'inscription -->
                <form action="{{route('auth.register')}}" method="POST" class="space-y-4">
                    @csrf
                    @foreach($errors->all() as $error)
                    <div class="text-white text-center">
                      <h2>{{ $error }}</h2>
                    </div>
                  @endforeach
                    <!-- Nom complet -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nom complet</label>
                        <input type="text" value="{{old('name')}}" name="name" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Votre nom">
                    </div>

                    <!-- Adresse e-mail -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Adresse e-mail</label>
                        <input type="email" value="{{old('email')}}" name="email" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="exemple@nutstree.com">
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                        <input type="password" value="{{old('password')}}" name="password" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="••••••••">
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Confirmez le mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="••••••••">
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-yellow-300 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-green-500 dark:focus:ring-green-800">
                        S'inscrire
                    </button>
                </form>

                <!-- Connexion avec Google -->
                {{-- <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500 dark:bg-gray-800 dark:text-gray-400">Ou</span>
                    </div>
                </div>
                <a href=""
                    class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#EA4335" d="M12 11.8v2.8h5.1c-.2 1.4-.8 2.6-1.8 3.4l2.8 2.2c1.7-1.6 2.7-4 2.7-6.6 0-.7-.1-1.4-.3-2H12z"/>
                        <path fill="#34A853" d="M17.3 18.2l-2.8-2.2c-.8.5-1.9.8-3.1.8-2.3 0-4.3-1.5-5-3.5H3.3v2.2c1.5 2.9 4.5 4.8 8 4.8 2.2 0 4.1-.7 5.7-2z"/>
                        <path fill="#4A90E2" d="M6.5 12c0-.4 0-.9.2-1.3V8.5H3.3c-.7 1.3-1 2.7-1 4.5s.3 3.2 1 4.5l3.4-2.8z"/>
                        <path fill="#FBBC05" d="M12 5.6c1.2 0 2.3.4 3.1 1.1l2.3-2.3C15.8 2.9 14 2.2 12 2.2c-3.5 0-6.5 1.9-8 4.8l3.4 2.8c.7-2 2.7-3.5 5-3.5z"/>
                    </svg>
                    Continuer avec Google
                </a>
 --}}
                <!-- Lien vers login -->
                <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                    Vous avez déjà un compte ?
                    <a href="{{ route('auth.showLogin') }}" class="font-medium text-yellow-600 hover:underline dark:text-yellow-400">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div> <br> <br><br>

    @include('layouts.footer')

</body>
</html>

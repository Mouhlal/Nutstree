<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion - Nutstree</title>
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100 dark:from-gray-300 dark:to-gray-700">
    <!-- Navbar -->
    @include('layouts.nav')

    <br> <br> <br>

    <!-- Login Form Section -->
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <div class="p-8 space-y-6">
                <!-- Logo -->
                <div class="flex justify-center">
                    <img src="{{ asset('storage/layouts/logo.jpeg') }}" alt="Nutstree Logo" class="w-16 h-16 rounded-full shadow-md">
                </div>

                <!-- Welcome Text -->
                <h2 class="text-3xl font-bold text-center text-green-600 dark:text-white">Bienvenue sur Nutstree</h2>
                <p class="text-sm text-center text-gray-500 dark:text-gray-400">Connectez-vous à votre compte pour continuer.</p>

                <!-- Login Form -->
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    @foreach($errors->all() as $error)
                    <div class="text-yellow-400 border border-solid p-4 text-center">
                      <h2>{{ $error }}</h2>
                    </div>
                  @endforeach
                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Adresse e-mail</label>
                        <input type="email" value="{{old('email')}}" name="email" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-green-500 focus:border-green-500"
                            placeholder="exemple@nutstree.com">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                        <input type="password" value="{{old('password')}}" name="password" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-green-500 focus:border-green-500"
                            placeholder="••••••••">
                    </div>

                    <!-- Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-sm text-green-600 hover:underline dark:text-yellow-300">Mot de passe oublié ?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-yellow-300 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-green-500 dark:focus:ring-green-800">
                        Connexion
                    </button>
                </form>

                <!-- Divider -->
                <div class="text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pas encore de compte ?
                        <a href="#" class="font-medium text-yellow-300 hover:underline dark:text-yellow-300">Inscrivez-vous</a>
                    </p>
                </div>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500 dark:bg-gray-800 dark:text-gray-400">Ou</span>
                    </div>
                </div>
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#EA4335" d="M12 11.8v2.8h5.1c-.2 1.4-.8 2.6-1.8 3.4l2.8 2.2c1.7-1.6 2.7-4 2.7-6.6 0-.7-.1-1.4-.3-2H12z"/>
                        <path fill="#34A853" d="M17.3 18.2l-2.8-2.2c-.8.5-1.9.8-3.1.8-2.3 0-4.3-1.5-5-3.5H3.3v2.2c1.5 2.9 4.5 4.8 8 4.8 2.2 0 4.1-.7 5.7-2z"/>
                        <path fill="#4A90E2" d="M6.5 12c0-.4 0-.9.2-1.3V8.5H3.3c-.7 1.3-1 2.7-1 4.5s.3 3.2 1 4.5l3.4-2.8z"/>
                        <path fill="#FBBC05" d="M12 5.6c1.2 0 2.3.4 3.1 1.1l2.3-2.3C15.8 2.9 14 2.2 12 2.2c-3.5 0-6.5 1.9-8 4.8l3.4 2.8c.7-2 2.7-3.5 5-3.5z"/>
                    </svg>
                    Continuer avec Google
                </a>

            </div>
        </div>
    </div>

    <br> <br> <br>

    <!-- Footer -->
    @include('layouts.footer')
</body>
<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>

</html>

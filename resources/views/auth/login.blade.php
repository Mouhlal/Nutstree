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
                    <div class="text-red-800 p-4 text-center">
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
            </div>
        </div>
    </div>

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

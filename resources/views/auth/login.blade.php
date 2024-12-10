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
                   <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                        <input type="password" value="{{ old('password') }}" name="password" id="password" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 focus:ring-green-500 focus:border-green-500"
                            placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-yellow-400 hover:text-gray-800 dark:text-white top-6 dark:hover:text-yellow-200">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.343 1.036-1.09 2.44-2.151 3.606a10.05 10.05 0 01-2.197 1.943M2.458 12a10.07 10.07 0 002.197 3.607c1.06 1.167 1.808 2.57 2.15 3.607M15 12c0 2.28-1.293 4.347-3.235 5.42M12 5C8.522 5 4.732 7.943 3.458 12" />
                            </svg>
                        </button>
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
                        <a href="{{route('auth.showRegister')}}" class="font-medium text-yellow-300 hover:underline dark:text-yellow-300">Inscrivez-vous</a>
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

    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePasswordButton.addEventListener('click', () => {
        // Toggle le type d'entrée entre "password" et "text"
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Change l'icône en fonction de l'état
        if (type === 'text') {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0012 19c-4.478 0-8.268-2.943-9.542-7 .343-1.036 1.09-2.44 2.151-3.606A10.07 10.07 0 015.457 7M12 9c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9z" />
            `;
        } else {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.343 1.036-1.09 2.44-2.151 3.606a10.05 10.05 0 01-2.197 1.943M2.458 12a10.07 10.07 0 002.197 3.607c1.06 1.167 1.808 2.57 2.15 3.607M15 12c0 2.28-1.293 4.347-3.235 5.42M12 5C8.522 5 4.732 7.943 3.458 12" />
            `;
        }
    });


</script>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{asset('storage/layouts/logo.jpeg')}}" type="image/x-icon">

    <title> Connexion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/home/css/style.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
        @include('temp.layouts.Humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
        @include('temp.layouts.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <div class="flex items-center justify-center min-h-screen px-4 bg-gray-200 dark:bg-gray-200">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-200">
            <div class="p-8 space-y-6">
                <!-- Logo -->
                <div class="flex justify-center">
                    <img src="{{ asset('storage/layouts/logo.jpeg') }}" alt="Nutstree Logo" class="w-16 h-16 rounded-full shadow-md">
                </div>

                <!-- Welcome Text -->
                <h2 class="text-3xl font-bold text-center text-green-600">Bienvenue sur Nutstree</h2>
                <p class="text-sm text-center text-gray-500 dark:text-gray-400">Connectez-vous pour continuer vos achats.</p>

                <!-- Login Form -->
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-black ">Adresse e-mail</label>
                        <input type="email" value="{{ old('email') }}" name="email" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:border-gray-600 focus:ring-green-500 focus:border-green-500"
                            placeholder="exemple@nutstree.com">
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-black ">Mot de passe</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-50 border dark:border-gray-600 focus:ring-green-500 focus:border-green-500"
                            placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center hover:text-gray-800 top-6 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.343 1.036-1.09 2.44-2.151 3.606a10.05 10.05 0 01-2.197 1.943M2.458 12a10.07 10.07 0 002.197 3.607c1.06 1.167 1.808 2.57 2.15 3.607M15 12c0 2.28-1.293 4.347-3.235 5.42M12 5C8.522 5 4.732 7.943 3.458 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="ml-2 text-sm text-black dark:text-gray-400">Se souvenir de moi</span>
                        </label>
                        <a href="#" class="text-sm text-green-600 hover:text-black hover:underline">Mot de passe oublié ?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-300 rounded-lg hover:bg-green-200 focus:ring-4 focus:ring-yellow-300 dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-800">
                        Connexion
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="text-center">
                        <p class="text-sm text-black dark:text-black">Pas encore de compte ?
                            <a href="{{route('auth.showRegister')}}" class="font-medium text-black hover:underline hover:text-green-700 dark:text-black">Inscrivez-vous</a>
                        </p>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-gray-800 dark:text-gray-400">Ou</span>
                    </div>
                </div>

                <!-- Google Login -->
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-black bg-gray-100 border border-gray-300 rounded-lg hover:bg-green-400 dark:bg-gray-200 dark:text-black dark:hover:bg-green-600">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#EA4335"
                            d="M12 11.8v2.8h5.1c-.2 1.4-.8 2.6-1.8 3.4l2.8 2.2c1.7-1.6 2.7-4 2.7-6.6 0-.7-.1-1.4-.3-2H12z" />
                        <path fill="#34A853"
                            d="M17.3 18.2l-2.8-2.2c-.8.5-1.9.8-3.1.8-2.3 0-4.3-1.5-5-3.5H3.3v2.2c1.5 2.9 4.5 4.8 8 4.8 2.2 0 4.1-.7 5.7-2z" />
                        <path fill="#4A90E2" d="M6.5 12c0-.4 0-.9.2-1.3V8.5H3.3c-.7 1.3-1 2.7-1 4.5s.3 3.2 1 4.5l3.4-2.8z" />
                        <path fill="#FBBC05"
                            d="M12 5.6c1.2 0 2.3.4 3.1 1.1l2.3-2.3C15.8 2.9 14 2.2 12 2.2c-3.5 0-6.5 1.9-8 4.8l3.4 2.8c.7-2 2.7-3.5 5-3.5z" />
                    </svg>
                    Continuer avec Google
                </a>
            </div>
        </div>
    </div>




    <!-- Footer Section Begin -->
        @include('temp.layouts.footer')
    <!-- Footer Section End -->

<script>
    document.getElementById('togglePassword').addEventListener('click', () => {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('#togglePassword svg');

    // Toggle password visibility
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';

    // Update the icon
    eyeIcon.innerHTML = isPassword
        ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0012 19c-4.478 0-8.268-2.943-9.542-7 .343-1.036 1.09-2.44 2.151-3.606A10.07 10.07 0 015.457 7M12 9c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9z" />`
        : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.343 1.036-1.09 2.44-2.151 3.606a10.05 10.05 0 01-2.197 1.943M2.458 12a10.07 10.07 0 002.197 3.607c1.06 1.167 1.808 2.57 2.15 3.607M15 12c0 2.28-1.293 4.347-3.235 5.42M12 5C8.522 5 4.732 7.943 3.458 12" />`;
});

</script>
    <!-- Js Plugins -->
    <script src="/home/js/jquery-3.3.1.min.js"></script>
    <script src="/home/js/bootstrap.min.js"></script>
    <script src="/home/js/jquery.nice-select.min.js"></script>
    <script src="/home/js/jquery-ui.min.js"></script>
    <script src="/home/js/jquery.slicknav.js"></script>
    <script src="/home/js/mixitup.min.js"></script>
    <script src="/home/js/owl.carousel.min.js"></script>
    <script src="/home/js/main.js"></script>


</body>

</html>

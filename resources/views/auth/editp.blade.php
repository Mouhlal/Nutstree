<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUTSTREE|EDIT PROFILE</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">

</head>

<body class="bg-gray-100">
    @include('layouts.nav')

    <div class="container mx-auto py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Modifier le profil de {{ $user->name }}</h2>

            <!-- Formulaire de modification -->
            <form action="{{ route('auth.updatep', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block font-medium">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="input-form border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="input-form border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Téléphone -->
                <div class="mb-4">
                    <label for="tel" class="block font-medium">Téléphone</label>
                    <input type="tel" name="tel" id="tel" value="{{ old('tel', $user->tel) }}" class="input-form border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <!-- Image de profil -->
                <div class="mb-4">
                    <label for="image" class="block font-medium">Image de profil</label>
                    <input type="file" name="image" id="image" class="input-form border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block font-medium">Mot de passe</label>
                    <input type="password" name="password" id="password" class="input-form border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Confirmer le mot de passe -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input-form border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded-lg">Mettre à jour</button>

               {{--  <a href="{{route('auth.profile',$user->id)}}">
                    <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded-lg">Annuler</button>
                </a>
 --}}

            </form>
        </div>
    </div>

    @include('layouts.footer')
</body>
<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
</html>

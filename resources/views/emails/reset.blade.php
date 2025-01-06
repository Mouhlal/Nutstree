<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required>
    <label for="password">Nouveau mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <label for="password_confirmation">Confirmez le mot de passe :</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
    <button type="submit">Réinitialiser le mot de passe</button>
</form>
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

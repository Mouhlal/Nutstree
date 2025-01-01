<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Votre adresse e-mail" required>
    <input type="password" name="password" placeholder="Nouveau mot de passe" required>
    <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
    <button type="submit">Réinitialiser le mot de passe</button>
</form>

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Votre adresse e-mail" required>
    <button type="submit">Envoyer un lien de réinitialisation</button>
</form>

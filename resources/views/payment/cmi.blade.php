<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMI PAYMENT</title>
</head>
<body>

    <form action="{{ config('services.cmi.payment_url') }}" method="POST" id="paymentForm">
        <input type="hidden" name="clientid" value="{{ $clientId }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="oid" value="{{ $orderId }}">
        <input type="hidden" name="okUrl" value="{{ $returnUrl }}">
        <input type="hidden" name="failUrl" value="{{ $returnUrl }}">
        <input type="hidden" name="currency" value="{{ $currency }}">
        <input type="hidden" name="callbackUrl" value="{{ $callbackUrl }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
        <button type="submit">Payer avec CMI</button>
    </form>

    <script>
        document.getElementById('paymentForm').submit(); // Soumet automatiquement le formulaire
    </script>


</body>
</html>

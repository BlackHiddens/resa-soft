<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Confirmation reservation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2>Votre reservation est confirmee</h2>
    <p>Code: <strong>{{ $reservation->reservation_code }}</strong></p>
    <p>Partie: <strong>{{ $reservation->game?->name }}</strong></p>
    <p>Date: {{ $reservation->game?->scheduled_at?->format('d/m/Y H:i') }}</p>
    <p>Type: {{ $reservation->type_label }}</p>
    <p>Total: {{ number_format($reservation->total_price, 2, ',', ' ') }} EUR</p>

    <p>Merci pour votre inscription.</p>
</body>
</html>

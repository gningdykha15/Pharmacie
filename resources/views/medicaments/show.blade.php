<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Médicament</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Détails du Médicament</h1>

        <p>ID: {{ $medicament->id }}</p>
        <p>Nom: {{ $medicament->nom }}</p>
        <p>Code Barre: {{ $medicament->codeBarre }}</p>
        <p>Date d'Expiration: {{ $medicament->dateExpiration }}</p>
        <p>Fabricant: {{ $medicament->fabricant }}</p>
        <p>Description: {{ $medicament->description }}</p>

        <h2>QR Code:</h2>
        <img src="{{ asset($qrCodePath) }}" alt="QR Code">

        <a href="{{ route('medicaments.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

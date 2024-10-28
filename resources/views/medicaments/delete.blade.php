<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Médicament</title>
    <!-- Inclure le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Confirmer la Suppression</h1>

        <p>Êtes-vous sûr de vouloir supprimer le médicament "{{ $medicament->nom }}" ?</p>

        <form action="{{ route('medicaments.destroy', $medicament->id) }}" method="POST">
            @csrf
            @method('DELETE') <!-- Indique que la requête est de type DELETE -->

            <button type="submit" class="btn btn-danger">Supprimer</button>
            <a href="{{ route('medicaments.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>

    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médicaments</title>
    <!-- Inclure le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Liste des Médicaments</h1>

        <a href="{{ route('medicaments.create') }}" class="btn btn-primary mb-3">Ajouter un Médicament</a>

        <form action="{{ url('/import-medicaments') }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <input type="file" name="file" required>
            <button type="submit" class="btn btn-success">Importer Médicaments</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date d'Expiration</th>
                    <th>Fabricant</th>
                    <th>Description</th>
                    <th>Notice</th>
                    <th>CodeBare</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicaments as $medicament)
                <tr>
                    <td>{{ $medicament->id }}</td>
                    <td>{{ $medicament->nom }}</td>
                    <td>{{ $medicament->dateExpiration}}</td>
                    <td>{{ $medicament->fabricant }}</td>
                    <td>{{ $medicament->description }}</td>
                    <td>{{ $medicament->notice }}</td>
                    

                    <td>
                        @if(!empty($medicament->medicament_code))
                            {!! DNS1D::getBarcodeHTML($medicament->medicament_code, 'C128', 2, 50) !!}
                        @else
                            <p>Code barre indisponible</p>
                        @endif
                        p - {{ $medicament->medicament_code }}
                    </td>
                    <td>
                        <a href="{{ route('medicaments.edit', $medicament->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="{{ route('medicaments.confirmDelete', $medicament->id) }}" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

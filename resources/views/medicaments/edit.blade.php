<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Médicament</title>
    <!-- Inclure le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Modifier un Médicament</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('medicaments.update', $medicament->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Indique que la requête est de type PUT -->

            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $medicament->nom) }}" class="form-control" required>
                @error('nom')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="dateExpiration">Date d'Expiration:</label>
                <input type="date" id="dateExpiration" name="dateExpiration" value="{{ old('dateExpiration', $medicament->dateExpiration) }}" class="form-control" required>
                @error('dateExpiration')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="fabricant">Fabricant:</label>
                <input type="text" id="fabricant" name="fabricant" value="{{ old('fabricant', $medicament->fabricant) }}" class="form-control" required>
                @error('fabricant')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $medicament->description) }}</textarea>
                @error('description')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

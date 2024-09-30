<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Expérience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        h1 {
            color: #0277bd;
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b;
            border-color: #01579b;
        }
        .btn-secondary {
            background-color: #b0bec5;
            border-color: #90a4ae;
        }
        .btn-secondary:hover {
            background-color: #78909c;
            border-color: #607d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Modifier une Expérience</h1>
        <form action="{{ route('experiences.update', $experience->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="idUtilisateur" class="form-label">Utilisateur</label>
                <select class="form-select" id="idUtilisateur" name="idUtilisateur" required>
                    @foreach ($utilisateurs as $utilisateur)
                        <option value="{{ $utilisateur->id }}" {{ $experience->idUtilisateur == $utilisateur->id ? 'selected' : '' }}>
                            {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="idMaladie" class="form-label">Maladie</label>
                <select class="form-control" id="idMaladie" name="idMaladie" required>
                    @foreach($maladies as $maladie)
                        <option value="{{ $maladie->id }}" {{ $experience->idMaladie == $maladie->id ? 'selected' : '' }}>
                            {{ $maladie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $experience->description }}</textarea>
            </div>

            <!-- Champ pour le statut de validation -->
            <!--<div class="mb-3">
                <label for="estValidee" class="form-label">Statut de Validation</label>
                <select class="form-select" id="estValidee" name="estValidee" required>
                    <option value="1" {{ $experience->estValidee ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ !$experience->estValidee ? 'selected' : '' }}>Non</option>
                </select>
            </div>-->

            <div class="mb-3">
                <label for="estValidee" class="form-label">Est validée :</label>
                <select name="estValidee" id="estValidee" class="form-control">
                    <option value="1" {{ $experience->estValidee ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ !$experience->estValidee ? 'selected' : '' }}>Non</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
<!--modif-->
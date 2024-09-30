<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Consultation</title>
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
        <h1 class="text-center">Modifier une Consultation</h1>
        <form action="{{ route('consultations.update', $consultation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="idUtilisateur" class="form-label">Utilisateur</label>
                <select class="form-select" id="idUtilisateur" name="idUtilisateur" required>
                    @foreach ($utilisateurs as $utilisateur)
                        <option value="{{ $utilisateur->id }}" {{ $consultation->idUtilisateur == $utilisateur->id ? 'selected' : '' }}>
                            {{ $utilisateur->prenom }} {{ $utilisateur->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Date de Consultation</label>
                <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="{{ old('created_at', $consultation->created_at ? $consultation->created_at->format('Y-m-d\TH:i') : '') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('consultations.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

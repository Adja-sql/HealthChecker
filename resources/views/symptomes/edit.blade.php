<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Symptôme</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Modifier un Symptôme</h1>
        <form action="{{ route('symptomes.update', $symptome->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Symptôme</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $symptome->nom }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $symptome->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="idConsultation" class="form-label">Consultation</label>
                <select class="form-control" id="idConsultation" name="idConsultation">
                    @foreach($consultations as $consultation)
                        <option value="{{ $consultation->id }}" {{ $consultation->id == $symptome->idConsultation ? 'selected' : '' }}>
                            {{ $consultation->dateConsultation ?? $consultation->created_at }} <!-- Utiliser un champ correct -->
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="idMaladie" class="form-label">Maladie</label>
                <select class="form-control" id="idMaladie" name="idMaladie">
                    @foreach($maladies as $maladie)
                        <option value="{{ $maladie->id }}" {{ $maladie->id == $symptome->idMaladie ? 'selected' : '' }}>
                            {{ $maladie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="idExperience" class="form-label">Expérience</label>
                <select class="form-control" id="idExperience" name="idExperience">
                    @foreach($experiences as $experience)
                        <option value="{{ $experience->id }}" {{ $experience->id == $symptome->idExperience ? 'selected' : '' }}>{{ $experience->id }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('symptomes.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

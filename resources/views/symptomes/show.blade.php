<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Symptôme</title>
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
        <h1 class="text-center">Détails du Symptôme</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Symptôme: {{ $symptome->nom }}</h5>
                <p class="card-text"><strong>Description :</strong> {{ $symptome->description }}</p>
                <p class="card-text"><strong>Date de Consultation :</strong> 
                    {{ $symptome->consultation->created_at->format('d/m/Y') ?? 'Non définie' }}
                </p>
                <p class="card-text"><strong>Maladie :</strong> {{ $symptome->maladie->nom ?? 'Non définie' }}</p>
                <p class="card-text"><strong>Date de Modification :</strong> {{ $symptome->updated_at->format('d/m/Y') }}</p>
                <a href="{{ route('symptomes.index') }}" class="btn btn-secondary mt-3">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>

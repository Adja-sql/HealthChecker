<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Diagnostic IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Résultats du Diagnostic IA</h1>
        <div class="mt-3">
            <h3>Diagnostic proposé :</h3>
            <ul>
                @foreach($conditions as $condition)
                    <li>{{ $condition['name'] }} (Probabilité : {{ $condition['probability'] * 100 }}%)</li>
                @endforeach
            </ul>
            <a href="{{ route('ai_diagnostic.debut') }}" class="btn btn-primary mt-3">Démarrer un nouveau diagnostic</a>
        </div>
    </div>
</body>
</html>

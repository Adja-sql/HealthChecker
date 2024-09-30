<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher des Expériences Similaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Rechercher un Diagnostic Basé sur des Expériences</h1>
        <form action="{{ route('diagnostics.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="symptomes" class="form-label">Entrez vos symptômes (séparés par des virgules)</label>
                <textarea class="form-control" id="symptomes" name="symptoms" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
</body>
</html>
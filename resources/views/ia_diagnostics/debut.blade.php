<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démarrer le Diagnostic IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Démarrer le Diagnostic IA</h1>
        <p>Veuillez cliquer sur le bouton pour commencer le diagnostic avec l'IA.</p>
        <form action="{{ route('ia_diagnostic.procede') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Commencer le diagnostic</button>
        </form>
    </div>
</body>
</html>

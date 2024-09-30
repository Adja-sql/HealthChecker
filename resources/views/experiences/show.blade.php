<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Expérience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa; /* Bleu très pâle */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 800px; /* Réduire la largeur pour la bannière */
        }
        h1 {
            color: #0277bd; /* Bleu foncé */
        }
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            color: #0277bd;
        }
        .btn-primary {
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b;
            border-color: #01579b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Détails de l'Expérience</h1>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Utilisateur : {{ $experience->utilisateur->prenom }} {{ $experience->utilisateur->nom }}</h5>
                <p class="card-text"><strong>Maladie : </strong>{{ $experience->maladie->nom }}</p>
                <p class="card-text"><strong>Description : </strong>{{ $experience->description }}</p>
                <p class="card-text"><strong>Validée : </strong>{{ $experience->estValidee ? 'Oui' : 'Non' }}</p>
            </div>
        </div>

        <a href="{{ route('experiences.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
    </div>
</body>
</html>

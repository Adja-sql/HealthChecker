<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa; /* Bleu très pâle */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        h1 {
            color: #0277bd; /* Bleu foncé */
            margin-bottom: 30px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #0277bd; /* Bleu foncé */
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b; /* Bleu encore plus foncé */
            border-color: #01579b;
        }
        .btn-secondary {
            background-color: #b0bec5; /* Gris bleuâtre pour annuler */
            border-color: #90a4ae;
        }
        .btn-secondary:hover {
            background-color: #78909c; /* Gris bleuâtre foncé au survol */
            border-color: #607d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Ajouter un Administrateur</h1>
        <form action="{{ route('administrateurs.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="motDePasse" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control" id="motDePasse" name="motDePasse" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="{{ route('administrateurs.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
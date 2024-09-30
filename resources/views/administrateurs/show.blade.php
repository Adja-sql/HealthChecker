<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Administrateur</title>
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
        <h1 class="text-center">Détails Administrateur</h1>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $administrateur->id }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $administrateur->prenom }}</td>
            </tr>
            <tr>
                <th>Nom</th>
                <td>{{ $administrateur->nom }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $administrateur->email }}</td>
            </tr>
            <tr>
                <th>Numéro de Téléphone</th>
                <td>{{ $administrateur->numero }}</td>
            </tr>
        </table>
        <a href="{{ route('administrateurs.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>

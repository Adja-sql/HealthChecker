<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Maladies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa; /* Bleu très pâle */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #0277bd; /* Bleu foncé */
        }
        .table {
            background-color: #ffffff; /* Fond blanc pour la table */
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #0288d1; /* Bleu moyen */
            color: white;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #e1f5fe; /* Bleu très léger */
        }
        .btn-primary {
            background-color: #0288d1; /* Bleu foncé */
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b; /* Bleu encore plus foncé */
            border-color: #01579b;
        }
        .btn-danger {
            background-color: #d32f2f; /* Rouge pour les boutons de suppression */
            border-color: #c62828;
        }
        .btn-danger:hover {
            background-color: #b71c1c; /* Rouge foncé au survol */
            border-color: #b71c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Liste des Maladies</h1>
        <!--<a href="{{ route('maladies.create') }}" class="btn btn-primary mb-3">Ajouter une Maladie</a>-->
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('maladies.create') }}" class="btn btn-primary">Ajouter une Maladie</a>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Retour à la page d'accueil</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maladies as $maladie)
                <tr>
                    <td>{{ $maladie->id }}</td>
                    <td>{{ $maladie->nom }}</td>
                    <td>{{ $maladie->description }}</td>
                    <td>
                        <a href="{{ route('maladies.show', $maladie->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('maladies.edit', $maladie->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('maladies.destroy', $maladie->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette maladie ?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

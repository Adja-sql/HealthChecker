<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Expériences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #0277bd;
        }
        .table {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #0288d1;
            color: white;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #e1f5fe;
        }
        .btn-info, .btn-warning, .btn-danger {
            padding: 0.5rem;
            font-size: 1rem;
        }
        .btn-info {
            color: #ffffff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            color: #ffffff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Custom button style for "Ajouter une Expérience" */
        .btn-ajouter {
            background-color: #0288d1;
            border-color: #0288d1;
            color: white;
        }

        .btn-ajouter:hover {
            background-color: #0277bd;
            border-color: #0277bd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Liste des Expériences</h1>
        <!--<a href="{{ route('experiences.create') }}" class="btn btn-primary mb-3">Ajouter une Expérience</a>-->
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('experiences.create') }}" class="btn btn-ajouter">Ajouter une Expérience</a>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Retour à la page d'accueil</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <!--<th>Date de Partage</th>-->
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($experiences as $experience)
                <tr>
                    <td>{{ $experience->id }}</td>
                    <td>{{ $experience->description }}</td>
                    <!--<td>{{ $experience->dateDePartage }}</td>-->
                    <td>{{ $experience->estValidee ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a href="{{ route('experiences.show', $experience->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('experiences.edit', $experience->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('experiences.destroy', $experience->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?');">
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

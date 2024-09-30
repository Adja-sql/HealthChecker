<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Symptômes</title>
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
            margin-bottom: 30px;
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
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b;
            border-color: #01579b;
        }
        .btn-danger {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Liste des Symptômes</h1>
        <a href="{{ route('symptomes.create') }}" class="btn btn-primary mb-3">Ajouter un Symptôme</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Maladie</th>
                    <th>Date de Consultation</th>
                    <th>Date de Modification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($symptomes as $symptome)
                    <tr>
                        <td>{{ $symptome->id }}</td>
                        <td>{{ $symptome->nom }}</td>
                        <td>{{ $symptome->description }}</td>
                        <td>{{ $symptome->maladie->nom ?? 'Non définie' }}</td>
                        <td>{{ $symptome->consultation->created_at->format('d/m/Y') ?? 'Non définie' }}</td> <!-- Date de consultation -->
                        <td>{{ $symptome->updated_at->format('d/m/Y') }}</td> <!-- Date de modification -->
                        <td>
                            <a href="{{ route('symptomes.show', $symptome->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('symptomes.edit', $symptome->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('symptomes.destroy', $symptome->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

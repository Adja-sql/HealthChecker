<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Diagnostics</title>
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
            border-color: #c62828;
        }
        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Liste des Diagnostics</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('diagnostics.create') }}" class="btn btn-primary">Ajouter un Diagnostic</a>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Retour à la page d'accueil</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Maladie</th>
                    <th>Consultation</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($diagnostics as $diagnostic)
                <tr>
                    <td>{{ $diagnostic->id }}</td>
                    <td>{{ $diagnostic->maladie->nom }}</td>
                    <td>{{ $diagnostic->idConsultation }}</td>                 
                    <td>{{ $diagnostic->created_at }}</td>
                    <td>
                        <a href="{{ route('diagnostics.show', $diagnostic->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('diagnostics.edit', $diagnostic->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('diagnostics.destroy', $diagnostic->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce diagnostic ?');"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

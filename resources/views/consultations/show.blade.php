<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Consultation</title>
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
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
        <h1 class="text-center">Détails de la Consultation</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Consultation #{{ $consultation->id }}</h5>
                <!-- Afficher la date de consultation -->
                <p class="card-text"><strong>Date de Consultation :</strong> {{ $consultation->created_at->format('d/m/Y') }}</p>
                
                <!-- Afficher les informations de l'utilisateur -->
                <p class="card-text"><strong>Utilisateur :</strong> 
                    @if($consultation->utilisateur)
                        {{ $consultation->utilisateur->prenom }} {{ $consultation->utilisateur->nom }}
                    @else
                        Utilisateur non défini
                    @endif
                </p>
                <a href="{{ route('consultations.edit', $consultation->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</a>
                <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette consultation ?');"><i class="fas fa-trash"></i> Supprimer</button>
                </form>
                <a href="{{ route('consultations.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>

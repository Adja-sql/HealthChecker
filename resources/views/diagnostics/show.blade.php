<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Diagnostic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 800px;
        }
        h1 {
            color: #0277bd;
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
        <h1 class="text-center">Détails du Diagnostic</h1>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Maladie : {{ $diagnostic->maladie->nom }}</h5>
                <p class="card-text"><strong>Consultation : </strong>{{ $diagnostic->idConsultation }}</p>
                <p class="card-text"><strong>Date : </strong>{{ $diagnostic->created_at }}</p>
            </div>
        </div>

        <a href="{{ route('diagnostics.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
    </div>
</body>
</html>

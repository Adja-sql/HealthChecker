<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Diagnostic IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0f7fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        h1 {
            color: #0277bd;
            margin-bottom: 30px;
            text-align: center;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #ffffff;
        }
        .card h3 {
            color: #0277bd;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .card p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #555;
        }
        .btn-primary {
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b;
            border-color: #01579b;
        }
        .text-label {
            font-weight: bold;
            color: #0288d1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Détails du Diagnostic IA</h1>
        <div class="card">
        <h3><span class="text-label">ID de la Consultation:</span> {{ $diagnostic->consultation->id }}</h3>
            <p><span class="text-label">Diagnostic IA:</span> {{ $diagnostic->diagnosticIA }}</p>
            <p><span class="text-label">Date du Diagnostic:</span> {{ $diagnostic->dateIADiagnostic }}</p>
            <a href="{{ route('ia_diagnostics.index') }}" class="btn btn-primary mt-3">Retour à la liste</a>
        </div>
    </div>
</body>
</html>
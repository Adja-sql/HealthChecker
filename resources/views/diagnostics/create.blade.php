<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Diagnostic</title>
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
        }
        .form-control, .form-select {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #0277bd;
            border-color: #0277bd;
        }
        .btn-primary:hover {
            background-color: #01579b;
            border-color: #01579b;
        }
        .btn-secondary {
            background-color: #b0bec5;
            border-color: #90a4ae;
        }
        .btn-secondary:hover {
            background-color: #78909c;
            border-color: #607d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Ajouter un Diagnostic</h1>
        <form action="{{ route('diagnostics.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="idMaladie" class="form-label">Maladie</label>
                <select class="form-select" id="idMaladie" name="idMaladie" required>
                    <option value="" disabled selected>Choisissez une maladie</option>
                    @foreach($maladies as $maladie)
                        <option value="{{ $maladie->id }}">{{ $maladie->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="idConsultation" class="form-label">Consultation</label>
                <select class="form-select" id="idConsultation" name="idConsultation" required>
                    <option value="" disabled selected>Choisissez une consultation</option>
                    @foreach($consultations as $consultation)
                        <option value="{{ $consultation->id }}">{{ $consultation->created_at }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="{{ route('diagnostics.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>

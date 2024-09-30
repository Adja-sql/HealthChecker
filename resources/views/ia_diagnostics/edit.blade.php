<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Diagnostic IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Modifier le Diagnostic IA</h1>
        <div class="card p-4">
        <form action="{{ route('ia_diagnostics.update', $diagnostic->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="consultation_id" class="form-label">Consultation</label>
                <select id="consultation_id" name="consultation_id" class="form-select" required>
                    @foreach($consultations as $consultation)
                        <option value="{{ $consultation->id }}" {{ $consultation->id == $diagnostic->consultation_id ? 'selected' : '' }}>
                            Consultation {{ $consultation->id }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="diagnosticIA" class="form-label">Diagnostic IA</label>
                <input type="text" class="form-control" id="diagnosticIA" name="diagnosticIA" value="{{ old('diagnosticIA', $diagnostic->diagnosticIA) }}" required>
            </div>
            <div class="mb-3">
                <label for="dateIADiagnostic" class="form-label">Date du Diagnostic</label>
                <input type="date" class="form-control" id="dateIADiagnostic" name="dateIADiagnostic" value="{{ old('dateIADiagnostic', $diagnostic->dateIADiagnostic) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('ia_diagnostics.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
        </div>
    </div>
</body>
</html>

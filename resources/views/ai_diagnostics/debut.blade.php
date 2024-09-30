<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démarrer le Diagnostic IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Démarrer le Diagnostic IA</h1>
        <form action="{{ route('ai_diagnostic.procede') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="question" class="form-label">{{ $question['text'] }}</label>
                @foreach($question['items'] as $item)
                    <div>
                        <input type="radio" name="answer" value="{{ $item['id'] }}" required> {{ $item['name'] }}
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Suivant</button>
        </form>
    </div>
</body>
</html>

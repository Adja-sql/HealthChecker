<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Résultats du Diagnostic Basé sur les Expériences</h1>
        @if(count($results) > 0)
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Maladie</th>
                        <th>Symptômes</th>
                        <th>Correspondance (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result['experience']->maladie->nom }}</td>
                            <td>{{ $result['experience']->description }}</td>
                            <td>{{ $result['similarity'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                Aucun diagnostic n'a été trouvé correspondant à vos symptômes.
            </div>
        @endif
    </div>
</body>
</html>
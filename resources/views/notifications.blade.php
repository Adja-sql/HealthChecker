<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f9ff; /* Bleu plus prononcé pour l'arrière-plan */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: #fff; /* Bleu plus intense pour le conteneur */
            border-radius: 15px; /* Bordures encore plus arrondies */
            padding: 30px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15); /* Ombre plus marquée */
            margin-top: 50px;
            color: white;
        }

        h1 {
            font-size: 2.5rem;
            color: #0056b3; /* Couleur blanche pour le titre */
            text-align: center;
            margin-bottom: 30px;
        }

        .list-group-item {
            background-color: #f0f9ff; /* Bleu très clair pour chaque notification */
            border: none;
            border-radius: 12px;
            margin-bottom: 10px;
            padding: 15px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
            color: #000; /* Bleu pour le texte */
        }

        .list-group-item:hover {
            background-color: #99ffcc; /* Effet de survol avec bleu léger */
            transform: translateY(-3px); /* Légère élévation au survol */
        }

        small {
            color: #6c757d; /* Couleur pour les petites informations comme la date */
            font-size: 0.9rem;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Notifications</h1>

        <ul class="list-group">
            @foreach ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $notification->message }}
                    <small>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i') }}</small>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>

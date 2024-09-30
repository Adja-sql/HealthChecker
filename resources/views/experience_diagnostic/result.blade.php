<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du Diagnostic Basé sur les Expériences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style personnalisé avec des vagues de couleur -->
    <style>
        body {
            background: linear-gradient(to bottom, #e0f7fa, #b2ebf2, #81d4fa, #4fc3f7, #0288d1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            margin-top: 50px;
            max-width: 700px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            color: #00509d;
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            background-color: #f0f9ff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-home {
            background-color: #00bfff;
            color: #fff; /* Texte en blanc */
            border: none;
            padding: 10px 30px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: block;
            text-align: center;
            text-decoration: none; /* Enlève le surlignage */
            margin: 20px auto; /* Centrage horizontal du bouton */
            width: fit-content; /* Ajuste la taille du bouton selon le contenu */
        }

        .btn-home:hover {
            background-color: #007acc;
            transform: translateY(-5px);
        }

        /* Style pour le lien Voir plus */
        .voir-plus {
            font-size: 0.9rem;
            margin-left: 10px;
        }

        .voir-plus a {
            color: #007acc;
            text-decoration: none;
        }

        .voir-plus a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Résultats du Diagnostic</h1>
        @if (!empty($results))
            <ul>
                @foreach ($results as $result)
                    <li>
                        <strong>Maladie : </strong> {{ $result['maladie'] }}
                        <span class="voir-plus">
                            <a href="https://www.google.com/search?q={{ urlencode($result['maladie']) }}" target="_blank">Voir plus...</a>
                        </span>
                        <br>
                        <strong>Symptômes correspondants : </strong> {{ $result['experience']->description }}<br>
                        <strong>Correspondance : </strong> {{ $result['similarity'] }}%
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucun diagnostic trouvé.</p>
        @endif

        <!-- Bouton Retour à l'accueil centré -->
        <a href="{{ url('/dashboard') }}" class="btn-home">Retour à l'accueil</a>
    </div>
</body>
</html>
<!--modif-->
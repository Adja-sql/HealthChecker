<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur HealthChecker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Importation de la police Harlow Solid Italic */
        @font-face {
            font-family: 'Harlow Solid Italic';
            src: url('{{ asset('fonts/HarlowSolidItalic.ttf') }}');
        }

        /* Conteneur global */
        body {
            background-image: url('/images/4.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Harlow Solid Italic', cursive;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        /* Conteneur principal avec du verre dépoli */
        .container {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            padding: 30px; /* Réduction du padding pour ajuster les marges */
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 500px; /* Limitation de la largeur pour éviter les débordements */
            width: 100%;
        }

        /* Style de Bienvenue sur et HealthChecker */
        h1 {
            font-size: 1.8rem; /* Réduction de la taille pour "Bienvenue sur" */
            margin-bottom: 10px;
            font-weight: 700;
        }

        .health-checker {
            font-size: 3rem; /* Ajustement pour HealthChecker */
            font-weight: 700;
            text-transform: uppercase;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        /* Boutons avec des couleurs plus vives (ivoire et bleu céleste) */
        .btn-custom {
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 30px;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary-custom {
            background-color: #00BFFF; /* Bleu céleste */
            color: #fff;
        }

        .btn-primary-custom:hover {
            background-color: #87CEEB; /* Bleu clair */
            transform: scale(1.05);
        }

        .btn-secondary-custom {
            background-color: #FFFFF0; /* Ivoire */
            color: #333;
        }

        .btn-secondary-custom:hover {
            background-color: #FF3366; /* Jaune pâle */
            transform: scale(1.05);
        }

        /* Boutons en haut à droite */
        .header-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .header-buttons a {
            margin-left: 10px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Boutons de connexion et inscription en haut -->
    <div class="header-buttons">
        <a href="{{ route('login') }}" class="btn btn-secondary-custom">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-primary-custom">Créer un compte</a>
    </div>

    <!-- Contenu principal avec un bloc de verre dépoli ajusté -->
    <div class="container">
        <h1>Bienvenue sur</h1>
        <div class="health-checker">HealthChecker</div>
        <p>Votre compagnon pour comprendre et suivre votre santé.</p>
    </div>
</body>
</html>

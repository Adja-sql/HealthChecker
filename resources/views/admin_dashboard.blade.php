<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Bleu très pâle pour un fond apaisant */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #004080; /* Bleu profond pour un look professionnel */
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            color: white;
            box-shadow: 3px 0 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }

        .sidebar h2 {
            font-size: 1.5rem; /* Taille ajustée pour être alignée avec la topbar */
            text-align: center;
            padding: 15px 0;
            background-color: #003366; /* Accent bleu foncé */
            margin: 0;
        }

        .sidebar a {
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar a:hover {
            background-color: #002b50; /* Nuance de bleu plus foncé au survol */
            padding-left: 30px; /* Animation légère au survol */
        }

        /* Topbar */
        .topbar {
            height: 60px;
            background-color: #0033cc;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: fixed;
            width: calc(100% - 250px);
            top: 0;
            left: 250px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre sous la barre */
        }

        .topbar h1 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .logout-section a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
        }

        .logout-section a:hover {
            text-decoration: underline;
        }

        /* Main content */
        .content {
            margin-left: 250px;
            padding: 80px 20px 20px; /* Espace au-dessus pour la topbar */
        }

        /* Banner styles */
        .banner-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .banner {
            flex: 1;
            padding: 30px 20px;
            border-radius: 10px;
            text-align: center;
            margin: 0 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .banner:hover {
            transform: translateY(-5px); /* Animation légère au survol */
        }

        .banner h2 {
            font-size: 3rem; /* Taille augmentée pour une meilleure visibilité */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .banner p {
            font-size: 1.5rem; /* Taille augmentée pour les mots */
            font-weight: 600;
        }

        /* Banner colors */
        .banner.users {
            background-color: #FFCCFF; /* Rose pâle pour les utilisateurs */
            color: #b300b3; /* Texte plus foncé pour le contraste */
        }

        .banner.admins {
            background-color: #99FFFF; /* Bleu pâle pour les administrateurs */
            color: #006666; /* Texte plus foncé pour le contraste */
        }

        .banner.diagnostics {
            background-color: #FFFF99; /* Jaune pâle pour les diagnostics */
            color: #b3b300; /* Texte plus foncé pour le contraste */
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>HealthChecker</h2>
        <a href="{{ route('utilisateurs.index') }}">Gestion des Utilisateurs</a>
        <a href="{{ route('diagnostics.index') }}">Gestion des Diagnostics</a>
        <a href="{{ route('experiences.index') }}">Gestion des Expériences</a>
        <a href="{{ route('maladies.index') }}">Gestion des Maladies</a>
        <a href="{{ route('admin.graphs') }}">Graphiques de Données</a>
        <!--<a href="{{ route('admin.notifications') }}">Notifications</a>-->
        <a href="{{ route('admin.notifications') }}">Notifications <span class="badge badge-danger">{{ $unreadNotificationsCount }}</span></a>
        <a href="{{ route('privacy.policy') }}">Confidentialité</a>
        <a href="{{ route('profile.show') }}">Profil</a>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <!--<h1>Bienvenue sur votre tableau de bord, {{ Auth::user()->prenom }} !</h1>-->
        @if (Auth::user() && Auth::user()->role == 'A')
            <h1>Bienvenue sur votre tableau de bord, {{ Auth::user()->prenom }} !</h1>
        @else
            <h1>Accès réservé aux administrateurs.</h1>
        @endif
        <div class="logout-section">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   this.closest('form').submit();">
                   Se déconnecter
                </a>
            </form>
        </div>
    </div>

    <!-- Main content area -->
    <div class="content">
        <!-- Bannières avec les statistiques -->
        <div class="banner-container">
            <div class="banner users">
                <h2>{{ $usersCount }}</h2>
                <p>Utilisateurs</p>
            </div>
            <div class="banner admins">
                <h2>{{ $adminsCount }}</h2>
                <p>Administrateurs</p>
            </div>
            <div class="banner diagnostics">
                <h2>{{ $diagnosticsCount }}</h2>
                <p>Diagnostics Émis</p>
            </div>
        </div>
    </div>

</body>
</html>

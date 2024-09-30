<x-app-layout>
    <!-- Conteneur principal -->
    <div class="dashboard-container">
        <!-- Message d'accueil personnalisé -->
        <div class="welcome-section">
            <h1>Bonjour, {{ Auth::user()->prenom }} !</h1>
            <p>Je suis HealthChecker, votre compagnon pour comprendre et suivre votre santé.</p>
        </div>

        <!-- Bannières principales -->
        <div class="main-banner-section">
            <div class="main-banner">
                <a href="{{ url('/experience-diagnostic/debut') }}" class="banner-btn experience-btn">
                    <div class="banner-content">
                        <h2>Évaluation par les expériences</h2>
                        <p>Basée sur les expériences des utilisateurs.</p>
                    </div>
                </a>
            </div>
            <div class="main-banner">
                <a href="{{ url('/ai-diagnostic') }}" class="banner-btn ai-btn">
                    <div class="banner-content">
                        <h2>Évaluation par l'IA</h2>
                        <p>Diagnostic intelligent basé sur l'intelligence artificielle.</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Section des bannières en bas de page -->
        <div class="bottom-banner-section">
            <a href="{{ url('/symptom-tracking') }}" class="bottom-banner-btn">Suivi des symptômes</a>
            <a href="{{ url('/diagnostics') }}" class="bottom-banner-btn">Liste des diagnostics</a>
            <a href="{{ url('/experiences/create') }}" class="bottom-banner-btn">Partager une expérience</a>
        </div>
    </div>

    <!-- Style intégré avec couleurs vibrantes et effets dynamiques -->
    <style>
        /* Conteneur global */
        .dashboard-container {
            text-align: center;
            padding: 40px;
            background-color: #f0f8ff; /* Fond léger et apaisant */
        }

        /* Section de bienvenue */
        .welcome-section h1 {
            font-size: 2.5rem;
            color: #00509d;
            font-weight: bold;
        }

        .welcome-section p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 40px;
        }

        /* Bannières principales avec du peps et de l'élégance */
        .main-banner-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .main-banner {
            flex: 1;
            margin: 0 10px;
            transition: transform 0.3s ease;
        }

        .banner-btn {
            display: block;
            background-color: #4B6382;
            color: white;
            padding: 40px;
            border-radius: 15px;
            text-decoration: none;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .banner-btn:hover {
            background-color: #003f66;
            transform: translateY(-10px);
        }

        .banner-content h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .banner-content p {
            font-size: 1rem;
        }

        /* Couleurs spécifiques pour les boutons des bannières */
        .experience-btn {
            background-color: #FFA07A;
        }

        .experience-btn:hover {
            background-color: #FF6347;
        }

        .ai-btn {
            background-color: #20B2AA;
        }

        .ai-btn:hover {
            background-color: #008080;
        }

        /* Bannières en bas avec un style dynamique */
        .bottom-banner-section {
            display: flex;
            justify-content: space-between;
        }

        .bottom-banner-btn {
            background-color: #4B6382;
            color: white;
            padding: 15px 30px;
            border-radius: 30px;
            text-decoration: none;
            flex: 1;
            margin: 0 10px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .bottom-banner-btn:hover {
            background-color: #355a7d;
            transform: translateY(-5px);
        }

    </style>
</x-app-layout>

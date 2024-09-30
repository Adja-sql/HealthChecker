<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Expérience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style personnalisé -->
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
            max-width: 550px; /* Réduction de la taille du conteneur */
            background-color: #ffffff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            color: #00509d;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.2rem;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
        }

        /* Message sous la description */
        .message-symptomes {
            font-size: 0.9rem;
            color: #777;
            margin-top: 5px;
        }

        /* Style des boutons */
        .btn-primary {
            background-color: #00bfff;
            color: #fff;
            border: none;
            padding: 10px 30px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #007acc;
            transform: translateY(-5px);
        }

        .btn-secondary {
            background-color: #b0bec5;
            color: #fff;
            border: none;
            padding: 10px 30px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #ff4c4c; /* Changement en rouge au hover */
            transform: translateY(-5px);
        }

        /* Style pour aligner les boutons sur la même ligne */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter une Expérience</h1>
        <form action="{{ route('experiences.store') }}" method="POST">
            @csrf
            <!-- ID utilisateur récupéré automatiquement -->
            <input type="hidden" name="idUtilisateur" value="{{ Auth::user()->id }}">

            <!-- Champ caché pour la validation par défaut -->
            <input type="hidden" name="estValidee" value="1">

            <!-- Sélection de la maladie, classée par ordre alphabétique -->
            <div class="mb-3">
                <label for="idMaladie" class="form-label">Maladie</label>
                <select class="form-select" id="idMaladie" name="idMaladie" required>
                    <option value="" disabled selected>Choisir une maladie</option>
                    @foreach($maladies->sortBy('nom') as $maladie)
                        <option value="{{ $maladie->id }}">{{ $maladie->nom }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Description de l'expérience -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                <p class="message-symptomes">Veuillez décrire vos symptômes par des mots séparés par des virgules. Exemple : maux de tête, vomissement, évanouissement, etc.</p>
            </div>
            
            <!-- Boutons alignés -->
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Partager Expérience</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>

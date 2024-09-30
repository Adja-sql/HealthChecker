<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Basé sur les Expériences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style personnalisé pour des vagues de couleur -->
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

        label {
            font-size: 1.2rem;
            color: #333;
        }

        textarea {
            border-radius: 10px;
            padding: 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .btn-primary {
            background-color: #00bfff;
            border: none;
            padding: 10px 30px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: block;
            margin: 20px auto;
        }

        .btn-primary:hover {
            background-color: #007acc;
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Commencer un Diagnostic Basé sur les Expériences</h1>
        <form action="{{ route('experience.diagnostic.process') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="symptomes">Entrez vos symptômes</label>
                <textarea id="symptomes" name="symptoms" class="form-control" rows="3" placeholder="Décrivez vos symptômes ici..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
</body>
</html>

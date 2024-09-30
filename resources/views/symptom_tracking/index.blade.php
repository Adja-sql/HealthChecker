<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des Symptômes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f0f4f8; /* Fond plus contrasté */
        }
        .container {
            width: 80%;
            margin: 30px auto; /* Réduction de l'espace au top */
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Augmenter l'ombre pour plus de contraste */
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #00509d;
            margin-bottom: 20px;
            font-weight: bold; /* Mettre le texte en gras */
        }
        .alert-message {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-top: 20px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Évolution de vos symptômes</h1>
        <canvas id="symptomChart" width="400" height="200"></canvas>
        <div class="alert-message" id="alertMessage">Un ou plusieurs symptômes sont présents trop souvent. Veuillez consulter un médecin.</div>
    </div>

    <script>
        const ctx = document.getElementById('symptomChart').getContext('2d');
        const symptomsData = @json($symptomsData);

        // Extraire les symptômes et compter leur occurrence
        const symptomCounts = {};
        symptomsData.forEach(entry => {
            const symptoms = entry.symptoms.split(','); // Diviser les symptômes
            symptoms.forEach(symptom => {
                const trimmedSymptom = symptom.trim();
                symptomCounts[trimmedSymptom] = (symptomCounts[trimmedSymptom] || 0) + 1;
            });
        });

        // Extraire les noms des symptômes et les occurrences
        const labels = Object.keys(symptomCounts);
        const data = Object.values(symptomCounts);

        // Fonction pour déterminer la couleur de chaque barre
        const barColors = data.map(count => {
            if (count >= 5) return 'red'; // Rouge pour plus de 5 occurrences
            if (count >= 3) return 'orange'; // Orange pour 3 à 4 occurrences
            return 'green'; // Vert pour moins de 3 occurrences
        });

        // Afficher un message si un symptôme dépasse 5 occurrences
        const showAlert = data.some(count => count >= 5);
        if (showAlert) {
            document.getElementById('alertMessage').style.display = 'block';
        }

        // Créer l'histogramme à barres
        const symptomChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Noms des symptômes
                datasets: [{
                    label: 'Nombre de fois enregistré',
                    data: data, // Nombre de fois que chaque symptôme est enregistré
                    backgroundColor: barColors, // Couleur des barres selon la gravité
                    borderColor: barColors,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 6, // Limite de l'axe Y pour éviter des barres trop hautes
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                barThickness: 10 // Ajuster la largeur des barres
            }
        });
    </script>
</body>
</html>

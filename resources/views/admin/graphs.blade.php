<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphiques de Données</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f7f9; /* Fond doux */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: 40px auto; /* Ajout de 50px d'espace en haut */
        }

        h1 {
            margin-bottom: 30px;
            color: #0277bd;
            text-align: center;
            font-size: 2.5rem; /* Augmentation de la taille de police */
            font-weight: bold; /* Texte en gras */
        }

        .chart-container {
            margin-bottom: 50px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #0277bd;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Évolution des Données</h1>

        <!-- Utilisateurs inscrits -->
        <div class="chart-container">
            <h2 class="chart-title">Utilisateurs Inscrits</h2>
            <canvas id="usersChart"></canvas>
        </div>

        <!-- Expériences partagées -->
        <div class="chart-container">
            <h2 class="chart-title">Expériences Partagées</h2>
            <canvas id="experiencesChart"></canvas>
        </div>

        <!-- Diagnostics émis -->
        <div class="chart-container">
            <h2 class="chart-title">Diagnostics Émis</h2>
            <canvas id="diagnosticsChart"></canvas>
        </div>

    </div>

    <script>
        // Utilisateurs inscrits
        var ctxUsers = document.getElementById('usersChart').getContext('2d');
        var usersChart = new Chart(ctxUsers, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Utilisateurs Inscrits',
                    data: @json($usersData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Expériences partagées
        var ctxExperiences = document.getElementById('experiencesChart').getContext('2d');
        var experiencesChart = new Chart(ctxExperiences, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Expériences Partagées',
                    data: @json($experiencesData),
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Diagnostics émis
        var ctxDiagnostics = document.getElementById('diagnosticsChart').getContext('2d');
        var diagnosticsChart = new Chart(ctxDiagnostics, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Diagnostics Émis',
                    data: @json($diagnosticsData),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>

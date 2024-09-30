<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Diagnostics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h1 {
            color: #00509d;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Style de la timeline */
        .timeline {
            position: relative;
            padding: 0;
            list-style: none;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            height: 100%;
            width: 2px;
            background: #00509d;
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
        }

        .timeline-item.left {
            left: 0;
            text-align: right;
        }

        .timeline-item.right {
            left: 50%;
        }

        .timeline-item .date {
            font-weight: bold;
            color: #00509d;
        }

        .timeline-item .maladie {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(50% - 4px);
            width: 10px;
            height: 10px;
            background: #00509d;
            border-radius: 50%;
            transform: translateX(-50%);
        }

        .timeline-item.left::before {
            left: calc(100% - 4px);
        }

        .timeline-item.right::before {
            left: -6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mes Diagnostics</h1>

        <ul class="timeline">
            @forelse($diagnostics as $diagnostic)
                <li class="timeline-item {{ $loop->index % 2 == 0 ? 'left' : 'right' }}">
                    <div class="date">{{ $diagnostic->created_at->format('d F Y') }}</div>
                    <div class="time">{{ $diagnostic->created_at->format('H:i') }}</div>
                    <div class="maladie">{{ $diagnostic->maladie->nom }}</div>
                </li>
            @empty
                <p style="text-align: center; font-weight: bold;">Aucun diagnostic n'a été trouvé</p>
                <p style="text-align: center;">Veuillez commencer une évaluation pour pouvoir observer vos diagnostics</p>
            @endforelse
        </ul>
    </div>
</body>
</html>

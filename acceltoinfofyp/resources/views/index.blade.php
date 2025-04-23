@extends('nav')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>F1 Driver Standings</h2>

    @if(count($drivers) == 1)
        <h3>{{ $drivers[array_key_first($drivers)]['Driver']['givenName'] }} 
            {{ $drivers[array_key_first($drivers)]['Driver']['familyName'] }}</h3>
        <p>Points: {{ $drivers[array_key_first($drivers)]['points'] }}</p>
        <p>Wins: {{ $drivers[array_key_first($drivers)]['wins'] }}</p>
    @else
        <canvas id="driversChart"></canvas>

        <script>
            var ctx = document.getElementById('driversChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($drivers, 'Driver.familyName')),
                    datasets: [{
                        label: 'Points',
                        data: @json(array_column($drivers, 'points')),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)'
                    }]
                }
            });
        </script>
    @endif
</body>
</html>


<?php
// Connect to your database
$db = new PDO('mysql:host=localhost;dbname=moodmeter', 'root', 'root');

// Fetch the data from your moodmeter table
$query = $db->query('SELECT stemmingwaarde, COUNT(*) as count FROM moodrecord GROUP BY stemmingwaarde');
$data = $query->fetchAll(PDO::FETCH_ASSOC);

// Encode the data into JSON format
$jsonData = json_encode($data);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
<div id="chart"></div>
    <script>
        // Parse the JSON data
        var data = JSON.parse('<?php echo $jsonData; ?>');

        // Use the data in your chart
        var options = {
    series: [{
        name: 'Mood',
        data: data.map(function(item) {
            return item.count;
        })
    }],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    xaxis: {
        categories: data.map(function(item) {
            // Create a mapping for the moods
            var moodMapping = {
                '1': 'blij',
                '2': 'saai',
                '3': 'boos'
            };

            // Use the mapping to set the categories
            return moodMapping[item.stemmingwaarde];
        }),
    },
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
    </script>
</body>
</html>
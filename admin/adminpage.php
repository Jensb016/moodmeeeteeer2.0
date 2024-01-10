<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to your database
$db = new PDO('mysql:host=localhost;dbname=moodmeter', 'root', 'root');

// Get all records from the joined tables
$query = $db->prepare("
    SELECT *
    FROM moodrecord
    INNER JOIN enquête ON moodrecord.GebruikerID = enquête.GebruikerID
    INNER JOIN opleiding ON enquête.OpleidingID = opleiding.OpleidingID
");
$query->execute();

$data = $query->fetchAll(PDO::FETCH_ASSOC);
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
<table>
    <thead>
        <tr>
            <th>GebruikerID</th>
            <th>StemmingWaarde</th>
            <th>OpleidingNaam</th>
            <th>Geboortedatum</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['GebruikerID']; ?></td>
                <td><?php echo $row['StemmingWaarde']; ?></td>
                <td><?php echo $row['OpleidingNaam']; ?></td>
                <td><?php echo $row['Geboortedatum']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="chart"></div>

<script>
var data = <?php echo json_encode($data); ?>;

var chartData = data.reduce(function(acc, item) {
    var opleiding = item.OpleidingNaam;
    var mood = parseInt(item.StemmingWaarde);

    if (!acc[opleiding]) {
        acc[opleiding] = [0, 0, 0]; // Initialize the array with zeroes for each mood
    }

    acc[opleiding][mood - 1] += 1; // Add 1 to the corresponding mood

    return acc;
}, {});

var categories = Object.keys(chartData);
var series = categories.map(function(opleiding) {
    return {
        name: opleiding,
        data: chartData[opleiding]
    };
});

var options = {
    chart: {
        type: 'bar',
        height: 350  // Adjust this value to your liking
    },
    series: series,
    xaxis: {
        categories: ['blij', 'saai', 'boos']
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
</script>
</body>
</html>
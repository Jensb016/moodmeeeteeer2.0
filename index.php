
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>moodmeter</title>
</head>
<body>
    <header>
        <div id="block_blauw"></div>
        <div id="block_geel"><h1>MOODMETER</h1></div>
        <div id="block_rood"></div>
    </header>


    <main>
    <form method="post" action="handleform.php">
        <button id="block_groen" type="submit" name="stem" value="1"></button>
        <button id="block_donkerblauw" type="submit" name="stem" value="2"></button>
        <button id="block_oranje" type="submit" name="stem" value="3"></button>
    </form>
</main>
</main>

    <footer>
        <div id="block_lichtoranje"></div>
        <div id="block_paars"></div>
        <div id="block_lichtblauw"></div>
    </footer>
</body>
</html>
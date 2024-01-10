<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "moodmeter";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the GebruikerID from the session
  $gebruikerID = $_SESSION["GebruikerID"];
  
  $opleiding = $_POST["opleiding"];
  $geboortedatum = $_POST["geboortedatum"];

  $sql = "INSERT INTO Enquête (GebruikerID, Geboortedatum, OpleidingID)
  VALUES ('$gebruikerID', '$geboortedatum', '$opleiding')";

  if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/enquete.css"> 
</head>
<body>
    <header>
    <div><H1 id="enquete">Enquete</H1></div>
    </header>
    <main>
    <div id="opleiding">
        <h1>Voor welke opleiding ben je er?</h1>
        <form method="POST" action="enquete.php">
        <label for="AllrounderICT">Allrounder ICT</label><input type="radio" name="opleiding" value="1" id="AllrounderICT"><br>
        <label for="Grafischvormgever">Grafisch vormgever</label><input type="radio" name="opleiding" value="2" id="Grafischvormgever "><br>
        <label for="ExpertICT">Expert ICT</label><input type="radio" name="opleiding" value="3" id="ExpertICT"><br>
        <label for="Webdeveloper">Webdeveloper</label><input type="radio" name="opleiding" value="4" id="Webdeveloper"><br>
        <label for="Contentcreator">Content creator</label><input type="radio" name="opleiding" value="5" id="Contentcreator"><br>
        <label for="E-commercespecialist">E-commerce</label><input type="radio" name="opleiding" value="6" id="E-commercespecialist"><br>
        <label for="Accountmanager">Accountmanager</label><input type="radio" name="opleiding" value="7" id="Accountmanager"><br>
        <label for="Retailmanager">Retailmanager</label><input type="radio" name="opleiding" value="8" id="Retailmanager"><br>
        <label for="Onlinemarketeer">Online marketeer</label><input type="radio" name="opleiding" value="9" id="    "><br>
      

    </div>
    <div id="persoonlijk">
        <h1>Geboorte Datum</h1>
        <input type="date" name="geboortedatum" id="geboortedatum">
    </div>
      <input type="submit" value="Verstuur" id="verstuur">
    </main>
    </form>
</body>
</html>
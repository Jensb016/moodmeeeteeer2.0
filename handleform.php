<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to your database
$db = new PDO('mysql:host=localhost;dbname=moodmeter', 'root', 'root');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the value from the form
    $stem = $_POST['stem'];


    try {
        // Insert a new user into the Gebruiker table
        $query = $db->prepare("INSERT INTO Gebruiker (GebruikerID) VALUES (NULL)");
        $query->execute();
    
        // Get the ID of the last inserted user
        $gebruikerID = $db->lastInsertId();
    
        // Insert the data into the MoodRecord table
        $query = $db->prepare("INSERT INTO moodrecord (GebruikerID, Tijd, StemmingWaarde) VALUES (?, NOW(), ?)");
        $query->execute([$gebruikerID, $stem]);
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }

    // Redirect to the appropriate page based on the button that was clicked
    if ($stem == 1) {
        header('Location: pages/bevesteging_groen.html');
    } elseif ($stem == 2) {
        header('Location: pages/bevesteging_blauw.html');
    } elseif ($stem == 3) {
        header('Location: pages/bevesteging_rood.html');
    }
    exit;
}

?>
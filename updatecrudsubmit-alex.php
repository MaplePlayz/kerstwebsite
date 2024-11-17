<?php
require "dbconn.php";

// Haal waarden op uit het formulier
$naam = $_POST['naam'];
$gebruiker_id = (int)$_POST['gebruiker_id']; // Geselecteerde gebruiker ID
$minuten = $_POST['minuten'];
$id = $_POST['id'];

// Query om de naam van de gebruiker op te halen (dezelfde logica als in crudtoevoeg-alex.php)
$sqlGebruiker = "SELECT naam FROM Gebruikers WHERE id = :id";
$stmt = $conn->prepare($sqlGebruiker);
$stmt->execute(['id' => $gebruiker_id]);
$gebruiker = $stmt->fetch();

if ($gebruiker) {
    $gebruikersnaam = $gebruiker['naam']; // De naam van de geselecteerde gebruiker

    // Controleer of minuten geldig zijn
    if (!is_numeric($minuten) || $minuten < 0) {
        echo "<script type='text/javascript'>
            alert('Aantal mag niet in de min');
            window.history.back(); // Ga terug naar het formulier
          </script>";
    } else {
        // Update query met de naam van de gebruiker in de klas-kolom, in plaats van het ID
        $stmt = $conn->prepare("
            UPDATE student 
            SET naam = :naam, klas = :klas, minuten = :minuten 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);               // ID van de student
        $stmt->bindParam(':naam', $naam);           // Nieuwe productnaam
        $stmt->bindParam(':klas', $gebruikersnaam); // Naam van de gebruiker als klas
        $stmt->bindParam(':minuten', $minuten);     // Aantal minuten te laat
        $stmt->execute();

        header('Location: index.php');
    }
}
?>

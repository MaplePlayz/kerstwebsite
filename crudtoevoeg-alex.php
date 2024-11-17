<?php
include 'dbconn.php';

$naam = $_POST['naam'];
$gebruiker_id = (int)$_POST['gebruiker_id'];
$minuten = max(0, (int)$_POST['minuten']);

// Query om de naam van de gebruiker op te halen (voor consistentie in de Student-tabel)
$sqlGebruiker = "SELECT naam FROM Gebruikers WHERE id = :id";
$stmt = $conn->prepare($sqlGebruiker);
$stmt->execute(['id' => $gebruiker_id]);
$gebruiker = $stmt->fetch();

if ($gebruiker) {
    $gebruikersnaam = $gebruiker['naam'];

    // Toevoegen aan de Student-tabel zonder de 'id' kolom, omdat deze automatisch wordt gegenereerd
    $sql = "INSERT INTO Student (naam, klas, minuten) 
            VALUES (:naam, :klas, :minuten)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'naam' => $naam,
        'klas' => $gebruikersnaam, // de naam van de gebruiker als klas
        'minuten' => $minuten
    ]);
}

header("Location: index.php");
?>


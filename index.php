<link rel="stylesheet" href="crudfrontalex.css">  
<meta content="width=device-width, initial-scale=1" name="viewport" />
<?php  

include 'dbconn.php'; 

echo "<div class='table-header'>Kerst 2024</div>";

// Haal alle gebruikers op voor de filter
$gebruikersQuery = "SELECT id, naam FROM gebruikers";
$gebruikers = $conn->query($gebruikersQuery);

// Als een gebruiker geselecteerd is in het filter
$gebruiker_filter = isset($_GET['gebruiker']) ? $_GET['gebruiker'] : null;

// Zoekterm ophalen
$search_term = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%'; // Voeg % toe voor gedeeltelijke match

// Basis SQL-query
$studenten = "
    SELECT 
        student.naam AS product, 
        gebruikers.naam AS gebruiker_naam, 
        student.minuten, 
        student.id 
    FROM student 
    JOIN gebruikers ON student.klas = gebruikers.naam
";

// Als er een specifieke gebruiker is geselecteerd, voeg dan een WHERE-clausule toe
$where_clauses = [];
if ($gebruiker_filter) {
    $where_clauses[] = "gebruikers.id = :gebruiker_id";
}
$where_clauses[] = "student.naam LIKE :search_term"; // Voeg zoekterm toe

// Voeg de WHERE-clausules toe aan de query
if (count($where_clauses) > 0) {
    $studenten .= " WHERE " . implode(' AND ', $where_clauses);
}

// Bereid en voer de query uit
$stmt = $conn->prepare($studenten);
$stmt->bindParam(':search_term', $search_term); // Bind de zoekterm

// Bind de gebruiker_filter als het aanwezig is
if ($gebruiker_filter) {
    $stmt->bindParam(':gebruiker_id', $gebruiker_filter);
}

$stmt->execute();
$allestudenten = $stmt->fetchAll();

// Filterformulier weergeven
echo "<form method='GET' action=''>
    <label class='witte-tekst' for='gebruiker'>Filter: </label>
    <select name='gebruiker' id='gebruiker' onchange='this.form.submit()'>
        <option value=''>Alles</option>";

// Dropdown met gebruikers (klassen)
foreach ($gebruikers as $gebruiker) {
    $selected = ($gebruiker['id'] == $gebruiker_filter) ? 'selected' : '';
    echo "<option value='" . $gebruiker['id'] . "' $selected>" . $gebruiker['naam'] . "</option>";
}

echo "</select>";

// Zoekformulier voor productnaam
echo "<br><label class='witte-tekst' for='search'>Zoek op productnaam: </label>";
echo "<input type='text' name='search' id='search' value='" . ($_GET['search'] ?? '') . "'>";
echo "<button type='submit'>Zoeken</button>"; // Voeg een knop toe om te zoeken
echo "</form>";

// Links naar andere pagina's
$delete = 'cruddelete.php';
$toevoegen = 'crudchallengeform-alex.php';
$update = 'updatecrud-alex.php';

echo "<br><br><br>";
echo "<table class='studentTable'>";
echo "<tr class='table-header'>";
echo "<td>Product</td>";
echo "<td>Wie?</td>"; // Gekoppelde naam
echo "<td>Aantal</td>";
echo "<td>Acties</td>";
echo "</tr>";

// Lijst met studenten en gekoppelde gebruikers tonen
foreach ($allestudenten as $student) {
    echo "<tr>";
    echo "<td>" . $student['product'] . "</td>"; // Productnaam
    echo "<td>" . $student['gebruiker_naam'] . "</td>"; // Naam van de gebruiker
    echo "<td>" . $student['minuten'] . "</td>"; // Aantal minuten
    echo "<td>" . 
        "<a class='delete-link' href='$delete?id=" . $student['id'] . "'>verwijder</a>" . 
        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . 
        "<a class='update-link' href='$update?id=" . $student['id'] . "'>Wijzigen</a>" . 
        "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<br><br><a class='add-student-link' href='$toevoegen'>Nieuw product</a>";

?>

<!-- Snowflakes styling and animation -->
<style>

    .snowflake {
        color: #ffffff; /* Changed to black */
        font-size: 1em;
        font-family: Arial, sans-serif;
        text-shadow: 0 0 5px #fff; /* To maintain some visibility on darker backgrounds */
    }

    @-webkit-keyframes snowflakes-fall {
        0% { top: -10%; }
        100% { top: 100%; }
    }

    @-webkit-keyframes snowflakes-shake {
        0%, 100% { -webkit-transform: translateX(0); transform: translateX(0); }
        50% { -webkit-transform: translateX(80px); transform: translateX(80px); }
    }

    @keyframes snowflakes-fall {
        0% { top: -10%; }
        100% { top: 100%; }
    }

    @keyframes snowflakes-shake {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(80px); }
    }

    .snowflake {
        position: fixed;
        top: -10%;
        z-index: 9999;
        user-select: none;
        animation-name: snowflakes-fall, snowflakes-shake;
        animation-duration: 10s, 3s;
        animation-timing-function: linear, ease-in-out;
        animation-iteration-count: infinite, infinite;
    }

    .snowflake:nth-of-type(1) {
        left: 1%;
        animation-delay: 0s, 0s;
    }

    .snowflake:nth-of-type(2) {
        left: 10%;
        animation-delay: 1s, 1s;
    }

    .snowflake:nth-of-type(3) {
        left: 20%;
        animation-delay: 6s, .5s;
    }

    .snowflake:nth-of-type(4) {
        left: 30%;
        animation-delay: 4s, 2s;
    }

    .snowflake:nth-of-type(5) {
        left: 40%;
        animation-delay: 2s, 2s;
    }

    .snowflake:nth-of-type(6) {
        left: 50%;
        animation-delay: 8s, 3s;
    }

    .snowflake:nth-of-type(7) {
        left: 60%;
        animation-delay: 6s, 2s;
    }

    .snowflake:nth-of-type(8) {
        left: 70%;
        animation-delay: 2.5s, 1s;
    }

    .snowflake:nth-of-type(9) {
        left: 80%;
        animation-delay: 1s, 0s;
    }

    .snowflake:nth-of-type(10) {
        left: 90%;
        animation-delay: 3s, 1.5s;
    }

    .snowflake:nth-of-type(11) {
        left: 25%;
        animation-delay: 2s, 0s;
    }

</style>

<div class="snowflakes" aria-hidden="true">
    <div class="snowflake">❅</div>
    <div class="snowflake">❆</div>
    <div class="snowflake">❅</div>
    <div class="snowflake">❆</div>
    <div class="snowflake">❅</div>
    <div class="snowflake">❆</div>
    <div class="snowflake">❅</div>
    <div class="snowflake">❆</div>
    <div class="snowflake">❅</div>
    <div class="snowflake">❆</div>
    <div class="snowflake">❅</div>
    <div class="snowflake">❆</div>
</div>

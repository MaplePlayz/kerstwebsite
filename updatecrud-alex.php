<?php
include 'dbconn.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Query om de huidige studentgegevens op te halen
    $stmt = $conn->prepare('SELECT naam, klas, minuten, id FROM student WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        $naam = $result["naam"];
        $klas = $result["klas"];  // Dit is de naam van de gebruiker
        $minuten = $result["minuten"];
        $gebruiker_id = $result["id"]; // Dit is het student-id
    }
}

// Query om alle gebruikers op te halen
$gebruikersQuery = "SELECT id, naam FROM gebruikers";
$gebruikers = $conn->query($gebruikersQuery);
?>

<link rel="stylesheet" href="crudupdate.css"> 
<a href="index.php">
    <button type="button">Terug</button>
</a>

<form action="updatecrudsubmit-alex.php" method="post" class="form">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    Product: <input required type="text" name="naam" value="<?php echo $naam; ?>" class="form-input"> <br>

    Wie?: 
    <select name="gebruiker_id" class="form-input" required>
        <?php foreach ($gebruikers as $gebruiker): ?>
            <option value="<?php echo $gebruiker['id']; ?>" 
                <?php if ($gebruiker['naam'] == $klas) echo "selected"; ?> > <!-- Kijken of de naam overeenkomt met de klas -->
                <?php echo $gebruiker['naam']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Aantal: <input required type="text" name="minuten" value="<?php echo $minuten; ?>" class="form-input"> <br>

    <input type="submit" name="Toevoegen" value="Pas aan" class="form-submit">
</form>
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
<?php
include 'dbconn.php';

// Query om alle gebruikers op te halen
$sql = "SELECT id, naam FROM Gebruikers";
$result = $conn->query($sql);
?>
<a class="terugknop" href="index.php">
    <button type="button" class="back-btn">Terug</button>
</a>

<!-- Link naar de kerstthema CSS -->
<link rel="stylesheet" href="crudform.css">  

<form action="crudtoevoeg-alex.php" method="post" class="form">
    <label for="naam">Product:</label>
    <input type="text" name="naam" id="naam" class="form-input" required><br>
    <br>
    <label for="gebruiker_id">Wie?:</label>
    <select name="gebruiker_id" id="gebruiker_id" class="form-input" required>
        <option value="" disabled selected>Kies een gebruiker</option>
        <?php
        // Dynamisch opties genereren voor de dropdown
        foreach ($result as $row) {
            echo "<option value='{$row['id']}'>{$row['naam']}</option>";
        }
        ?>
    </select><br>
    <br>
    <label for="minuten">Aantal:</label>
    <input type="text" name="minuten" id="minuten" class="form-input" required><br>
    <br>
    <input type="submit" value="Toevoegen" class="form-submit">
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
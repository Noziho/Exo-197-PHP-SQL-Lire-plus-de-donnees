<?php
require __DIR__ . '/Config.php';
require __DIR__ . '/DB_Connect.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM clients");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $value) {
            foreach ($value as $key => $user) {
                echo $key . " => " . $user . "<br><br>";
            }
            echo "<hr>";
        }
    }
    ?>
</div>

<h2>Types de spétacles possibles:</h2>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM showtypes");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $value) {
            foreach ($value as $key => $type) {
                echo $key . " => " . $type . "<br><br>";
            }
            echo "<hr>";
        }
    }
    ?>
</div>

<h2>Les 20 premiers clients:</h2>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM clients WHERE id <= 20");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $value) {
            foreach ($value as $key => $type) {
                echo $key . " => " . $type . "<br><br>";
            }
            echo "<hr>";
        }
    }
    ?>
</div>

<h2>Les clients possédant une carte:</h2>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM clients WHERE card > 0");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $value) {
            foreach ($value as $key => $type) {
                echo $key . " => " . $type . "<br><br>";
            }
            echo "<hr>";
        }
    }
    ?>

</div>

<h2>Les clients ayant un nom et un prénom commençant par la lettre M:</h2>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("
            SELECT * FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC
        ");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $user) {

            echo "Nom: " . $user['lastName'] . "<br>";
            echo "Prenom: " . $user['firstName'] . "<br>";
            echo "<hr>";
        }
    }
    ?>
</div>

<h2>Titres de tous les spectacles + les artistes la date et l'heure:</h2>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM shows ORDER BY title ASC");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $value) {
            echo $value['title'] . " par " . $value['performer'] . " le " . $value['date'] . " à " . $value['startTime'];
            echo "<hr>";
        }
    }
    ?>

</div>

<h2>Affichage des clients comme demander:</h2>
<div>
    <?php
    $stmt = DB_Connect::dbConnect()->prepare("SELECT * FROM clients");

    if ($stmt->execute()) {
        foreach ($stmt->fetchAll() as $value) {
            echo "Nom: " . $value['lastName'] . "<br>";
            echo "Prénom: " . $value['firstName'] . "<br>";
            echo "Date de naissance: " . $value['birthDate'] . "<br>";
            if ($value['card'] == 1) {
                echo "Carte de fidélité: Oui." . "<br>";
                echo "Numéro de carte de fidélité: " . $value['cardNumber'] ."<br><br><hr>";
            }
            else {
                echo "Carte de fidélité: Non." ."<br><br>";
            }

        }
    }
    ?>

</div>

</body>
</html>

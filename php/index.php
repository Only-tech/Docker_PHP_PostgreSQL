<?php
require_once("connect.php");

$sql = "SELECT * FROM interns";

// Préparation de la requête
$query = $db->prepare($sql);

// Exécution de la requête
$query->execute();

// Récupération des données de la requête
$interns = $query->fetchAll(PDO::FETCH_ASSOC);

require("Disconnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Liste des stagiaires</h1>
    <pre><?php print_r($interns) ?></pre>
    <table>
        <thead>
            <th>id</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <!-- <?php
                    foreach ($interns as $intern) {
                        echo
                        "<tr>
                        <td>" . $intern['id'] . "</td>
                        <td>" . $intern['first_name'] . "</td>
                        <td>" . $intern['last_name'] . "</td>
                    </tr>";
                    }
                    ?> -->
            <?php foreach ($interns as $intern): ?>
                <tr>
                    <td><?= $intern['id'] ?></td>
                    <td><?= $intern['first_name'] ?></td>
                    <td><?= $intern['last_name'] ?></td>
                    <td>
                        <a href="intern.php?id=<?= $intern['id'] ?>">voir</a>
                        <a href="delete.php?id=<?= $intern['id'] ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a href="./add.php"><button>Ajouter un stagiaire</button></a>
    <?php echo "hello"; ?>
</body>

</html>
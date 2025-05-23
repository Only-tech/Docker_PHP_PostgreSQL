<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // nb : si !empty : pas NULL donc par défaut le isset est redondant s'il y'a un !empty

    require_once("connect.php");

    $id = $_GET['id'];
    print_r($id);

    $sql = "SELECT * FROM interns WHERE id= :id";

    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);

    $query->execute();

    $intern = $query->fetch();

    print_r($intern);

    require("disconnect.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ajout d'une condition d'affichage -->
    <?php
    if (isset($intern)):
    ?>
        <!-- si la condition est remplie, afficher le html ci-dessous -->

        <title>Only</title>
</head>

<body>
    <!-- <h1>Page de Only</h1>
    <p>Prénom : Only</p>
    <p>Nom : US</p> -->
    <h1>Page de <?= $intern['first_name'] ?></h1>
    <p>Prénom : <?= $intern['first_name'] ?></p>
    <p>Nom : <?= $intern['last_name'] ?></p>

<?php
    else:
?>
    <p>Votre stagiaire n'exite pas.</p>
<?php
    // fin de condition
    endif;
?>

<!-- Le "/" pour revenir au fichier superieur -->
<a href="/">Retour à la liste</a>
</body>

</html>
<?php
//  le fichier update.php va reprendre plusieurs bouts de code provenant des fichiers précédents 
//  bout de code php : infos stagiaire et $intern provient du fichier intern.php 
// Ne pas mettre de commentaire en ligne 1 ou avant <?php

// détecter si $_POST est présent (superglobale créée automatiquement qui récupère les données entrées dans les champs du formulaire si le formulaire est en méthode post) => est_ce que les données ont été envoyées, l'utilisateur a-t-il cliqué sur submit ?
if ($_POST) {

    if (!empty($_POST["first_name"]) && !empty($_POST["last_name"])) {
        // ici l'id passe par le formulaire $_POST et pas $_GET pour raisons de sécurité : au moment où les données sont envoyées, on a l'id qui va avec, de la même source, les données qui vont en BDD il vaut mieux qu'elles passent par le FORM plus sécurisé que le GET.
        $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
        $first_name = htmlspecialchars(strip_tags($_POST["first_name"]));
        $last_name = htmlspecialchars(strip_tags($_POST["last_name"]));

        require_once("connect.php");
        $sql = "UPDATE interns SET first_name = :first_name, last_name = :last_name WHERE id = :id;";
        $query = $db->prepare($sql);
        // rattacher les valeurs avec bindValue (valeur 1 : nom de ce qui est déclaré plus haut, valeur 2 : à quoi on la rattache, valeur 3 : quel type de données ça doit être)
        $query->bindValue(":id", $id, PDO::PARAM_INT);
        $query->bindValue("first_name", $first_name);
        $query->bindValue("last_name", $last_name);
        // execution de la requête
        $query->execute();
        // renvoyer l'utilisateur sur la page d'accueil
        header("Location: index.php");
    }
}


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

<!-- HTML provenant : copié de add.php changements-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Interns</title>
</head>

<body>
    <form method="post">
        <label for="first_name">prénom du stagiaire</label>
        <!-- on rajoute value au first_name et last_name, value écris directement dans le champ $intern ["nom_colonne"] = on insère ce qu'il y'a dans nom_colonne pour ce stagiaire avec cette id (cf requête plus haut) -->
        <input type="text" name="first_name" id="first_name" value="<?= $intern["first_name"] ?>" required>
        <label for="last_name">nom du stagiaire</label>
        <input type="text" name="last_name" id="last_name" value="<?= $intern["last_name"] ?>" required>
        <!-- input type hidden = champ caché. Maintenant il est lié au formulaire $_POST, ainsi l'utilisateur n'a rien à voir, on fait passer l'id dans le formulaire e -->
        <input type="hidden" name="id" value="<?= $intern["id"] ?>">
        <input type="submit" value="Modifier">
        <!-- ou mettre un bouton -->
        <!-- <button type="submit"></button> -->
    </form>
    <a href="/index.php">Retour à la liste</a>
</body>

</html>
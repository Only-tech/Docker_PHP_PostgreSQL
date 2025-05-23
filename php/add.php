<?php
if ($_POST) {
    // on rajoute un if dans le if = on verifie que tous les champs du formulure sont bien remplis avant d'executer la fonction, cela evite qu'on contourne le required
    if (
        isset($_POST["first_name"])
        && isset($_POST["last_name"])
        // isset : est présent même si vide, empty oblige à inserrer du contenu
        && !empty($_POST["first_name"])
        && !empty($_POST["last_name"])
    ) {

        // le print_r empêche le retour à une autre page. Il utilise le header, si on met dans une page un header et un print_r ALORS ERREUR
        // print_r($_POST);

        // nb: strip tags fonction de nettoyage qui enlève les balises html et php des strings donc protège contre l'intrusion dans les ...
        $first_name = strip_tags($_POST["first_name"]);
        $last_name = strip_tags($_POST["last_name"]);
        require_once("connect.php");
        $sql = "INSERT INTO interns (first_name, last_name) VALUES (:first_name, :last_name);";
        $query = $db->prepare($sql);
        $query->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $query->bindValue(":last_name", $last_name, PDO::PARAM_STR);
        $query->execute();
        require("disconnect.php");
        // renvoyer l'utilisateur sur la page d'accueil
        header("Location: index.php");
        // Pour terminer toute execution du script
        // exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <label for="first_name">prénom du stagiaire</label>
        <input type="text" name="first_name" id="first_name" required>
        <label for="last_name">nom du stagiaire</label>
        <input type="text" name="last_name" id="last_name" required>
        <input type="submit" value="ajouter">
        <!-- ou mettre un bouton -->
        <!-- <button type="submit"></button> -->
    </form>
    <a href="/index.php">Retour à la liste</a>
</body>

</html>
<?php

if (!empty($_GET['id'])) {
    require_once("connect.php");
    // definition de $id pour stocker la valeur récupérée dans l'url + nettoyage en faisant passer GET_id dans fonction filter_var; INT = entier(nombre)
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

    $sql = "DELETE FROM interns WHERE id = :id;";
    $query = $db->prepare($sql);
    // si : xxx il est néccessaire de lier la valeur souhaitée à l'id (param 1 = utilisé dans la requête; param2 = valeur qu'on lui attribue et qui doit avoir été définie et exister; param3 = type de valeur)
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    require("disconnect.php");
    // revenir à la page d'accueil
    header("Location: index.php");
}

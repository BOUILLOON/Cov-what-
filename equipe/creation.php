<?php

session_start();
require "../config.php";

if (!isset($_SESSION["nom"])) {
    header("Location: index.php");
    exit();
}
$nom = $_SESSION["nom"];

if (isset($_SESSION["id_etudiant"])) {
    $nom_etudiant = $_SESSION["nom"];

    echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, ' .
        $nom .
        "</div>";
}

?>

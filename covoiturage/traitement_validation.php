<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

if (isset($_POST["valider"])) { // Vérifie si le formulaire a été soumis avec un bouton nommé "valider".
    $nom_emetteur = $_POST["nom_emetteur"]; // Récupère le nom de l'émetteur à partir de la requête POST.

    header("Location: ../passager/passager.php"); // Redirige vers la page d'accueil des passagers après validation.
    exit(); // Arrête l'exécution du script.
} else {
    header("Location: ../disponible.php"); // Redirige vers une autre page si le formulaire n'a pas été soumis avec le bouton "valider".
    exit(); // Arrête l'exécution du script.
}
?>

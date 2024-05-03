<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

if (isset($_POST["nom_etudiant"])) { // Vérifie si le nom de l'étudiant est défini dans la requête POST.
    $nom_etudiant = $_POST["nom_etudiant"]; // Récupère le nom de l'étudiant à partir de la requête POST.
} else {
    header("Location: ../conducteur/conducteur.php"); // Redirige vers la page des conducteurs si le nom de l'étudiant n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

if (isset($_POST["personne"]) && is_array($_POST["personne"])) { // Vérifie si des conducteurs ont été sélectionnés et si c'est un tableau.
    $sql_reset_emetteur =
        "UPDATE etudiant SET nom_emetteur = NULL, etudiant_emetteur = NULL"; // Réinitialise les émetteurs précédents.
    $conn->query($sql_reset_emetteur); // Exécute la requête pour réinitialiser les émetteurs précédents.

    foreach ($_POST["personne"] as $personne_id) { // Parcourt chaque conducteur sélectionné.
        $sql_insert_proposition = "UPDATE etudiant SET nom_emetteur = '$nom_etudiant' WHERE id_etudiant = '$personne_id'"; // Met à jour le champ "nom_emetteur" avec le nom de l'étudiant actuel pour chaque conducteur sélectionné.
        $conn->query($sql_insert_proposition); // Exécute la requête pour mettre à jour le champ "nom_emetteur".
    }
}

header("Location: ../conducteur/conducteur.php"); // Redirige vers la page des conducteurs après avoir traité les sélections.
exit(); // Arrête l'exécution du script.
?>

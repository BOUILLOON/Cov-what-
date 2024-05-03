<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérifie si la méthode de requête est POST.
    echo "Demande envoyée avec succès!"; // Affiche un message indiquant que la demande a été envoyée avec succès.
    echo "<br><br><a href='../passager/passager.php'><button>Retour à la page d'accueil</button></a>"; // Affiche un lien pour retourner à la page d'accueil des passagers.
    exit(); // Arrête l'exécution du script.
}
?>

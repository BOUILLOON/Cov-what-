<?php

// Démarre une session PHP pour gérer les variables de session
session_start();

// Inclusion du fichier de configuration
require ('./../config.php');

// Vérifie si le nom de l'utilisateur est défini dans la session
if (!isset($_SESSION["nom"]))
{
    // Redirige vers la page de connexion si le nom n'est pas défini
    header("Location: login/login.php");
    exit(); // Termine l'exécution du script après la redirection
}

// Stocke le nom de l'utilisateur dans une variable
$nom = $_SESSION["nom"];

// Vérifie si l'utilisateur est un étudiant (en vérifiant si une certaine clé de session est définie)
if (isset($_SESSION['id_etudiant']))
{
    // Si l'utilisateur est un étudiant, récupère son nom depuis la session
    $nom_etudiant = $_SESSION['nom'];

    // Affiche un message de bienvenue personnalisé pour l'étudiant
    echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, ' . $nom_etudiant . '</div>';
}

?>

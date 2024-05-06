<?php

session_start();

// Déconnexion de la session
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session actuelle

// Redirection vers la page de connexion
header("Location: ../login/login.php");
exit(); // Assure que le script s'arrête après la redirection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<?php

// Initialiser la session
session_start();
require('../config.php');
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["nom"])){
  header("Location: index.php");
  exit(); 
}
$nom = $_SESSION["nom"];
  
if (isset($_SESSION['id_etudiant'])) {
  $nom_etudiant = $_SESSION['nom']; // Récupérer le nom de l'étudiant depuis la session
  // Afficher le nom de l'étudiant dans le coin supérieur droit
  echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, '.$nom_etudiant.'</div>';
}

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['nom'])) {
    // Si l'utilisateur est connecté, afficher le message et le bouton de déconnexion
    echo '<div style="text-align: center; margin-top: 50px;">';
    echo '<p>Si vous souhaitez changer de compte veuillez vous déconnecter !</p>';
    echo '<form action="logout.php" method="post">';
    echo '<input type="submit" name="logout" value="Déconnexion">';
    echo '</form>';
    echo '</div>';
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login/login.php");
    exit(); // Assure que le script s'arrête après la redirection
}
?>

</body>
</html>

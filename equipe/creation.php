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
      echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, '.$nom.'</div>';
  }
  
  ?>
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
    
  ?>
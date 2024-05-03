<?php
  
    session_start();
    require('../config.php');
    
    if(!isset($_SESSION["nom"])){
      header("Location: index.php");
      exit(); 
    }
    $nom = $_SESSION["nom"];
    
  ?>
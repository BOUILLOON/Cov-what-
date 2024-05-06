<?php
$localhost = "localhost";
$user = "root";
$pwd = "";
$database = "penguye2";
// Check connection
$conn = new mysqli($localhost, $user, $pwd, $database);
// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>

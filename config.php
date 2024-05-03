<?php
$localhost = "localhost";
$user = "root";
$pwd = "";
$database = "penguye2";

$conn = new mysqli($localhost, $user, $pwd, $database);

if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>

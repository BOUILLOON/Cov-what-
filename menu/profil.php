<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="profil.css">
  <title>Mon Profil</title>
  <style>
.button {
  display: inline-block;
  padding: 7px 12.5px;
  font-size: 12px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #81667A;
  border: none;
  border-radius: 6.5px;
  box-shadow: 0 4px #999;
}

.button:hover {background-color: #AA6DA3}

.button:active {
  background-color: #81667A;
  box-shadow: 0 2px #666;
  transform: translateY(4px);
}
</style>
</head>
<body>
<?php
session_start();
require "../config.php";

if (!isset($_SESSION["nom"])) {
    header("Location: ../index.php");
    exit();
}
$nom = $_SESSION["nom"];

if (isset($_SESSION["id_etudiant"])) {
    $nom_etudiant = $_SESSION["nom"];
    echo '<p style="position: absolute; top: 10px; right: 10px;">Bonjour, ' .
        $nom_etudiant .
        "</p>";
}
?>
<div style="display: none !important;"></div>
<div class="center">

  <?php
  $result1 = mysqli_query($conn, "SELECT * FROM etudiant WHERE nom='$nom'");
  $row1 = mysqli_fetch_assoc($result1);
  $prenom = $row1["prenom"];
  $id_etudiant = $row1["id_etudiant"];
  $adresse = $row1["adresse"];
  $ville = $row1["ville"];
  $code_postal = $row1["code_postal"];
  $telephone = $row1["telephone"];
  $email = $row1["email"];

  echo "<h1>Profil de : " .
      $nom .
      "</h1>
  <h3>Informations personnelles</h3>
  <h4> Nom : " .
      $nom .
      ", Prénom :" .
      $prenom .
      "</h4>
  <h4>Identifiants : " .
      $id_etudiant .
      " </h4>
  <h4>Adresse : " .
      $adresse .
      " </h4>
  <h4>email : " .
      $email .
      " </h4>
  <h4>Telephone : " .
      $telephone .
      " </h4>";

  if (isset($_SESSION["id_vehicule"]) && is_numeric($_SESSION["id_vehicule"])) {
      $id_vehicule = $_SESSION["id_vehicule"];

      $result2 = mysqli_query(
          $conn,
          "SELECT * FROM vehicule WHERE id_vehicule ='$id_vehicule' "
      );
      $row2 = mysqli_fetch_assoc($result2);

      if ($row2) {
          $type = $row2["type"];
          $nb_place = $row2["nb_place"];
          $immatriculation = $row2["immatriculation"];
          $date_prochain_controle_technique =
              $row2["date_prochain_controle_technique"];
          $assurance = $row2["assurance"];

          echo "<h3>Informations sur votre voiture</h3>
          <h4>Immatriculation : " .
              $immatriculation .
              "</h4>
          <h4>Assurance : " .
              $assurance .
              "</h4>
          <h4>Contrôle technique : " .
              $date_prochain_controle_technique .
              "</h4>
          <h4>Nombre de place disponible : " .
              $nb_place .
              "</h4>";
      } else {
          echo "<p>Aucune information sur le véhicule n'a été trouvée.</p>";
      }
  }

  $id_travail = isset($row1["id_travail"]) ? $row1["id_travail"] : null;
  if ($id_travail) {
      $result4 = mysqli_query(
          $conn,
          "SELECT * FROM travail WHERE id_travail='$id_travail'"
      );
      $row4 = mysqli_fetch_assoc($result4);

      if ($row4) {
          $formation = $row4["formation"];
          $groupe = $row4["groupe"];
          $sous_groupe = $row4["sous_groupe"];
          $promotion = $row4["promotion"];

          echo "<h3>Informations universitaires</h3>
            <h4>Formation : " .
              $formation .
              "</h4>
            <h4>Groupe : " .
              $groupe .
              "</h4>
            <h4>Sous-groupe : " .
              $sous_groupe .
              "</h4>
            <h4>Promotion : " .
              $promotion .
              "</h4>";
      } else {
          echo "<p>Aucune information sur la formation n'a été trouvée.</p>";
      }
  } else {
      echo "<p>Aucune information sur la formation n'a été trouvée.</p>";
  }
  ?>
  
</div>
</body>
</html>

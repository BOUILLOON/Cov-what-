<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <!-- Inclusion de la feuille de style profil.css -->
  <link rel="stylesheet" href="profil.css">
  <title>Mon Profil</title>
  <!-- Styles CSS spécifiques pour les boutons -->
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
// Démarrage de la session PHP
session_start();
// Inclusion du fichier de configuration
require "../config.php";

// Vérification si le nom de l'utilisateur est défini dans la session
if (!isset($_SESSION["nom"])) {
  // Redirection vers la page d'accueil si l'utilisateur n'est pas connecté
  header("Location: ../index.php");
  exit();
}
// Récupération du nom de l'utilisateur depuis la session
$nom = $_SESSION["nom"];

// Vérification si l'utilisateur est un étudiant
if (isset($_SESSION["id_etudiant"])) {
  // Si oui, récupération du nom de l'étudiant depuis la session et affichage d'un message de bienvenue
  $nom_etudiant = $_SESSION["nom"];
  echo '<p style="position: absolute; top: 10px; right: 10px;">Bonjour, ' . $nom_etudiant . "</p>";
}
?>
<div style="display: none !important;"></div>
<div class="center">

  <?php
  // Récupération des informations de l'étudiant depuis la base de données
  $result1 = mysqli_query($conn, "SELECT * FROM etudiant WHERE nom='$nom'");
  $row1 = mysqli_fetch_assoc($result1);
  $prenom = $row1["prenom"];
  $id_etudiant = $row1["id_etudiant"];
  $adresse = $row1["adresse"];
  $ville = $row1["ville"];
  $code_postal = $row1["code_postal"];
  $telephone = $row1["telephone"];
  $email = $row1["email"];

  // Affichage des informations personnelles de l'étudiant
  echo "<h1>Profil de : " . $nom . "</h1>
  <h3>Informations personnelles</h3>
  <h4> Nom : " . $nom . ", Prénom :" . $prenom . "</h4>
  <h4>Identifiants : " . $id_etudiant . " </h4>
  <h4>Adresse : " . $adresse . " </h4>
  <h4>email : " . $email . " </h4>
  <h4>Telephone : " . $telephone . " </h4>";

  // Vérification si l'utilisateur a un véhicule associé à son profil
  if (isset($_SESSION["id_vehicule"]) && is_numeric($_SESSION["id_vehicule"])) {
      $id_vehicule = $_SESSION["id_vehicule"];

      // Récupération des informations sur le véhicule depuis la base de données
      $result2 = mysqli_query($conn, "SELECT * FROM vehicule WHERE id_vehicule ='$id_vehicule' ");
      $row2 = mysqli_fetch_assoc($result2);

      if ($row2) {
          // Si des informations sur le véhicule sont trouvées, elles sont affichées
          $type = $row2["type"];
          $nb_place = $row2["nb_place"];
          $immatriculation = $row2["immatriculation"];
          $date_prochain_controle_technique = $row2["date_prochain_controle_technique"];
          $assurance = $row2["assurance"];

          echo "<h3>Informations sur votre voiture</h3>
          <h4>Immatriculation : " . $immatriculation . "</h4>
          <h4>Assurance : " . $assurance . "</h4>
          <h4>Contrôle technique : " . $date_prochain_controle_technique . "</h4>
          <h4>Nombre de place disponible : " . $nb_place . "</h4>";
      } else {
          echo "<p>Aucune information sur le véhicule n'a été trouvée.</p>";
      }
  }

  // Vérification si l'utilisateur a une formation universitaire associée à son profil
  $id_travail = isset($row1["id_travail"]) ? $row1["id_travail"] : null;
  if ($id_travail) {
      // Récupération des informations sur la formation depuis la base de données
      $result4 = mysqli_query($conn, "SELECT * FROM travail WHERE id_travail='$id_travail'");
      $row4 = mysqli_fetch_assoc($result4);

      if ($row4) {
          // Si des informations sur la formation sont trouvées, elles sont affichées
          $formation = $row4["formation"];
          $groupe = $row4["groupe"];
          $sous_groupe = $row4["sous_groupe"];
          $promotion = $row4["promotion"];

          echo "<h3>Informations universitaires</h3>
            <h4>Formation : " . $formation . "</h4>
            <h4>Groupe : " . $groupe . "</h4>
            <h4>Sous-groupe : " . $sous_groupe . "</h4>
            <h4>Promotion : " . $promotion . "</h4>";
      } else {
          echo "<p>Aucune information sur la formation n'a été trouvée.</p>";
      }
  } else {
      echo "<p>Aucune information sur la formation n'a été trouvée.</p>";
  }
  ?>
  
  <!-- Bouton pour rediriger vers la page de gestion des véhicules -->
  <a href="../menu/asvehicule.php"><button class="button">Ajouter ou supprimer un véhicule</button></a>
</div>
</body>
</html>

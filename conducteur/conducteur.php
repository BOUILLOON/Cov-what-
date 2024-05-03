<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <!-- Inclusion de la feuille de style conducteur.css -->
  <link href="conducteur.css" type="text/css" rel="stylesheet">
  <title>Accueil</title>
</head>
<body>
  <div class="banner">
    <nav class="navigation">
      <ul>
        <!-- Lien vers la page de connexion -->
        <li class="login"><a href="./../login/login.php">Login</a></li>
      </ul>
      <ul>
        <?php
        // Démarrage de la session PHP
        session_start();
        // Inclusion du fichier de configuration
        require "../config.php";

        // Vérification si le nom de l'utilisateur est défini dans la session
        if (isset($_SESSION["nom"])) {
          // Si oui, récupération du nom de l'utilisateur et affichage d'un message de bienvenue
          $nom_etudiant = $_SESSION["nom"];
          echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, ' . $nom_etudiant . "</div>";
        } else {
          // Si le nom n'est pas défini dans la session, redirection vers la page de connexion
          header("Location: login/login.php");
          exit(); // Arrêt de l'exécution du script après la redirection
        }
        ?>
        <!-- Menu pour l'utilisateur connecté -->
        <li class="#">
          <!-- Affichage du nom de l'utilisateur connecté dans le menu -->
          <a href="">Menu <?php /* echo $_SESSION["nom"]; */ ?></a>
          <ul class="submenu">
            <!-- Liens vers différentes fonctionnalités du profil conducteur -->
            <li><a href="profilconducteur.php">Mon profil</a></li>
            <li><a href="./../menu/changementmdp.php">Changer de mot de passe</a></li>
            <li><a href="./../menu/switchcompte.php">Changer de compte</a></li>
          </ul>
        </li>
        <!-- Menu pour la gestion de l'équipe -->
        <li><a href="#" aria-haspopup="true">Equipe</a>
          <ul class="dropdown" aria-label="submenu">
            <li><a href="./../equipe/menuequipe.php">Mon équipe </a></li>
            <li><a href="./../equipe/liste.php">Affichage des équipes</a></li>
            <li><a href="./../equipe/gestion.php">Gestion d'équipe</a></li>
          </ul>
        </li>
        <!-- Menu pour les fonctionnalités de covoiturage -->
        <li><a href="#" aria-haspopup="true">Covoiturage</a>
          <ul class="dropdown" aria-label="submenu">
            <li><a href="./../covoiturage/proposition.php">Proposition </a></li>
            <li><a href="./../covoiturage/disponible2.php">Disponible</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
  <div class="contenu">
    <h1>Covo'whats?</h1>
    <h3>I hope you didn't drink too much..</h3>
  </div>
</body>
</html>

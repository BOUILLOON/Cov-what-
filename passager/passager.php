<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="passager.css" type="text/css" rel="stylesheet">
    <title>Acceuil</title>
  </head>
  <body>
    <div class="banner">
      <nav class="navigation">
        <ul>
          <li class="login"><a href="./../login/login.php">Login</a></li>
        </ul>
				<ul>
        <?php
   
   // Initialiser la session
   session_start();
   require('../config.php');
   // Vérifier si l'utilisateur est connecté
   if (isset($_SESSION['nom'])) {
       // Si l'utilisateur est connecté, afficher le nom de l'utilisateur dans le coin supérieur droit
       $nom_etudiant = $_SESSION['nom']; // Récupérer le nom de l'étudiant depuis la session
       echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, '.$nom_etudiant.'</div>';
   } else {
       // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
       header("Location: login/login.php");
       exit(); // Assure que le script s'arrête après la redirection
   }
   ?>
      <?php 
      /*
      $nom = $_SESSION['nom'];
      if($nom == "admin"){
      echo 
      "<li class=\"menu\"><a href=\"#\"> Insertion csv </a>
				<ul class=\"submenu\">
					<li><a href=\"https://rt-projet.pu-pm.univ-fcomte.fr/~nrandri2/sae23fin/csvphp/comptecsv.php\">Compte</a></li>
          <li><a href=\"https://rt-projet.pu-pm.univ-fcomte.fr/~nrandri2/sae23fin/csvphp/dispvehiculecsv.php\">Disponibilité véhicule</a></li>
					<li><a href=\"https://rt-projet.pu-pm.univ-fcomte.fr/~nrandri2/sae23fin/csvphp/edtcsv.php\">Emploi du temps</a></li>
          <li><a href=\"https://rt-projet.pu-pm.univ-fcomte.fr/~nrandri2/sae23fin/csvphp/etudiantcsv.php\">Etudiant</a></li>
          <li><a href=\"https://rt-projet.pu-pm.univ-fcomte.fr/~nrandri2/sae23fin/csvphp/vehiculecsv.php\">Vehicule</a></li>
				</ul>
			</li>";
      }
      */
      ?>
      
			<li class="#"><a href="">Menu  <?php /* echo  $_SESSION["nom"] ; */ ?></a>
				<ul class="submenu">
					<li><a href="./../menu/profil.php">Mon profil</a></li>
          <li><a href="./../menu/changementmdp.php">Changer de mot de passe</a></li>
					<li><a href="./../menu/switchcompte.php">Changer de compte</a></li>
				</ul>
			</li>
			<li><a href="equipe" aria-haspopup="true">Equipe</a>
				<ul class="dropdown" aria-label="submenu">
					<li><a href="./../equipe/menuequipe.php">Mes  équipes </a></li>
					<li><a href="./../equipe/liste.php">Affichage des équipes</a></li> 
					
				</ul>
			</li>
      <li><a href="#" aria-haspopup="true">Covoiturage</a>
				<ul class="dropdown" aria-label="submenu">
					<li><a href= "./../covoiturage/disponible.php">Disponible</a></li>
          <li><a href="./../covoiturage/proposition2.php">Proposition </a></li>
				</ul>  
			</li>
		</ul>
      </nav>
    </div>
    <div class="contenu">
      <h1 >Covo'whats?</h1>
      <h3>Don't worry he didn't drink.. I guess</h3>
    </div>
  </body>
</html>

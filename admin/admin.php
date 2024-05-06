<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="accueil.css">
    <title>Accueil</title>
  </head>
  <body>
    <div class="banner">
      <nav class="navigation">
        <ul>
          <li class="login"><a href="./login/login.php">Login</a></li>
        </ul>
        <?php
   
   // Initialiser la session
   session_start();
   require('./../config.php');
   // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
   if(!isset($_SESSION["nom"])){
     header("Location: login/login.php");
     exit(); 
   }
   $nom = $_SESSION["nom"];

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_etudiant'])) {
    $nom_etudiant = $_SESSION['nom']; // Récupérer le nom de l'étudiant depuis la session
    // Afficher le nom de l'étudiant dans le coin supérieur droit
    echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, '.$nom_etudiant.'</div>';
}

 ?>
      <?php 
      
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
      
      ?>
          <li><a href="#">Menu <?php /* echo  $_SESSION["nom"] ; */ ?></a>
            <ul class="submenu">
              <li><a href="./menu/profil.php">Mon profil</a></li>
              <li><a href="./menu/changementmdp.php">Changer de mot de passe</a></li>
              <li><a href="./menu/switchcompte.php">Changer de compte</a></li>
            </ul>
          </li>
          <li><a href="equipe" aria-haspopup="true">Equipe</a>
            <ul class="dropdown" aria-label="submenu">
              <li><a href="./equipe/menuequipe.php">Mes équipes</a></li>
              <li><a href="./equipe/creation.php">Créer une équipe</a></li>
              <li><a href="./equipe/liste.php">Affichage des équipes</a></li> 
              <li><a href="./equipe/gestion.php">Gestion d'équipe</a></li>
            </ul>
          </li>
          <li><a href="#" aria-haspopup="true">Covoiturage</a>
            <ul class="dropdown" aria-label="submenu">
              <li><a href="./covoiturage/proposition.php">Proposition</a></li>
              <li><a href="./covoiturage/disponible.php">Disponible</a></li>
            </ul>  
          </li>
        </ul>
      </nav>
    </div>
    <div class="contenu">
      <h1>Cov'whats?</h1>
      <h3>Accueil</h3>
    </div>     

		
    <div class="contenu">
      <h1 >Covo'whats?</h1>
      <h3>Teste</h3>
    </div>
  </body>
</html>

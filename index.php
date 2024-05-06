<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="SAE23/image/RT.png"/>
    <link rel="stylesheet" href="accueil.css">
    <title>Accueil</title>
  </head>
  <body>
    <div class="banner">
      <nav class="navigation">
        <ul>
          <?php
          // Vérifier si l'utilisateur est connecté
          session_start();
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
          <li><a href="./login/login.php">Login</a></li>
        </ul>
        <ul>
          <?php 
          // Générer chaque élément du menu
          $menu_items = [
            ["text" => "Menu", "submenu" => [
                ["text" => "Mon profil", "link" => "./menu/profil.php"],
                ["text" => "Changer de mot de passe", "link" => "./menu/changementmdp.php"],
                ["text" => "Changer de compte", "link" => "./menu/switchcompte.php"],
                ["text" => "Menu vehicule", "link" => "./menu/asvehicule.php"]
            ]]
        ];
        
        foreach ($menu_items as $item) {
            echo '<li>';
            echo '<a href="#">' . $item['text'] . '</a>';
            echo '<ul class="submenu">';
            foreach ($item['submenu'] as $subitem) {
                echo '<li><a href="' . (isset($_SESSION['nom']) ? $subitem['link'] : 'login/login.php') . '">' . $subitem['text'] . '</a></li>';
            }
            echo '</ul>';
            echo '</li>';
        }
        
          ?>

			<li><a href="equipe" aria-haspopup="true">Equipe</a>
				<ul class="dropdown" aria-label="submenu">
					<li><a href="equipe/menuequipe.php">Mon  équipe </a></li>
          <li><a href="equipe/gestion.php">Gestion d'équipe</a></li>
					
				</ul>
			</li>
      <li><a href="#" aria-haspopup="true">Covoiturage</a>
				<ul class="dropdown" aria-label="submenu">
					<li><a href="covoiturage/proposition.php">Proposition </a></li>
          <li><a href= "covoiturage/disponible.php">Disponible</a></li>
				</ul>  
			</li>
		</ul>
      </nav>
    </div>
    <div class="contenu">
      <h1 >Covo'whats?</h1>
      <h3>I hope you didn't drink too much..</h3>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        session_start(); 
        require('../config.php'); 
        // Vérif si l'users est connect, sinn redirg vers page de connexion 
        if(!isset($_SESSION['nom'])) { 
            header("Location : ../login.php"); 
            exit; 
        }

        if (isset($_SESSION['id_etudiant'])) {
            $nom_etudiant = $_SESSION['nom']; // Récupérer le nom de l'étudiant depuis la session
            // Afficher le nom de l'étudiant dans le coin supérieur droit
            echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, '.$nom_etudiant.'</div>';
        }
        
        // Requête SQL pour sélectionner les étudiants n'ayant pas d'ID de véhicule
        $sql = "SELECT * FROM etudiant WHERE id_etudiant IS NOT NULL AND id_etudiant REGEXP '^[0-9]+$' AND id_vehicule IS NULL";
        $result = $conn->query($sql);

        // Vérification s'il y a des résultats
        if ($result->num_rows > 0) {
            // Affichage des données ligne par ligne
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id_etudiant"]. " - Nom: " . $row["nom"]. " - Prénom: " . $row["prenom"];

                echo "<br>";
                // Ajoutez d'autres champs ici si nécessaire
            }
        } else {
            echo "0 résultats"; 
        }
    
        // Fermeture de la connexion
        $conn->close();
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
					
				</ul>
			</li>
      <li><a href="#" aria-haspopup="true">Covoiturage</a>
				<ul class="dropdown" aria-label="submenu">
        <li><a href="./../covoiturage/proposition.php">Proposition </a></li>
					<li><a href= "./../covoiturage/disponible.php">Disponible</a></li>
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

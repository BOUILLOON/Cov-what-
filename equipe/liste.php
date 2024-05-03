<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        session_start(); // Démarre une nouvelle session ou reprend une session existante.
        require('../config.php'); // Inclut le fichier de configuration contenant la connexion à la base de données.

        if(!isset($_SESSION['nom'])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
            header("Location : ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
            exit; // Arrête l'exécution du script.
        }

        if (isset($_SESSION['id_etudiant'])) { // Vérifie si l'identifiant de l'étudiant est défini dans la session.
            $nom_etudiant = $_SESSION['nom']; // Récupère le nom de l'étudiant à partir de la session.
            echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, '.$nom_etudiant.'</div>'; // Affiche un message de bienvenue avec le nom de l'étudiant.
        }
        
        $sql = "SELECT * FROM etudiant WHERE id_etudiant IS NOT NULL AND id_etudiant REGEXP '^[0-9]+$' AND id_vehicule IS NULL"; // Requête SQL pour sélectionner les étudiants sans véhicule enregistré.
        $result = $conn->query($sql); // Exécute la requête et stocke le résultat dans une variable.

        if ($result->num_rows > 0) { // Vérifie s'il y a des résultats dans la requête.
            while($row = $result->fetch_assoc()) { // Parcourt chaque ligne de résultat.
                echo "id: " . $row["id_etudiant"]. " - Nom: " . $row["nom"]. " - Prénom: " . $row["prenom"]; // Affiche les détails de chaque étudiant.

                echo "<br>"; // Ajoute un saut de ligne.
            }
        } else {
            echo "0 résultats"; // Affiche un message si aucun résultat n'est retourné par la requête.
        }
    
        $conn->close(); // Ferme la connexion à la base de données.
    ?>
</body>
</html>

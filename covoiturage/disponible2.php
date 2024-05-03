<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

$sql =
    "SELECT trajet.*, GROUP_CONCAT(etudiant.nom SEPARATOR ', ') AS noms_passagers
        FROM trajet
        LEFT JOIN etudiant ON trajet.passager1 = etudiant.id_etudiant 
                           OR trajet.passager2 = etudiant.id_etudiant 
                           OR trajet.passager3 = etudiant.id_etudiant 
                           OR trajet.passager4 = etudiant.id_etudiant 
                           OR trajet.passager5 = etudiant.id_etudiant 
                           OR trajet.passager6 = etudiant.id_etudiant 
                           OR trajet.passager7 = etudiant.id_etudiant 
                           OR trajet.passager8 = etudiant.id_etudiant 
                           OR trajet.passager9 = etudiant.id_etudiant 
        WHERE trajet.conducteur = '" .
    $_SESSION["nom"] .
    "'
        GROUP BY trajet.id_trajet"; // Requête pour récupérer les informations sur les trajets du conducteur actuel.

$result = $conn->query($sql); // Exécute la requête et stocke le résultat dans une variable.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes de covoiturage reçues</title>
</head>
<body>
    <h2>Demandes de covoiturage reçues :</h2>

    <?php if ($result->num_rows > 0) { // Vérifie s'il y a des résultats dans la requête.
        while ($row = $result->fetch_assoc()) { // Parcourt chaque ligne de résultat.
            echo "Trajet de " .
                $row["lieu_depart"] .
                " à " .
                $row["lieu_arrivee"]; // Affiche les détails du trajet.

            echo "<br>";
            echo "Passager : " . $row["nom_passager"]; // Affiche le nom du passager.

            echo "<form action='traitement_validation.php' method='post'>"; // Début du formulaire pour valider la demande de covoiturage.
            echo "<input type='hidden' name='id_trajet' value='" .
                $row["id_trajet"] .
                "'>"; // Champ caché contenant l'ID du trajet.
            echo "<button type='submit' name='valider'>Valider</button>"; // Bouton pour valider la demande.
            echo "</form>"; // Fin du formulaire.

            echo "<br>"; // Saut de ligne.
        }
    } else {
        echo "Aucune demande de covoiturage reçue."; // Affiche un message si aucune demande n'a été reçue.
    } ?>

</body>
</html>

<?php $conn->close(); // Ferme la connexion à la base de données à la fin du script.
?>

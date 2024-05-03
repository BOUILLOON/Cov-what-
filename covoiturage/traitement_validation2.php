<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

$sql =
    "SELECT etudiant.*, trajet.*
        FROM trajet
        INNER JOIN etudiant ON trajet.passager1 = etudiant.id_etudiant 
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
    "'"; // Sélectionne les trajets associés au conducteur actuel.

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

    <form action="traitement_validation.php" method="post"> <!-- Formulaire pour valider les demandes de covoiturage -->
        <?php if ($result->num_rows > 0) { // Vérifie s'il y a des résultats dans la requête.
            while ($row = $result->fetch_assoc()) { // Parcourt chaque ligne de résultat.
                echo "<input type='checkbox' name='demandes[]' value='" .
                    $row["id_trajet"] .
                    "'>"; // Affiche une case à cocher pour chaque demande de covoiturage.
                echo " Trajet de " .
                    $row["lieu_depart"] .
                    " à " .
                    $row["lieu_arrivee"] .
                    " avec " .
                    $row["nom"] .
                    " " .
                    $row["prenom"] .
                    "<br>"; // Affiche les détails du trajet et du passager associé.
            }
            echo "<button type='submit'>Valider</button>"; // Affiche un bouton pour valider les demandes.
        } else {
            echo "Aucune demande de covoiturage reçue."; // Affiche un message si aucune demande n'a été reçue.
        } ?>
    </form>

</body>
</html>

<?php $conn->close(); // Ferme la connexion à la base de données à la fin du script.
?>

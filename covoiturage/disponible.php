<?php
session_start();
require('../config.php');

if (!isset($_SESSION['nom'])) {
    header("Location: ../login.php");
    exit;
}
// Bouton de retour
echo '<a href="../index.php">Retour</a><br>';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rejoindre_trajet'])) {
    $nom_etudiant = $_SESSION['nom'];
    
    // Récupérer l'ID de l'étudiant à partir du nom
    $sql = "SELECT id_etudiant, id_vehicule FROM etudiant WHERE nom = '$nom_etudiant'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_etudiant = $row['id_etudiant'];
        $id_vehicule = $row['id_vehicule'];
    } else {
        echo "Erreur : Impossible de trouver l'étudiant dans la base de données.";
        exit;
    }

    $id_trajet = $_POST['id_trajet'];

    // Vérifier les colonnes passager possibles et rejoindre le premier disponible
    for ($i = 1; $i <= 5; $i++) {
        $passager_column = 'passager' . $i;
        $check_passager_sql = "SELECT $passager_column FROM trajet WHERE id_trajet = $id_trajet";
        $passager_result = $conn->query($check_passager_sql);
        $passager_row = $passager_result->fetch_assoc();

        // Si la colonne du passager est vide, rejoindre le trajet en mettant à jour cette colonne
        if (!$passager_row[$passager_column]) {
            // Si l'étudiant a un véhicule, le rajouter comme conducteur
            if ($id_vehicule) {
                $update_sql = "UPDATE trajet SET $passager_column = $id_etudiant, conducteur = $id_etudiant WHERE id_trajet = $id_trajet";
            } else {
                $update_sql = "UPDATE trajet SET $passager_column = $id_etudiant WHERE id_trajet = $id_trajet";
            }
            if ($conn->query($update_sql) === TRUE) {
                echo "Vous avez rejoint le trajet avec succès.";
            } else {
                echo "Erreur lors de la mise à jour du trajet : " . $conn->error;
            }
            break; // Sortir de la boucle une fois que le passager a été ajouté
        }
    }
}

// Sélectionner les trajets en fonction du statut de l'utilisateur (conducteur ou passager) et récupérer le nom du conducteur
$sql = "SELECT trajet.*, etudiant.nom AS conducteur_nom FROM trajet LEFT JOIN etudiant ON trajet.conducteur = etudiant.id_etudiant";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trajets disponibles</title>
</head>
<body>
    <h2>Trajets disponibles :</h2>

    <table>
        <tr>
            <th>Heure de départ</th>
            <th>Heure d'arrivée</th>
            <th>Lieu de départ</th>
            <th>Lieu d'arrivée</th>
            <th>Conducteur</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['date_heure_depart'] . "</td>";
                echo "<td>" . $row['date_heure_arrivee'] . "</td>";
                echo "<td>" . $row['lieu_depart'] . "</td>";
                echo "<td>" . $row['lieu_arrivee'] . "</td>";
                echo "<td>" . ($row['conducteur_nom'] ?? 'Aucun') . "</td>"; // Afficher le nom du conducteur ou "Aucun" s'il n'y en a pas
                echo "<td>";
                // Vérifier si un passager peut rejoindre ce trajet
                $passager_possible = false;
                for ($i = 1; $i <= 5; $i++) {
                    $passager_column = 'passager' . $i;
                    if (!$row[$passager_column]) {
                        $passager_possible = true;
                        break; // Sortir de la boucle si un passager peut rejoindre
                    }
                }
                // Afficher le bouton "Rejoindre le trajet" si un passager peut rejoindre
                if ($passager_possible) {
                    echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='post'>";
                    echo "<input type='hidden' name='id_trajet' value='" . $row['id_trajet'] . "'>";
                    echo "<button type='submit' name='rejoindre_trajet'>Rejoindre le trajet</button>";
                    echo "</form>";
                } else {
                    echo "Plus de places disponibles pour ce trajet.";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucun trajet disponible.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>

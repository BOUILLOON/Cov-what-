<?php
session_start();
require('../config.php');

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["nom"])) {
    header("Location: index.php");
    exit(); 
}
// Bouton de retour
echo '<a href="../index.php">Retour</a><br>';
// Récupérez le nom de l'étudiant actuellement connecté
$nom_etudiant = $_SESSION["nom"];

// Requête pour sélectionner l'ID de l'étudiant à partir de son nom
$sql_id_etudiant = "SELECT id_etudiant FROM etudiant WHERE nom = '$nom_etudiant'";
$result_id_etudiant = $conn->query($sql_id_etudiant);

// Vérifiez s'il y a des résultats
if ($result_id_etudiant->num_rows > 0) {
    // Récupérez l'ID de l'étudiant
    $row_id_etudiant = $result_id_etudiant->fetch_assoc();
    $id_etudiant = $row_id_etudiant["id_etudiant"];

    // Requête pour sélectionner les trajets où l'étudiant est conducteur ou passager
    $sql_trajets = "SELECT * FROM trajet WHERE conducteur = $id_etudiant OR passager1 = $id_etudiant OR passager2 = $id_etudiant OR passager3 = $id_etudiant OR passager4 = $id_etudiant OR passager5 = $id_etudiant OR passager6 = $id_etudiant OR passager7 = $id_etudiant OR passager8 = $id_etudiant OR passager9 = $id_etudiant";
    $result_trajets = $conn->query($sql_trajets);

    // Vérifiez s'il y a des résultats
    if ($result_trajets->num_rows > 0) {
        // Affichez les résultats
        while ($row_trajet = $result_trajets->fetch_assoc()) {
            echo "Date et heure de départ : " . $row_trajet["date_heure_depart"] . "<br>";
            echo "Date et heure de départ : " . $row_trajet["date_heure_arrivee"] . "<br>";
            echo "Lieu de départ : " . $row_trajet["lieu_depart"] . "<br>";
            echo "Lieu d'arrivée : " . $row_trajet["lieu_arrivee"] . "<br>";
            // Affichez d'autres détails du trajet selon vos besoins
            echo "<br>";
        }
    } else {
        echo "Aucun trajet trouvé pour cet étudiant.";
    }
} else {
    echo "Aucun étudiant trouvé avec ce nom.";
}

$conn->close();
?>

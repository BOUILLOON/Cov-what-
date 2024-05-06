<?php
session_start();
require('../config.php');

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["nom"])) {
    header("Location: index.php");
    exit(); 
}

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

    // Si la requête de suppression est envoyée
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer_trajet'])) {
        $id_trajet = $_POST['id_trajet'];
        
        // Requête pour supprimer le trajet
        $sql_supprimer_trajet = "DELETE FROM trajet WHERE id_trajet = $id_trajet AND conducteur = $id_etudiant";
        
        if ($conn->query($sql_supprimer_trajet) === TRUE) {
            echo "Trajet supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du trajet : " . $conn->error;
        }
    }

    // Bouton de retour
    echo '<a href="../index.php">Retour</a><br>';

    // Requête pour sélectionner les trajets où l'étudiant est conducteur
    $sql_trajets_conducteur = "SELECT * FROM trajet WHERE conducteur = $id_etudiant";
    $result_trajets_conducteur = $conn->query($sql_trajets_conducteur);

    // Afficher les trajets du conducteur
    if ($result_trajets_conducteur->num_rows > 0) {
        echo "<h2>Trajets auxquels vous participez en tant que conducteur :</h2>";
        while ($row_trajet_conducteur = $result_trajets_conducteur->fetch_assoc()) {
            echo "Date et heure de départ : " . $row_trajet_conducteur["date_heure_depart"] . "<br>";
            echo "Lieu de départ : " . $row_trajet_conducteur["lieu_depart"] . "<br>";
            echo "Lieu d'arrivée : " . $row_trajet_conducteur["lieu_arrivee"] . "<br>";
            // Option pour supprimer le trajet
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
            echo "<input type='hidden' name='id_trajet' value='" . $row_trajet_conducteur["id_trajet"] . "'>";
            echo "<button type='submit' name='supprimer_trajet'>Supprimer</button>";
            echo "</form>";
            echo "<br>";
        }
    } else {
        echo "Vous n'avez proposé aucun trajet.<br>";
    }

    // Requête pour sélectionner les trajets où l'étudiant est passager
    $sql_trajets_passager = "SELECT * FROM trajet WHERE passager1 = $id_etudiant OR passager2 = $id_etudiant OR passager3 = $id_etudiant OR passager4 = $id_etudiant OR passager5 = $id_etudiant OR passager6 = $id_etudiant OR passager7 = $id_etudiant OR passager8 = $id_etudiant OR passager9 = $id_etudiant";
    $result_trajets_passager = $conn->query($sql_trajets_passager);

    // Afficher les trajets où l'étudiant est passager
    if ($result_trajets_passager->num_rows > 0) {
        echo "<h2>Trajets auxquels vous participez en tant que passager :</h2>";
        while ($row_trajet_passager = $result_trajets_passager->fetch_assoc()) {
            echo "Date et heure de départ : " . $row_trajet_passager["date_heure_depart"] . "<br>";
            echo "Lieu de départ : " . $row_trajet_passager["lieu_depart"] . "<br>";
            echo "Lieu d'arrivée : " . $row_trajet_passager["lieu_arrivee"] . "<br>";
            echo "<br>";
        }
    } else {
        echo "Vous ne participez à aucun trajet en tant que passager. <br>";
    }
} else {
    echo "Aucun étudiant trouvé avec ce nom.<br>";
}

$conn->close();
?>

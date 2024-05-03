<?php
session_start();
require('../config.php');

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["nom"])) {
    header("Location: index.php");
    exit(); 
}

$nom_etudiant = $_SESSION["nom"]; // Récupérer le nom de l'étudiant depuis la session
$user_id = $_SESSION['nom']; // Récupérer l'ID de l'étudiant depuis la session


// Supprimer un véhicule
if(isset($_POST['supprimer_vehicule'])) {
    $id_vehicule= $_POST['id_vehicule'];
    $sql_supprimer_vehicule = "DELETE FROM vehicule WHERE id_vehicule = '$id_vehicule'";
    if ($conn->query($sql_supprimer_vehicule) === TRUE) {
        echo "Véhicule supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du véhicule : " . $conn->error;
    }
}

// Ajouter un véhicule
if(isset($_POST['ajouter_vehicule'])) {
    $type = $_POST['type'];
    $modele = $_POST['modele'];
    $nb_place = $_POST['nb_place'];
    $immatriculation = $_POST['immatriculation'];
    $assurance = $_POST['assurance'];
    $date_prochain_controle_technique = $_POST['date_prochain_controle_technique'];

    // Insérer le véhicule dans la table vehicule
    $sql_ajouter_vehicule = "INSERT INTO vehicule (type, modele, nb_place, immatriculation, assurance, date_prochain_controle_technique) 
                             VALUES ('$type', '$modele', '$nb_place', '$immatriculation', '$assurance', '$date_prochain_controle_technique')";

    if ($conn->query($sql_ajouter_vehicule) === TRUE) {
        echo "Véhicule ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du véhicule : " . $conn->error;
    }
}

// Récupérer les véhicules de l'étudiant connecté
$sql_vehicules = "SELECT * FROM vehicule 
JOIN etudiant
ON vehicule.id_etudiant = etudiant.id_etudiant
WHERE vehicule.id_etudiant = etudiant.id_etudiant";
$result_vehicules = $conn->query($sql_vehicules);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des véhicules</title>
</head>
<body>
    <h2>Gestion des véhicules :</h2>

    <h3>Mes véhicules :</h3>
    <?php
    if ($result_vehicules->num_rows > 0) {
        while ($row = $result_vehicules->fetch_assoc()) {
            echo "<p>Type: " . $row["type"] . " - Modèle: " . $row["modele"] . " - Immatriculation: " . $row["immatriculation"];
            echo "<form action='' method='post'>";
            echo "<button type='submit' name='supprimer_vehicule'>Supprimer</button>";
            echo "</form>";
            echo "</p>";
        }
    } else {
        echo "<p>Aucun véhicule trouvé.</p>";
    }
    ?>

    <h3>Ajouter un véhicule :</h3>
    <form action="" method="post">
        <label for="type">Type :</label>
        <input type="text" id="type" name="type" required><br><br>

        <label for="modele">Modèle :</label>
        <input type="text" id="modele" name="modele" required><br><br>

        <label for="nb_place">Nombre de places :</label>
        <input type="number" id="nb_place" name="nb_place" required><br><br>

        <label for="immatriculation">Immatriculation :</label>
        <input type="text" id="immatriculation" name="immatriculation" required><br><br>

        <label for="assurance">Assurance :</label>
        <input type="text" id="assurance" name="assurance" required><br><br>

        <label for="date_prochain_controle_technique">Date prochain contrôle technique :</label>
        <input type="text" id="date_prochain_controle_technique" name="date_prochain_controle_technique" required><br><br>

        <button type="submit" name="ajouter_vehicule">Ajouter le véhicule</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>

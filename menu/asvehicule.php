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

// Vérifiez si le formulaire d'ajout de véhicule a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter_vehicule'])) {
    // Récupérer l'ID de l'étudiant à partir de la session
    $nom_etudiant = $_SESSION["nom"];
    $sql_etudiant = "SELECT id_etudiant FROM etudiant WHERE nom = '$nom_etudiant'";
    $result_etudiant = $conn->query($sql_etudiant);

    if ($result_etudiant->num_rows > 0) {
        $row_etudiant = $result_etudiant->fetch_assoc();
        $id_etudiant = $row_etudiant['id_etudiant'];

        // Récupérer les données du formulaire
        $type = $_POST['type'];
        $modele = $_POST['modele'];
        $nb_place = $_POST['nb_place'];
        $immatriculation = $_POST['immatriculation'];
        $assurance = $_POST['assurance'];
        $date_prochain_controle_technique = $_POST['date_prochain_controle_technique'];

        // Insérer les données du véhicule dans la base de données
        $sql_ajouter_vehicule = "INSERT INTO vehicule (id_etudiant, type, modele, nb_place, immatriculation, assurance, date_prochain_controle_technique)
                                VALUES ('$id_etudiant', '$type', '$modele', '$nb_place', '$immatriculation', '$assurance', '$date_prochain_controle_technique')";
        if ($conn->query($sql_ajouter_vehicule) === TRUE) {
            echo "Votre véhicule a été ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du véhicule : " . $conn->error;
        }
    } else {
        echo "Erreur : Impossible de trouver l'étudiant dans la base de données.";
    }
}

// Vérifiez si le formulaire de suppression de véhicule a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer_vehicule'])) {
    // Récupérer l'ID du véhicule à supprimer à partir des données du formulaire
    $id_vehicule = $_POST['id_vehicule'];

    // Exécuter une requête SQL pour supprimer le véhicule correspondant dans la base de données
    $sql_supprimer_vehicule = "DELETE FROM vehicule WHERE id_vehicule = '$id_vehicule'";
    if ($conn->query($sql_supprimer_vehicule) === TRUE) {
        echo "Le véhicule a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du véhicule : " . $conn->error;
    }
}

// Afficher les véhicules possédés par l'utilisateur
$nom_etudiant = $_SESSION["nom"];
$sql_vehicules = "SELECT * FROM vehicule WHERE id_etudiant IN (SELECT id_etudiant FROM etudiant WHERE nom = '$nom_etudiant')";
$result_vehicules = $conn->query($sql_vehicules);

if ($result_vehicules->num_rows > 0) {
    echo "<h2>Vos véhicules :</h2>";
    while ($row_vehicule = $result_vehicules->fetch_assoc()) {
        echo "<p>Type : " . $row_vehicule['type'] . "</p>";
        echo "<p>Modèle : " . $row_vehicule['modele'] . "</p>";
        echo "<p>Nombre de places : " . $row_vehicule['nb_place'] . "</p>";
        echo "<p>Immatriculation : " . $row_vehicule['immatriculation'] . "</p>";
        echo "<p>Assurance : " . $row_vehicule['assurance'] . "</p>";
        echo "<p>Date prochain contrôle technique : " . $row_vehicule['date_prochain_controle_technique'] . "</p>";
        echo "<form action='" . $_SERVER["PHP_SELF"] . "' method='post'>";
        echo "<input type='hidden' name='id_vehicule' value='" . $row_vehicule['id_vehicule'] . "'>";
        echo "<button type='submit' name='supprimer_vehicule'>Supprimer ce véhicule</button>";
        echo "</form>";
    }
} else {
    echo "<p>Vous ne possédez aucun véhicule.</p>";
}

// Afficher le formulaire d'ajout de véhicule
?>
<h2>Ajouter un véhicule :</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="type">Type :</label>
    <input type="text" name="type" id="type" required><br><br>
    <label for="modele">Modèle :</label>
    <input type="text" name="modele" id="modele" required><br><br>
    <label for="nb_place">Nombre de places :</label>
    <input type="number" name="nb_place" id="nb_place" required><br><br>
    <label for="immatriculation">Immatriculation :</label>
    <input type="text" name="immatriculation" id="immatriculation" required><br><br>
    <label for="assurance">Assurance :</label>
    <input type="text" name="assurance" id="assurance" required><br><br>
    <label for="date_prochain_controle_technique">Date prochain contrôle technique :</label>
    <input type="text" name="date_prochain_controle_technique" id="date_prochain_controle_technique" required><br><br>
    <input type="submit" name="ajouter_vehicule" value="Ajouter votre véhicule">
</form>
<?php

$conn->close();
?>

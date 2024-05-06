<?php
session_start();
require('../config.php');

if (!isset($_SESSION['nom'])) {
    header("Location: ../login.php");
    exit;
}
// Bouton de retour
echo '<a href="../index.php">Retour</a><br>';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['envoyer_proposition'])) {
    $nom_etudiant = $_SESSION['nom'];
    
    // Récupérer l'ID de l'étudiant à partir du nom
    $sql = "SELECT id_etudiant FROM etudiant WHERE nom = '$nom_etudiant'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_etudiant = $row['id_etudiant'];
    } else {
        echo "Erreur : Impossible de trouver l'étudiant dans la base de données.";
        exit;
    }

    // Récupérer les données du formulaire
    $heure_depart = $_POST['heure_depart'];
    $heure_arrivee = $_POST['heure_arrivee'];
    $lieu_depart = $_POST['lieu_depart'];
    $lieu_arrivee = $_POST['lieu_arrivee'];

    // Vérifier si l'utilisateur propose en tant que conducteur ou passager
    if (isset($_POST['role']) && $_POST['role'] == 'conducteur') {
        // Insérer un nouveau trajet dans la base de données avec l'ID de l'étudiant comme conducteur
        $insert_sql = "INSERT INTO trajet (date_heure_depart, date_heure_arrivee, lieu_depart, lieu_arrivee, conducteur) VALUES ('$heure_depart', '$heure_arrivee', '$lieu_depart', '$lieu_arrivee', $id_etudiant)";
    } else {
        // Insérer un nouveau trajet dans la base de données avec l'ID de l'étudiant comme passager
        $insert_sql = "INSERT INTO trajet (date_heure_depart, date_heure_arrivee, lieu_depart, lieu_arrivee, passager1) VALUES ('$heure_depart', '$heure_arrivee', '$lieu_depart', '$lieu_arrivee', $id_etudiant)";
    }

    if ($conn->query($insert_sql) === TRUE) {
        echo "Trajet proposé avec succès.";
    } else {
        echo "Erreur lors de la proposition du trajet : " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposition de covoiturage</title>
</head>
<body>
    <h2>Proposition de covoiturage :</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="heure_depart">Heure de départ :</label>
        <input type="datetime-local" id="heure_depart" name="heure_depart" required><br><br>

        <label for="heure_arrivee">Heure d'arrivée :</label>
        <input type="datetime-local" id="heure_arrivee" name="heure_arrivee" required><br><br>

        <label for="lieu_depart">Lieu de départ :</label>
        <input type="text" id="lieu_depart" name="lieu_depart" required><br><br>

        <label for="lieu_arrivee">Lieu d'arrivée :</label>
        <input type="text" id="lieu_arrivee" name="lieu_arrivee" required><br><br>

        <label><input type="radio" name="role" value="conducteur" required> Conducteur</label>
        <label><input type="radio" name="role" value="passager" required> Passager</label><br><br>

        <button type="submit" name="envoyer_proposition">Envoyer</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>

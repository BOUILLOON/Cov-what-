<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérifie si la méthode de requête est POST.
    $horaire = $_POST["horaire"]; // Récupère la valeur du champ "horaire" envoyée via POST.

    $insert_sql = "INSERT INTO etudiant (date_proposition) VALUES ('$horaire')"; // Requête pour insérer l'horaire dans la base de données.
    if ($conn->query($insert_sql) === true) { // Exécute la requête et vérifie si elle s'est bien déroulée.
        echo "Horaire enregistré avec succès."; // Affiche un message si l'insertion est réussie.
    } else {
        echo "Erreur lors de l'enregistrement de l'horaire : " . $conn->error; // Affiche un message d'erreur si l'insertion échoue.
    }
}

$sql =
    "SELECT DISTINCT nom_emetteur, date_proposition FROM etudiant WHERE nom_emetteur IS NOT NULL"; // Requête pour sélectionner les propositions de covoiturage reçues.
$result = $conn->query($sql); // Exécute la requête et stocke le résultat dans une variable.
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propositions de covoiturage reçues</title>
</head>
<body>
    <h2>Propositions de covoiturage reçues :</h2>

    <?php if ($result->num_rows > 0) { // Vérifie s'il y a des résultats dans la requête.
        while ($row = $result->fetch_assoc()) { // Parcourt chaque ligne de résultat.
            echo "Proposition de covoiturage reçue de : " .
                $row["nom_emetteur"]; // Affiche le nom de l'émetteur de la proposition.

            $horaire_sql =
                "SELECT date_proposition FROM etudiant WHERE nom_emetteur = '" .
                $row["nom_emetteur"] .
                "'"; // Requête pour récupérer l'horaire proposé par l'émetteur.
            $horaire_result = $conn->query($horaire_sql); // Exécute la requête pour l'horaire.
            if ($horaire_result->num_rows > 0) { // Vérifie s'il y a des résultats pour l'horaire.
                $horaire_row = $horaire_result->fetch_assoc(); // Récupère la ligne de résultat.
                echo "<br>Horaire proposé : " .
                    $horaire_row["date_proposition"]; // Affiche l'horaire proposé.
            } else {
                echo "<br>Horaire non disponible"; // Affiche un message si l'horaire n'est pas disponible.
            }
            echo "<form action='traitement_validation.php' method='post'>"; // Début du formulaire pour valider la proposition.
            echo "<input type='hidden' name='nom_emetteur' value='" .
                $row["nom_emetteur"] .
                "'>"; // Champ caché contenant le nom de l'émetteur.
            echo "<button type='submit' name='valider'>Valider</button>"; // Bouton pour valider la proposition.
            echo "</form>"; // Fin du formulaire.
            echo "<br>"; // Saut de ligne.
        }
    } else {
        echo "Aucune proposition de covoiturage reçue."; // Affiche un message si aucune proposition n'a été reçue.
    } ?>

</body>
</html>

<?php $conn->close(); // Ferme la connexion à la base de données à la fin du script.
?>

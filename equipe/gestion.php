<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: index.php"); // Redirige vers la page d'index si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

$nom = $_SESSION["nom"]; // Récupère le nom de l'utilisateur à partir de la session.

$sql_passagers =
    "SELECT id_etudiant, nom, prenom FROM etudiant WHERE nom_emetteur IS NOT NULL"; // Sélectionne les passagers associés au conducteur.
$result_passagers = $conn->query($sql_passagers); // Exécute la requête et stocke le résultat dans une variable.

if (
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["supprimer_passager"])
) { // Vérifie si le formulaire a été soumis avec un bouton nommé "supprimer_passager".
    if (isset($_POST["passagers"])) { // Vérifie si des passagers ont été sélectionnés pour la suppression.
        foreach ($_POST["passagers"] as $passager_id) { // Parcourt chaque passager sélectionné.
            $sql_suppression = "UPDATE etudiant SET nom_emetteur = NULL WHERE id_etudiant = $passager_id"; // Met à jour le champ "nom_emetteur" pour supprimer l'association du passager avec le conducteur.
            if ($conn->query($sql_suppression) === true) { // Exécute la requête de suppression.
                header("Location: gestion.php"); // Redirige vers la page de gestion après suppression.
                exit(); // Arrête l'exécution du script.
            } else {
                echo "Erreur lors de la suppression du passager: " .
                    $conn->error; // Affiche un message d'erreur en cas d'échec de la suppression.
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'équipe</title>
</head>
<body>
    <h2>Gestion de l'équipe de covoiturage :</h2>

    <?php if ($result_passagers->num_rows > 0) { // Vérifie s'il y a des passagers associés au conducteur.
        echo "<form action='' method='post'>"; // Démarre un formulaire pour la suppression des passagers.
        echo "<h3>Passagers dans votre voiture :</h3>";

        while ($row = $result_passagers->fetch_assoc()) { // Parcourt chaque passager associé au conducteur.
            echo "<input type='checkbox' name='passagers[]' value='" .
                $row["id_etudiant"] .
                "'>"; // Affiche une case à cocher pour chaque passager.
            echo " " . $row["nom"] . " " . $row["prenom"] . "<br>"; // Affiche le nom complet du passager.
        }
        echo "<br><button type='submit' name='supprimer_passager'>Supprimer le passager</button>"; // Affiche un bouton pour supprimer les passagers sélectionnés.
        echo "</form>";
    } else {
        echo "<p>Aucun passager dans votre voiture.</p>"; // Affiche un message si aucun passager n'est associé au conducteur.
    } ?>
</body>
</html>

<?php $conn->close(); // Ferme la connexion à la base de données à la fin du script.
?>

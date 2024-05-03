<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: index.php"); // Redirige vers la page d'index si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

$nom_etudiant = $_SESSION["nom"]; // Récupère le nom de l'utilisateur à partir de la session.

echo '<div style="position: absolute; top: 10px; right: 10px;">Bonjour, ' .
    $nom_etudiant .
    "</div>"; // Affiche un message de bienvenue avec le nom de l'utilisateur.

$user_id = $_SESSION["nom"]; // Récupère l'identifiant de l'utilisateur à partir de la session.

if (isset($_POST["se_retirer"])) { // Vérifie si le formulaire a été soumis avec un bouton nommé "se_retirer".
    $sql_supprimer_nom_emetteur = "UPDATE etudiant SET nom_emetteur = NULL WHERE nom = '$user_id'"; // Requête SQL pour retirer l'utilisateur de l'équipe en mettant à jour le champ "nom_emetteur" à NULL.
    if ($conn->query($sql_supprimer_nom_emetteur) === true) { // Exécute la requête de mise à jour.
        header("Location: ../passager/passager.php"); // Redirige vers la page des passagers après le retrait.
        exit(); // Arrête l'exécution du script.
    } else {
        echo "Erreur lors du retrait de l'équipe : " . $conn->error; // Affiche un message d'erreur en cas d'échec du retrait.
    }
}

$sql_passagers =
    "SELECT nom, prenom FROM etudiant WHERE nom_emetteur IS NOT NULL"; // Requête SQL pour sélectionner les passagers associés à l'utilisateur actuel.
$result_passagers = $conn->query($sql_passagers); // Exécute la requête et stocke le résultat dans une variable.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de l'équipe</title>
</head>
<body>
    <h2>Équipe de covoiturage :</h2>

    <?php if ($result_passagers->num_rows > 0) { // Vérifie s'il y a des passagers associés à l'utilisateur actuel.
        echo "<h3>Passagers en direction de l'IUT de Montbéliard :</h3>";
        while ($row = $result_passagers->fetch_assoc()) { // Parcourt chaque passager associé à l'utilisateur.
            echo "<p>Passager : " . $row["nom"] . " " . $row["prenom"] . "</p>"; // Affiche les détails de chaque passager.
        }
    } else {
        echo "<p>Aucun passager dans l'équipe.</p>"; // Affiche un message si aucun passager n'est associé à l'utilisateur actuel.
    } ?>

    <form action="" method="post">
        <button type="submit" name="se_retirer">Se retirer de l'équipe</button> <!-- Affiche un bouton pour permettre à l'utilisateur de se retirer de l'équipe. -->
    </form>
</body>
</html>

<?php $conn->close(); // Ferme la connexion à la base de données. ?>

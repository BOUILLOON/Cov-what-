<?php
session_start(); // Démarre une nouvelle session ou reprend une session existante.
require "../config.php"; // Inclut le fichier de configuration contenant la connexion à la base de données.

if (!isset($_SESSION["nom"])) { // Vérifie si le nom de l'utilisateur est défini dans la session.
    header("Location: ../login.php"); // Redirige vers la page de connexion si le nom n'est pas défini.
    exit(); // Arrête l'exécution du script.
}

$sql = "SELECT etudiant.*, travail.groupe, travail.sous_groupe 
        FROM etudiant 
        LEFT JOIN travail ON etudiant.id_travail = travail.id_travail 
        WHERE etudiant.id_vehicule IS NOT NULL AND etudiant.id_vehicule != ''"; // Sélectionne les conducteurs disponibles.
$result = $conn->query($sql); // Exécute la requête et stocke le résultat dans une variable.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposition de covoiturage</title>
</head>
<body>
    <h2>Sélectionnez les conducteurs disponibles pour la proposition de covoiturage :</h2>

    <form action="traitement_selection2.php" method="post">
        <label for="nom_etudiant">Votre nom :</label>
        <input type="text" id="nom_etudiant" name="nom_etudiant" required><br><br>
        <?php if ($result->num_rows > 0) { // Vérifie s'il y a des résultats dans la requête.
            while ($row = $result->fetch_assoc()) { // Parcourt chaque ligne de résultat.
                echo "<input type='checkbox' name='personne[]' value='" .
                    $row["id_etudiant"] .
                    "'>"; // Affiche une case à cocher pour chaque conducteur disponible.
                echo " Nom: " . $row["nom"] . " - Prénom: " . $row["prenom"]; // Affiche le nom et le prénom du conducteur.

                if ($row["groupe"] !== null && $row["sous_groupe"] !== null) {
                    echo " - Groupe: " .
                        $row["groupe"] .
                        " - Sous-groupe: " .
                        $row["sous_groupe"]; // Affiche le groupe et le sous-groupe du conducteur si définis.
                } else {
                    echo " - Groupe non défini"; // Affiche un message si le groupe n'est pas défini.
                }
                echo "<br>"; // Saut de ligne.
            }
            echo "<button type='submit'>Envoyer</button>"; // Affiche un bouton pour envoyer le formulaire.
        } else {
            echo "Aucun conducteur disponible pour la proposition de covoiturage."; // Affiche un message si aucun conducteur n'est disponible.
        } ?>
    </form>
</body>
</html>

<?php $conn->close(); // Ferme la connexion à la base de données à la fin du script.
?>

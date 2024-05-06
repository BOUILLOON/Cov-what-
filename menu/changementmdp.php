<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="">
    <title>Changer de mot de passe</title>
    <link rel="shortcut icon" href="changementmdp.css"/>
  </head>
  <body>
  <?php
require('../config.php'); // Chemin vers le fichier config.php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $changementmdp = $_POST['changementmdp'];
    $nchangementmdp = $_POST['nchangementmdp'];
    $rnchangementmdp = $_POST['rnchangementmdp'];
    $session = $_SESSION['nom'];

    if (empty($changementmdp) || empty($nchangementmdp) || empty($rnchangementmdp)) {
        $errors[] = "Veuillez remplir tous les champs.";
    } else {
        $results = mysqli_query($conn, "SELECT mot_de_passe FROM etudiant WHERE nom = '$session'");
        $row = mysqli_fetch_assoc($results);
        $rowval = $row['mot_de_passe']; // Correction : Utilisation de la colonne mot_de_passe

        if ($rowval !== $changementmdp) {
            $errors[] = "L'ancien mot de passe est incorrect.";
        }

        if ($nchangementmdp !== $rnchangementmdp) {
            $errors[] = "Les deux nouveaux mots de passe ne correspondent pas.";
        }

        if (empty($errors)) {
            $sql = "UPDATE etudiant SET mot_de_passe = ? WHERE nom = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nchangementmdp, $session);

            if ($stmt->execute()) {
                $success_message = "Le mot de passe a bien été changé.";
            } else {
                $errors[] = "Une erreur est survenue lors de la modification du mot de passe.";
            }
            $stmt->close();
        }
    }
}
?>

    <div class="center">
      <h1> Changer de mot de passe</h1>
    <form action="changementmdp.php" method="post">
      <div class="texte">
        <input type="password" name="changementmdp" required>
        <span></span>
        <label for="changementmdp">Ancien mot de passe</label>
      </div>
      <div class="texte">
        <input type="password" name="nchangementmdp" required>
        <span></span>
        <label for = "nchangementmdp">Nouveau mot de passe</label>
      </div>
      <div class="texte">
        <input type="password" name="rnchangementmdp"required>
        <span></span>
        <label for="rnchangementmdp " >Répétez le nouveau mot de passe</label>
      </div>
      <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        } elseif (isset($success_message)) {
            echo "<p>$success_message</p>";
        }
        ?>
    <input type="submit" value="Enregistrer"  onclick=window.location.href='../index.php'>
    <button type="button" name="button" onclick=window.location.href='../index.php'>Revenir à l'acceuil</button>
    </div>
    </form>
  </body>
</html>
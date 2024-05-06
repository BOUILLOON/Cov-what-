<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="login.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
      <h1> Veuillez vous connecter</h1>
      <form method="post">
        <div class="login-text">
          <button class="cta"><i class="fas fa-chevron-down fa-1x"></i></button>
          <div class="text">
            <a href="">Login</a>
            <hr>
            <br>
            <input type="text" name="nom" placeholder="Username" required>
            <br>
            <input type="password" name="mot_de_passe" placeholder="Password" required>
            <br>
            <button class="login-btn">Log In</button>
          </div>
        </div>
        <div class="call-text">
          <h1>Come do covoiturage<span>IUT</span></h1>
          <button>Join the Community</button> 
          <!-- redirection vers accueil-->
        </div>
      </div>
            <script>
            var cta = document.querySelector(".cta");
            var check = 0;
            
            cta.addEventListener('click', function(e){
                var text = e.target.nextElementSibling;
                var loginText = e.target.parentElement;
                text.classList.toggle('show-hide');
                loginText.classList.toggle('expand');
                if(check == 0)
                {
                    cta.innerHTML = "<i class=\"fas fa-chevron-up\"></i>";
                    check++;
                }
                else
                {
                    cta.innerHTML = "<i class=\"fas fa-chevron-down\"></i>";
                    check = 0;
                }
            })
        </script>
</body>
  <?php
          
          require('../config.php');
          session_start();
          if (isset($_POST['nom'])){
            $username = stripslashes($_REQUEST['nom']);
            $username = mysqli_real_escape_string($conn, $username);
            $password = stripslashes($_REQUEST['mot_de_passe']);
            $password = mysqli_real_escape_string($conn, $password);

            $query = "SELECT * FROM `etudiant` WHERE nom='$username' and mot_de_passe=\"$password\";";
            $result = mysqli_query($conn,$query) or die(mysql_error());
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
              $row = mysqli_fetch_assoc($result);
              $_SESSION['nom'] = $username;
      
              // Récupérer l'id_vehicule de l'étudiant
              $id_vehicule = $row['id_vehicule'];
      
              // Vérifier si l'id_vehicule est un entier et non NULL
              if (is_numeric($id_vehicule) && $id_vehicule !== NULL) {
                  header("Location: ../index.php"); // Rediriger vers conducteur.php si l'utilisateur est conducteur
              } else {
                  header("Location: ../index.php"); // Rediriger vers passager.php si l'utilisateur est passager
              }
          } else {
              if (!empty($_POST['nom'])) {
                  $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                  echo "<p>$message</p>";
              }
          }
      }
      ?> <!--
            /*
            if($rows==1){
                $_SESSION['nom'] = $username;
                header("Location: ../index.php");
            }else{
              if (!empty($_POST['nom'])){
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                echo "<p>$message</p>";
              }
            }
          }
    ?> 
<?php
/*
require('../config.php'); // Inclure le fichier de configuration pour la connexion à la base de données
session_start(); // Démarrer la session

if (isset($_POST['nom'])){
    $username = stripslashes($_REQUEST['nom']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['mot_de_passe']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `etudiant` WHERE nom='$username' and mot_de_passe='$password';";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    if ($rows == 1) { 
        // Authentification réussie, récupérer d'autres informations de l'utilisateur
        $user_info = mysqli_fetch_assoc($result);
        $_SESSION['id_etudiant'] = $user_info['id_etudiant'];

        header("Location: ../index.php");
        exit(); // Assure que le script s'arrête après la redirection
    } }
    
    if(isset($_SESSION['id_etudiant'])) {
        header("Location: ../index.php");
        exit();
    }
      }    // Stocker l'identifiant de l'utilisateur dans la session
        
        // Vérifier si l'id_vehicule est un entier
        $car_query = "SELECT * FROM `id_vehicule` WHERE id_etudiant = ".$_SESSION['id'];
        $car_result = mysqli_query($conn, $car_query);
        $car_rows = mysqli_num_rows($car_result);
        
        if($car_rows > 0){
            // Si l'utilisateur a un id_vehicule, le rediriger vers la page du chauffeur
            header("Location: conducteur.php");
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            // Sinon, rediriger l'utilisateur vers la page du passager
            header("Location: passager.php");
            exit(); // Arrêter l'exécution du script après la redirection
        }
    } else {
        // Si l'authentification échoue, afficher un message d'erreur
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        echo "<p>$message</p>";
    } 
}
*/
?>

<?php
/*
          require('../config.php'); // Inclure le fichier de configuration pour la connexion à la base de données
          session_start(); // Démarrer la session
          if (isset($_POST['nom'])){
            $username = stripslashes($_REQUEST['nom']);
            $username = mysqli_real_escape_string($conn, $username);
            $password = stripslashes($_REQUEST['mdp']);
            $password = mysqli_real_escape_string($conn, $password);
            $query = "SELECT * FROM `compte` WHERE nom='$username' and mdp='$password';";
            $result = mysqli_query($conn,$query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            $car_query = "SELECT * FROM `id_vehicule` WHERE id_etudiant = (SELECT idcompte FROM `compte` WHERE nom='$username')";
            $car_result = mysqli_query($conn, $car_query);
            $car_rows = mysqli_num_rows($car_result);

            if($car_rows > 0){
              
                header("Location: conducteur.php");
            } else {
                
                header("Location: passager.php");
            }
        } else {
            if (!empty($_POST['nom'])){
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                echo "<p>$message</p>";
            }
        }
        */
?>


</html>




<?php
/***** Script index: propose la connexion ou l'enregistrement sur le site
 * Call by : 
 */


?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style.css">
</head>

<body>

<!-- Affichage page de login -->
<div id="bandeau" class="bandeau">
    <H1 class="titre">Bienvenue sur la page de suivi GAI</H1>
</div>

<div class="formulaire">
<form name="login" method="post" action="index.php">

    <table>
        <tr>
            <td>Login :</td>
            <td><input type="text" id="userId" name="userId" size="7"></td>
        </tr>
        <tr>
            <td>Password :</td>
            <td><input type="password" id="password" name="password" size="7"></td>
        </tr>
        <tr>
            <td><input id="conn" type="submit" name="valider" value="Se connecter"></td>
            <td>
                <a href="register.php" target="_blank">
                <button id="register" class="favorite styled" type="button" >S'enregistrer</button></a>
            </td>
        </tr>
    </table> 

</div>

    <?php

    session_reset();

    include_once("connexion.php");

    //TEST DES ENTREES UTILISATEURS

    //variable que l'on définit à false par défaut= l'user et le password ne sont pas ok au départ puisqu'on à rien rentré
    $userOK = false;
    $passwordOK = false;
    //Test si l'utilisateur à bien rentré un identifiant, sinon, on lui dis "veuillez insérez un identifiant"
    if (isset($_POST['userId']))
    {   //Si l'user id n'est pas vide
        if(!empty($_POST['userId']))
        {
            session_start();
            //On stocke l'user id et le password dans une session (l°24-25 connexion)
            $_SESSION['userid_session'] = $_POST['userId'];
            $_SESSION['password_session'] = $_POST['password'];
            // tu tentes une connexion
            //include("connexion.php");
            Connexion();
            //je recupere les resultats
            $resultat = $_SESSION['resultat'];
            ?>
            <SCRIPT language="Javascript">
                 var affich_comment="<?php echo $resultat;?>";
                alert(affich_comment);</SCRIPT>
            <?php
            //Si jamais le resultat vaut changement de mot de passe requis (voir dans connexion.php l.135)
            if ($resultat == "Changement de mot de passe requis")
            {
                unset($_SESSION['resultat']);    
                header("Location: change_password.php");
            }   
        }
        else //Si l'utilisateur n'a pas entré d'identifiant
        {
            $resultat = "Veuillez insérer un identifiant"
            ?>
            <SCRIPT language="Javascript">
                var affich_comment="<?php echo $resultat;?>";
                alert(affich_comment);</SCRIPT>';
            <?php
        }
    }

 
  

    ?>


</form>




</body>
</html>
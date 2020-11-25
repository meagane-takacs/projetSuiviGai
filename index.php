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
    include_once("change_password.php");

       //----------------------------------------------------------------------------------------------------------
    // ------ CHANGEMENT DE MOT DE PASSE APRES LA PREMIERE CONNECTION AVEC LE MOT DE PASSE GENERE---------------
    //----------------------------------------------------------------------------------------------------------

    //Si on a cliquer sur changer le mot de passe
    if (isset($_POST['button_pass_change']))
    {
        ?><SCRIPT language="Javascript">
        var affich_comment="<?php echo 'test2';?>";							  
        alert(affich_comment);</SCRIPT>'; 	
    <?php 
        //Si le champ mot de passe à changer et le deuxieme mot de passe ne sont pas similaire
        if ( (!empty($_POST['password_change'])) && (!empty($_POST['password_chang2'])) )
        {
            if ( trim($_POST['password_change']) != trim($_POST['password_chang2']) )
            {
                $resultat = "Les mots de passe doivent être similaires";
                ?>           
                <SCRIPT language="Javascript">
                    var affich_comment="<?php echo $resultat;?>";							  
                    alert(affich_comment);</SCRIPT>'; 	
                <?php    
            }
        
        //Si les mots de passe sont similaires
            else
            {
                //On range dans une session les mots de passe et identifiant changé
                $_SESSION['identifiant'] = trim($_POST['identifiant_change']);
                $_SESSION['New_password'] = trim($_POST['password_change']); 
                //On apelle change password
                //include("change_password.php");
                ChangePassword();
                $resultat = $_SESSION['resultat'];
                //Si résultat = connection autorisé (change_password l °53)
                if ( $resultat = "Connection autorisé")
                {
                    //on tente une connexion    
                    $_SESSION['userid_session'] = trim($_POST['identifiant_change']);
                    $_SESSION['password_session'] = trim($_POST['password_change']);
                    //include("connexion.php");
                    Connexion();
                }
            }
        }
        else 
        {
            $resultat= "veuillez confirmer votre mot de passe"
            ?>           
            <SCRIPT language="Javascript">
                var affich_comment="<?php echo $resultat;?>";							  
                alert(affich_comment);</SCRIPT>'; 	
            <?php 
            exit();
        }
         
    }
    

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
                alert(affich_comment);</SCRIPT>';
            <?php
            //Si jamais le resultat vaut changement de mot de passe requit (voir dans connexion.php l.135)
            if ($resultat == "Changement de mot de passe requit")
            {?>
                <td><span class="label_change_pass">Entrer un Nouveau Password :</span></td>   
                <input type="text" id="identifiant_change" name="identifiant_change" class="identifiant_change" value="<?php echo $_POST['userId'];?>">
                <input type="password" id="password_change" name="password_change" class='password_change'>                      
                <input type="password" id="password_chang2" name="password_chang2" class='password_chang2'>
                <input type="submit" id="button_pass_change" name="button_pass_change" class="button_pass_change" value="Changer le mot de passe">
            <?php
            }
            unset($_SESSION['resultat']);
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
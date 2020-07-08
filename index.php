<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style.css">
</head>

<body>
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

    //variable que l'on définit à false par défaut= l'user et le password ne sont pas ok au départ puisqu'on à rien rentré
    $userOK = false;
    $passwordOK = false;

    if (isset($_POST['userId']))
    {
        if(!empty($_POST['userId']))
        {
            session_start();
            $_SESSION['userid_session'] = $_POST['userId'];
            $_SESSION['password_session'] = $_POST['password'];
            include("connexion.php");
            $resultat = $_SESSION['resultat'];
            ?>
            <SCRIPT language="Javascript">
                 var affich_comment="<?php echo $resultat;?>";
                alert(affich_comment);</SCRIPT>';
            <?php
            unset($_SESSION['resultat']);
        }
        else
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
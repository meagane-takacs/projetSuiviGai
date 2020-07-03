<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<H1>Bienvenue sur la page de suivi GAI</H1>

<form name="login" method="post" action="index.php">
    <p>Login : <input type="text" id="userId" name="userId"></p><br>
    <p>Password : <input type="password" id="password" name="password"></p><br>


    <input type="submit" name="valider" value="Se connecter">

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

<a href="register.php" target="_blank">
    <button class="favorite styled" type="button">
        S'enregistrer
    </button>
</a>


</body>
</html>
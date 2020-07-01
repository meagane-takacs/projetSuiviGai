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
    <p>Login : <input type="text" id="userid" name="userid"></p><br>
    <p>Password : <input type="password" id="password" name="password"></p><br>


    <input type="submit" name="valider" value="Se connecter">

    <?php

    $userOK = false;
    $passwordOK = false;

    if (isset($_POST['userid'])) {
        if (empty($_POST['userid'])) {
            echo "Veuillez insérez un identifiant<br>";
        } else {
            $userOK = true;
        }
    }

    if (isset($_POST['password'])) {
        if (empty($_POST['password'])) {
            echo "Veuillez insérez un mot de passe<br>";
        } else {
            $passwordOK = true;
        }
    }

    if ($userOK==true && $passwordOK==true) {
        session_start();
        $_SESSION['userid_session'] = $_POST['userid'];
        $_SESSION['password_session'] = $_POST['password'];
        header('location: connexion.php');
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
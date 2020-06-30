<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>register</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php include("fonctions.php")?>
<body>
<form name="inscription" method="post" action="register.php">
    <p>Nom : <input type="text" id="username" name="username"></p><br>
    <p>Prenom : <input type="text" id="usersurname" name="usersurname"></p><br>
    <p>Choisissez un identifiant : <input type="text" id="userid" name="userid"></p><br>
    <p>Choisissez un mot de passe : <input type="password" id="password" name="password"></p><br>

    <input type="submit" name="valider" value="OK">
</form>

<?php
if (isset ($_POST['valider'])){
    $identifiant=$_POST['userid'];
    $nom=$_POST['username'];
    $prenom=$_POST['usersurname'];
    $password=$_POST['password'];
    $base = connectDB();
    $sql = 'INSERT INTO utilisateurs VALUES(NULL,"'.$nom.'","'.$prenom.'","'.$identifiant.'","'.$password.'",NULL,NULL,NULL,NULL)';
    mysqli_query($base, $sql);
    mysqli_close($base);
}
?>

</body>
</html>
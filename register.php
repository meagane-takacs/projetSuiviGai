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
    <p>Mail : <input type="text" id="userMail" name="userMail"></p><br>
    <p>Nom : <input type="text" id="userName" name="userName"></p><br>
    <p>Prenom : <input type="text" id="userSurname" name="userSurname"></p><br>
    <p>Choisissez un identifiant : <input type="text" id="userId" name="userId"></p><br>
    <p>Choisissez un mot de passe : <input type="password" id="password" name="password"></p><br>

    <input type="submit" name="valider" value="OK">
</form>

<?php
include("constantes.php");

if (isset ($_POST['valider'])){
    $userMail=$_POST['userMail'];
    $userIdentifiant=$_POST['userId'];
    $userName=$_POST['userName'];
    $userSurname=$_POST['userSurname'];
    $password=$_POST['password'];
    $base = connectDB();
    $sql = 'INSERT INTO utilisateurs VALUES(NULL,"'.$userName.'","'.$userSurname.'","'.$userIdentifiant.'","'.$password.'","'.$userMail.'",NULL,CONSTANT_Nb_Max_Cnx,NULL,NULL,NULL)';
    mysqli_query($base, $sql);
    mysqli_close($base);
}
?>

</body>
</html>
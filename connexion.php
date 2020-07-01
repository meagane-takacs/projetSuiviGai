<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php

include("fonctions.php");
session_start();
$useridVerif = $_SESSION['userid_session'];
$passwordVerif = $_SESSION['password_session'];


$query ="SELECT * FROM utilisateurs WHERE identifiant = '$useridVerif'";

$base = connectDB();

if (!$base)
{
    echo "Echec de connexion";

}

$result = mysqli_query($base, $query);

//$nbRes = mysqli_num_rows ($result);
//echo "'Nombre de résultat ='$nbRes<br>";

while ($ligne = mysqli_fetch_array($result))
{

    $identifiant_lu = $ligne[3];
  $prenom_lu = $ligne[2];
    echo "identifiant luuuuuu" .$identifiant_lu;

}




echo "Bonjour ".$useridVerif. " que souhaitez vous faire?";


?>

</body>
</html>
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

$userIdEntre = $_SESSION['userid_session'];
$passwordEntre = $_SESSION['password_session'];

$base = connectDB();

if (!$base)
{
    $_SESSION['resultat'] = "Erreur de connexion à la base";
}

$query = "SELECT * FROM utilisateurs WHERE identifiant = '$userIdEntre'";
$correspondance = "non";
$result = mysqli_query($base, $query);

while ($ligne = mysqli_fetch_array($result))
{
    $identifiantLu = $ligne['identifiant'];
    $prenomLu = $ligne['prenom'];
    $passwordLu = $ligne['password'];
    $correspondance ="oui";
    $nbTentativeLu = $ligne['nb_tentative_conn'];
    $nbTentativeMax = $ligne['nb_tentative_max'];
    $accesVerrouille = $ligne['acces_verrouille'];
}
//Je ferme cette requête. ça me permet d'utiliser l'autre utilisateur que l'utilisateur SELECT que l'on a crée juste pour la connexion
mysqli_close($base);


// Test accès verrouillé

// Je creer par défaut deux variable
$accesVerrouille = "N";
$correspondance = "oui";

if (trim($accesVerrouille) == "Y")
{
    $_SESSION['resultat'] = "Votre compte est verrouillé. Contactez l'administrateur";
    exit;
}

if ($correspondance == "oui")
    {
        $base = connectDBuser2();
        if(!$base)
        {
            $_SESSION['resultat'] = "Erreur de connexion a la base" . mysqli_connect_error();
            return;
        }
        if(trim($passwordLu) == trim($passwordEntre))
        {
            $_SESSION['resultat']="Connexion réussie";
            $query_ma0 = "UPDATE utilisateurs SET nb_tentative_conn = '0' WHERE identifiant = '$userIdEntre'";
            $result = mysqli_query($base, $query_ma0);
            if (!$result)
            {
                $_SESSION['resultat'] = "Erreur update de la base" .mysqli_connect_error($base);
                return;
            }
        }
        else
        {
            $_SESSION['resultat']="Mot de passe incorrect";
            $nbTentativeLu = $nbTentativeLu + 1;
            if ($nbTentativeLu > $nbTentativeMax)
            {
                $query_maj_tentative = "UPDATE utilisateurs SET = nb_tentative_conn = '$nbTentativeLu'";
                mysqli_query($base, $query_maj_tentative);
                if(!$result)
                {
                  $_SESSION['resultat'] = "Erreur update de la base".mysqli_connect_error($base);
                  return;
                }
                $_SESSION['resultat']="Compte verrouillé.";
            }
            else
            {
                $query = "update utilisateurs  SET nb_tentative_conn = '$nbTentativeLu' where identifiant = '$userIdEntre'";
                $result = mysqli_query($base,$query);
                if (!$result)
                {
                    $_SESSION['resultat'] = "Erreur  update  de la base " . mysqli_error($base);
                    return;
                }
                $_SESSION['resultat'] = "Password incorrect nbr de tentative $nbTentativeLu sur $nbTentativeMax";
            }
        }
    }
else
{
    $_SESSION['resultat'] = "Identifiant inconnu";
}



?>

</body>
</html>
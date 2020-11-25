<?php
/** Script connexion: propose l'acces au site
 * Call by: index.php
 */

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php

// Connexion base

include_once("fonctions.php");

function Connexion() {
//On met l'utilisateur et le mot de passe entré par l'utilisateur en session pour pouvoir le récupérer ailleurs (l°60 index)
$userIdEntre = $_SESSION['userid_session'];
$passwordEntre = $_SESSION['password_session'];
$utilisateurTrouve = "non";
//je me connecte
$base = connectDB();
//verification connexion
if (!$base)
{
    $_SESSION['resultat'] = "Erreur de connexion à la base";
}


//Recuperation utilisateur dans la base
//Affiche moi dans ma table les utilisateurs dont l'identifiant correspond à l'identifiant rentré 
$query = "SELECT * FROM utilisateurs WHERE identifiant = '$userIdEntre'";
// Je fixe correspondance à non
$correspondance = "non";

$result = mysqli_query($base, $query);
// Il va m'extraire le nom le prénom, ...
while ($ligne = mysqli_fetch_array($result))
{
    $identifiantLu = $ligne['identifiant'];
    $prenomLu = $ligne['prenom'];
    $passwordLu = $ligne['password'];
    $utilisateurTrouve ="oui";
    $nbTentativeLu = $ligne['nb_tentative_conn'];
    $nbTentativeMax = $ligne['nb_tentative_max'];
    $accesVerrouille = $ligne['acces_verrouille'];
}
//Je ferme cette requête. ça me permet d'utiliser l'autre utilisateur que l'utilisateur SELECT que l'on a crée juste pour la connexion
mysqli_close($base);


// Test accès verrouillé

//L'acces verouillé = NON par défaut
$accesVerrouille = "N";
//Si l'acces verouillé est vrai
if (trim($accesVerrouille) == "Y")
{
    //On affiche dans resultat
    $_SESSION['resultat'] = "Votre compte est verrouillé. Contactez l'administrateur";
    exit;
}
//Si l'utilisateur est trouvé
if ($utilisateurTrouve == "oui")
    {
        //On se connecte  la base de donné
        $base = connectDBuser2();
        //Si on n'arrive pas a se connecté a la base de donné on met dans resultat Erreur de connection a la base
        if(!$base)
        {
            $_SESSION['resultat'] = "Erreur de connexion a la base" . mysqli_connect_error();
            return;
        }
        //Si le password lu dans la BDD est le même que l'utilisateur à tapé
        if(trim($passwordLu) == trim($passwordEntre))
        {
            // On affiche "Connexion réussie"
            $_SESSION['resultat']="Connexion réussie";
            //On fait une query qui modifie le nb de tentative de connexion à 0 de l'utilisateur
            $query_ma0 = "UPDATE utilisateurs SET nb_tentative_conn = '0' WHERE identifiant = '$userIdEntre'";
            $result = mysqli_query($base, $query_ma0);
            //Si l'update ne fonctionne pas on affiche "Erreur update de la base"
            if (!$result)
            {
                $_SESSION['resultat'] = "Erreur update de la base" .mysqli_connect_error($base);
                return;
            }
            //Une fois que l'utilisateur est connecté, on affiche la page d'acceuil
            header('Location: acceuil.php');

        }
        //Si le password lu est différent de celui tapé par l'utilisateur
        else
        {
            //On affiche dans resultat "Mot de passe incorrect"
            $_SESSION['resultat']="Mot de passe incorrect";
            // On incrémente la tentative de connexion à +1
            $nbTentativeLu = $nbTentativeLu + 1;
            //SI le nombre de tentative essayé est supérieur à 3
            if ($nbTentativeLu > $nbTentativeMax)
            {
                //On modifie la base de donné le nombre de tentative max
                $query_maj_tentative = "UPDATE utilisateurs SET = nb_tentative_conn = '$nbTentativeLu'";
                //On apelle cette requete query maj tentative sur la base
                $result = mysqli_query($base, $query_maj_tentative);
                //Si la requete à échoué
                if(!$result)
                {
                    // On affiche erreur update de la base
                    $_SESSION['resultat'] = "Erreur update de la base".mysqli_connect_error($base);
                    return;
                }
                $_SESSION['resultat']="Compte verrouillé.";
            }
            //Si le nombre de tentative lu n'est pas supérieur au nombre de tentative max
            else
            {   // On modifie le nombre de tentative 
                $query = "update utilisateurs  SET nb_tentative_conn = '$nbTentativeLu' where identifiant = '$userIdEntre'";
                //Si la requete a échoué
                $result = mysqli_query($base,$query);
                if (!$result)
                {
                    $_SESSION['resultat'] = "Erreur  update  de la base " . mysqli_error($base);
                    return;
                }
                //Si la requete a réussit, on affiche le nombre de tentative tenté sur le nb de tentative max a l'utilisateur
                $_SESSION['resultat'] = "Password incorrect nbr de tentative $nbTentativeLu sur $nbTentativeMax";
            }
        }
    }
else //Si l'utilisateur n'est pas trouvé
{

/** Recherche dans la table d'enregistrement si l'identifiant est répertorié dans temporaire et en attente de mot de passe */

    //On se connecte à la BDD
    $base = connectDB();
    //Si la connection échoue
    if (!$base)
        {
            $_SESSION['resultat'] = "Erreur de connection à la base" .mysqli_connect_error();
            return;  
        }
    // On affiche  la table enregistrement tmp l'utilisateur correspondant a ce que l'utilisateur a tapé comme mot de passe et comme  utilisateur   
    $query = "SELECT * FROM enregistrement_tmp WHERE identifiant = '$userIdEntre' AND code_genere ='$passwordEntre'";
    // On stocke dans result
    $result = mysqli_query($base, $query);
    // Si on a trouvé dans la base
    $ligne = mysqli_fetch_array($result);


    // Si on le trouve 
    if ($ligne)
    {
        $_SESSION['resultat'] = "Changement de mot de passe requit";
    }
    else
    {
        $_SESSION['resultat'] = "Identifiant ou mot de passe non reconnu";
    }
}
} // Fin function Connexion
?>

</body>
</html>
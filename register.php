<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>register</title>
    <link rel="stylesheet" href="suivi_gai_style.css">
</head>
<?php include("fonctions.php")?>
<body>

<body>
<div id="bandeau" class="bandeau">
    <H1 class="titre">Bienvenue sur la page de suivi GAI</H1>
</div>

<form class="hello" name="inscription" method="post" action="register.php">
        <table>
            <tr>
                <td>Mail :</td>
                <td><input type="text" id="userMail" name="userMail"></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" id="userName" name="userName"></td>
            </tr>
            <tr>
                <td>Prénom :</td>
                <td><input type="text" id="userSurname" name="userSurname"></td>
            </tr>
            <tr>
                <td>Choisissez un identifiant :</td>
                <td><input type="text" id="userId" name="userId"></td>
            </tr>
            <tr>
                <td><input id="conn" type="submit" name="valider" value="OK"></td>
            </tr>
        </table>
</form>

<?php
include("constantes.php");

//Si l'utilisateur clique sur valider, on récupère les valeurs
if (isset ($_POST['valider'])){
    $userMail=$_POST['userMail'];
    $userIdentifiant=$_POST['userId'];
    $userName=$_POST['userName'];
    $userSurname=$_POST['userSurname'];




    /***********************************************************************/
    /* Vérification d'un @ et d'un . dans une adresse mail
    /**********************************************************************/

    //Si l'adresse mail est remplie (pas vide)
    if(!empty($_POST['userMail']))
    {
        //Si l'adresse mail n'est pas valide
        if (!adresseMailValide($userMail))
        {
            $resultat = "Adresse mail non valide";
            ?>
            <SCRIPT language="Javascript">
            var affich_comment="<?php echo $resultat;?>";
            alert(affich_comment);</SCRIPT>;
            <?php
            exit();
        }
    }
    // Si l'adresse mail n'est pas remplie
    else
    {
        $resultat = "Renseignez une adresse mail";
        ?>
        <SCRIPT language="Javascript">
        var affich_comment="<?php echo $resultat;?>";
        alert(affich_comment);
        </SCRIPT>
        <?php
        exit();
    }
 // Si l'un des champs est vide
   if(empty($_POST['userName']) || empty($_POST['userSurname']) || empty($_POST['userMail']) || empty($_POST['userId']) )
   {
       $resultat = "un des champs n est pas renseigné";
        ?>
        <SCRIPT language="Javascript">
        var affich_comment="<?php echo $resultat;?>";
        alert(affich_comment);
        </SCRIPT>
        <?php
        exit();
    }

    /***********************************************************************/
    /* Identifiant déjà utilisé ?
    /**********************************************************************/

    //On apelle la fonction pour vérifier si l'identifiant est existant dans la table utilisateurs et dans la table temporaire
    $identifiantExiste = CheckIdentifiantExistant("utilisateurs", $userIdentifiant) || CheckIdentifiantExistant("enregistrement_tmp", $userIdentifiant) ;

    // Si l'identifiant existe déjà
    if ($identifiantExiste)
    {
        $resultat = "L'identifiant est déjà utilisé. Veuillez en choisir un autre";
        ?>
        <SCRIPT language="Javascript">
        var affich_comment="<?php echo $resultat;?>";
        alert(affich_comment);
        </SCRIPT>
        <?php
        exit();
    }

    /***********************************************************************/
    /* Adresse mail déjà utilisée ?
    /**********************************************************************/

    //On apelle la fonction pour vérifier si l'adresse email est existante dans la table utilisateurs et dans la table temporaire
    $adresseMailExiste = CheckAdresseMailExistante("utilisateurs", $userMail) || CheckAdresseMailExistante("enregistrement_tmp", $userMail) ;

    //Si l'adresse email existe déjà
    if ($adresseMailExiste)
    {
        $resultat = "Cette adresse e-mail est déjà utilisée";
        ?>
        <SCRIPT language="Javascript">
        var affich_comment="<?php echo $resultat;?>";
        alert(affich_comment);
        </SCRIPT>
        <?php
        exit();
    }

    // Vérif terminée : on enregistre
    $result = EnregistrerTmp($userName, $userSurname, $userMail, $userIdentifiant);

}
?>


</body>
</html>
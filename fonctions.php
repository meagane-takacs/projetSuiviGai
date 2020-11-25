<?php



/***********************************************************************/
/* Connexion au BDD
/**********************************************************************/

function connectDB(){
    $base = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($base,'suivi_gai');

    return $base;

}

function connectDBuser2(){
    $base = mysqli_connect('localhost', 'mtakacs', 'Eebslpdmv1904');
    mysqli_select_db($base,'suivi_gai');

    return $base;

}



/***********************************************************************/
/* La fonction vérifie que l'adresse mail comporte un @ et un .
Renvoie vrai si l'adresse contient un @ et .
/**********************************************************************/

function adresseMailValide ($adresseMail) {
    //Je fixe resultat par défaut à FALSE => par défaut adresse valide
    $resultat = FALSE;
    // Si l'adresse mail comporte un @, elle est valide => FALSE
    if(stristr($adresseMail, '@') === FALSE )
    {
        $resultat = FALSE;
    }
    //Si l'adresse mail comporte un . elle est valide => FALSE
    else if (stristr($adresseMail,'.') === FALSE)
    {
        $resultat = FALSE;
    }
    else
    {
        //Si elle ne comporte pas les deux @ et . elle n'est pas valide => TRUE
        $resultat = TRUE;
    }
    return $resultat;
}




/***********************************************************************/
/* La fonction enregistre le nouvel utilisateur dans la tmp, si tout est vérifié et ok
Retourne faux si quelque chose s'est mal passé
/**********************************************************************/
function EnregistrerTmp($userName, $userSurname, $userMail, $userIdentifiant)
{
    $base = connectDB();
    $rest = substr("$userSurname", 0,1) . substr("$userName", 0,1) . date('dmYHi');
    $sql = 'INSERT INTO enregistrement_tmp VALUES("'.$userName.'","'.$userSurname.'","'.$userMail.'","'.$userIdentifiant.'","'.$rest.'",3,"'.date('Y-m-d H:i:s').'")';
    $result = mysqli_query($base, $sql);
    mysqli_close($base);

    if($result)
    {
        $resultat = $rest;
        ?>
        <SCRIPT language="Javascript">
            var affich_comment="<?php echo "Votre mot de passe est:" .$resultat;?>";
            alert(affich_comment);</SCRIPT>';
        <?php
    }

    if (!$result)
    {
        $_SESSION['resultat'] = "Erreur update de la base" .mysqli_connect_error($base);
    }

    return $result ;

}



/***********************************************************************/
/* La fonction vérifie que l'identifiant n'est pas déjà utilisé (dans la table $nomTable)
/**********************************************************************/

function CheckIdentifiantExistant($nomTable, $userIdentifiant)
{
    $identifiantExistant = FALSE;

    $base = connectDB();
    $query = "SELECT * FROM $nomTable WHERE identifiant='$userIdentifiant'";
    $result = mysqli_query($base, $query);
    $ligne = mysqli_fetch_array($result);
    if($ligne)
    {
        $identifiantExistant = TRUE;
    }
    else
    {
        $identifiantExistant = FALSE;
    }
    mysqli_close($base);

    return $identifiantExistant;
}




/***********************************************************************/
/* La fonction vérifie que l'adresse mail n'est pas utilisé (dans la table nom table)
/**********************************************************************/

function CheckAdresseMailExistante($nomTable, $userMail)
{
    $mailExistant = FALSE ;

    $base = connectDB();
    $query= "SELECT * FROM $nomTable WHERE adresse_mail = '$userMail'";
    $result = mysqli_query($base,$query);

    while ($ligne = mysqli_fetch_array($result))
    {
        $mailExistant = TRUE;
    }
    mysqli_close($base);

    return $mailExistant;
}


?>

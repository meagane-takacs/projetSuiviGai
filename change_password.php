

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style.css">
</head>

<body>

<!-- Affichage page de changement de mot de passe -->
<div id="bandeau" class="bandeau">
    <H1 class="titre">Changement de mot de passe requis</H1>
</div>

<div class="formulaire">
<form name="change_pass" method="post" action="change_password.php">

<table>
    <tr>
        <td><span class="label_change_pass">Entrer un Nouveau Password :</span></td>   
        <td><input type="password" id="password_change" name="password_change" class='password_change'></td>
    </tr>
    <tr>
        <td><span class="label_change_pass">Confirmer Nouveau Password :</span></td>   
        <td><input type="password" id="password_chang2" name="password_chang2" class='password_chang2'></td>
    </tr>
    <tr>
        <td><input type="submit" id="button_pass_change" name="button_pass_change" class="button_pass_change" value="Changer le mot de passe"></td>
    </tr>
</table>


<?php
/** Script change_password propose le changement du password apres l'enregistrement et la premiere connexion
 * call by : index.php
 */

include_once('fonctions.php');
include_once('connexion.php');


//----------------------------------------------------------------------------------------------------------
// ------ CHANGEMENT DE MOT DE PASSE APRES LA PREMIERE CONNECTION AVEC LE MOT DE PASSE GENERE---------------
//----------------------------------------------------------------------------------------------------------

//Si on a cliquer sur changer le mot de passe
if (isset($_POST['button_pass_change']))
{         
    session_start();

    //Si le champ mot de passe à changer et le deuxieme mot de passe ne sont pas similaire
    if ( (!empty($_POST['password_change'])) && (!empty($_POST['password_chang2'])) )
    {
        if ( trim($_POST['password_change']) != trim($_POST['password_chang2']) )
        {
            $resultat = "Les mots de passe doivent être similaires";
            ?>           
            <SCRIPT language="Javascript">
                var affich_comment="<?php echo $resultat;?>";							  
                alert(affich_comment);</SCRIPT>	
            <?php    
        }
    
        //Si les mots de passe sont similaires
        else
        {            
            //On range dans une session les mots de passe et identifiant changé
            $_SESSION['password_session'] = trim($_POST['password_change']); 
            //On apelle change password             
            ChangePassword();
            $resultat = $_SESSION['resultat'];
            
            //Si résultat = connection autorisé (change_password l °53)
            if ( $resultat = "Connection autorisé")
            {
                //on tente une connexion   
                //include("connexion.php");
                Connexion();
            }
        }
    }
    else 
    {
        $resultat= "veuillez confirmer votre mot de passe"
        ?>           
        <SCRIPT language="Javascript">
            var affich_comment="<?php echo $resultat;?>";							  
            alert(affich_comment);</SCRIPT>
        <?php 
        exit();
    }
        
}



function ChangePassword() {

    //on vide la session
    unset($_SESSION['resultat']);
    //on initialise trouve a non
    $trouve = "non";
    //On stocke le password et l'identifiant dans une session
    $identifiant = $_SESSION['userid_session'];
    $password = $_SESSION['password_session'];

    $_SESSION['resultat'] = "test change password";

    //On se connecte à la BDD
    $base = connectDB();
    //Si la connection échoue
    if (!$base) 
        {
            $_SESSION['resultat'] = "Erreur de connection à la base" .mysqli_connect_error();
            return;
        }
    //Query qui apelle tout l'identifiant que l'utilisateur à tapé dans l'enregistrement temporaire      
    $query = "SELECT * FROM enregistrement_tmp WHERE identifiant = '$identifiant'";
    $result = mysqli_query($base, $query);
    //On extrait son nom, prenom...  
    while ($ligne = mysqli_fetch_array($result))
        {
            $nom = $ligne['nom'];
            $prenom = $ligne['prenom'];
            $code_genere = $ligne['code_genere'];
            $email = $ligne['adresse_mail'];
            $trouve = "oui"; 
        } 

    //Si trouvé = non, l'identifiant n'est pas correct 
    $_SESSION['resultat']= 'Erreur test' .$trouve;   
    if ($trouve == "non")
        {
            $_SESSION['resultat'] = "Cette identifiant '$identifiant' n'est pas correct";
            
            return;
        }

        //si le code généré est différent du mot de passe entré parl 'utilisateur (/!\ premiere connexion)
    /*if(trim($code_genere) != trim($password))
        {
            $_SESSION['resultat'] = "Le mot de passe n'est pas correct";
            return;
        }    
        */
    //On modifie la BDD qu'on entre dans utilisateurs avec le nom prénom, extrait l°29

    $query = "INSERT INTO utilisateurs (nom, prenom, identifiant, password, adresse_mail) VALUES ('$nom', '$prenom', '$identifiant', '$password', '$email')";
    $result = mysqli_query($base, $query);  
    $_SESSION['resultat']= 'Erreur test' .$query; 

    if (!$result) 
        {
            $_SESSION['resultat'] = "Erreur update de la base";    
            return;
        }   
    //On supprime l'identifiant de la table temporaire 

    $query = "DELETE FROM enregistrement_tmp WHERE identifiant ='$identifiant'";
    $result = mysqli_query($base, $query);  

    if (!$result) 
    {
        $_SESSION['resultat'] = "Erreur delete de la base" .mysqli_connect_error(). $query;
        return;
    } 
    $SESSION['resultat'] = "Connection autorisé ". $query;
    mysqli_close($base); 
} // Fin function ChangePassword

?>

</form>
</body>
</html>

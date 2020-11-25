<?php
/** Script change_password propose le changement du password apres l'enregistrement et la premiere connexion
 * call by : index.php
 */

include_once('fonctions.php');

function ChangePassword() {

 //on vide la session
unset($_SESSION['resultat']);
//on initialise trouve a non
$trouve = "non";
//On stocke le password et l'identifiant dans une session
$identifiant = $_SESSION['identifiant'];
$password = $_SESSION['New_password'];


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
if ($trouve == "non")
    {
        $_SESSION['resultat'] = "Cette identifiant '$identifiant' n'est pas correct";
        return;
    }
    //si le code généré est différent du mot de passe entré parl 'utilisateur (/!\ premiere connexion)
if(trim($code_genere) != trim($password))
    {
        $_SESSION['resultat'] = "Le mot de passe n'est pas correct";
        return;
    }    
//On modifie la BDD qu'on entre dans utilisateurs avec le nom prénom, extrait l°29

$query = "UPDATE utilisateurs SET nom = '$nom',prenom='$prenom',identifiant='$identifiant', password ='$password', adresse_email='$email'";
$result = mysqli_query($base, $query);  
if (!$base) 
    {
        $_SESSION['resultat'] = "Erreur update de la base" .mysqli_connect_error();
        return;
    }   
//On supprime l'identifiant de la table temporaire    
$query = "DELETE enregistrement_tmp WHERE identifiant ='$identifiant'";
if (!$base) 
{
    $_SESSION['resultat'] = "Erreur delete de la base" .mysqli_connect_error();
    return;
} 
$SESSION['resultat'] = "Connection autorisé";
mysqli_close($base); 
} // Fin function ChangePassword
?>

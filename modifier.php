<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style_modifier.css">
</head>

<body>
<div id="bandeau" class="bandeau">
    <H1 class="titre">Modification d'une image</H1>
</div>
<?php





include("fonctions.php");

session_start();

//Si le myregion à été rempli par le $_POST ça veut dire que les autres ont été rempli aussi
if (isset($_POST['myRegion']))
{
    $redirectRegion = $_GET['region'] ;
    
    // MAJ SQL
    updateImage( $_GET['id'],
                 $_POST['myRegion'], 
                 $_POST['myNomComplet'], 
                 $_POST['myShortName'], 
                 $_POST['myConfiguration'], 
                 $_POST['myLot'], 
                 $_POST['my400kv'], 
                 $_POST['myGeneration'], 
                 $_POST['myVersionGAI'],
                 $_POST['myDateGenerationGAI'],
                 $_POST['myDerniereAnalyse'],
                 $_POST['myCommentaireGAI'],
                 $_POST['myChangeSet'],
                 $_POST['myStatusAtos'],
                 $_POST['myDateNotification'],
                 $_POST['myDateDerniereRemarqueRtePdcd'],
                 $_POST['myRemarquePdcd'],
                 $_POST['myStatutVerifPDCD'],
                 $_POST['myDateQualificationAtos'],
                 $_POST['myApprobation_CE_1'],
                 $_POST['myCommentairesRTE'],
                 $_POST['myDateRepriseAtos'],
                 $_POST['myCommentaireRepriseAtos'],
                 $_POST['myChangeSetReprise'],
                 $_POST['myApprobation_CE_2'],
                 $_POST['myCommentaireRTE2'],
                 $_POST['myCycle']
                );

    // Et on enlève l'image de la table modif_images_en_cours
    // TODO

    // L'ID de l'image à modifier
    $idALire = $_GET['id'];
    //
    $base = connectDB();
    if (!$base)
    {
        $_SESSION['resultat'] = "Erreur de connexion à la base";
        ?>
        <SCRIPT language="Javascript">
            var affich_comment="<?php echo $resultat;?>";
            alert(affich_comment);</SCRIPT>';
        <?php
    }

    $query = "DELETE FROM modif_images_en_cours where id_image = $idALire";
    $resultValeurs = mysqli_query($base,$query);
    if (!$resultValeurs)
    {
         echo "impossible d exécuter la requete $query" .mysqli_error($base);
         exit;
    }
    


    header("Location: $redirectRegion.php");
    exit;
}

$base = connectDB();
if (!$base)
{
    $_SESSION['resultat'] = "Erreur de connexion à la base";
    ?>
    <SCRIPT language="Javascript">
        var affich_comment="<?php echo $resultat;?>";
        alert(affich_comment);</SCRIPT>';
    <?php
}

    // L'ID de l'image à modifier
    $idALire = $_GET['id'];

// Vérif modification concurrent
$query = "SELECT * FROM modif_images_en_cours where id_image = $idALire";
$resultValeurs = mysqli_query($base,$query);
if (!$resultValeurs)
{
    echo "impossible d exécuter la requete $query" .mysqli_error($base);
    exit;
}
if (mysqli_num_rows($resultValeurs) > 0)
{
    // L'image est déjà en cours d'édition
    // Afficher HTML d'erreur
    // TODO
    //
    $redirectRegion =  $_GET['region'];    

    echo "<div style='margin-top: 100px;'>";
    echo "<h1> L'image est déjà en cours d'édition</h1>";
     echo "<a href='$redirectRegion.php' target='_blanck'> <input type='button' value='Cancel'> </a>";
    echo "</div>";

    return;
}

// Pas de modif en cours : 
// 1/ On entre cette image dans modif_images_en_cours
// TODO
//
$userId = $_SESSION['userid_session'];
$currentDateTime = date("Y-m-d H:i:s"); 
$query = "INSERT INTO modif_images_en_cours (id_image,user,datetime) VALUES ('$idALire','$userId','$currentDateTime')";

$result = mysqli_query($base,$query);
if (!$result)
{
    echo "impossible d exécuter la requete $query" .mysqli_error($base);
    exit;
}
    
// 2/ On propose le formulaire avec les infos de l'image pré-remplies
$query = "SELECT * FROM images where id = $idALire";
$resultValeurs = mysqli_query($base,$query);

if (!$resultValeurs)
{
    echo "impossible d exécuter la requete $query" .mysqli_error($base);
    exit;
}


if (mysqli_num_rows($resultValeurs) > 0)
{
    //$redirectAction = "modifier.php?region=" + $_GET['region'];
    $redirectAction = "modifier.php?id=$idALire&region=" ;
    $redirectRegion =  $_GET['region'];    
    //echo "<form method = 'POST' action='modifier.php'>";
    echo "<div class='formulaire_modifier'>";
    echo "<form method = 'POST' action='$redirectAction$redirectRegion'>";
    $i=0;
    $ligneValeurs = mysqli_fetch_array($resultValeurs);       
     
    $myRegion = $ligneValeurs['Region'];
    echo "<div>";
    echo "<label>Region</label>";
    echo "<input name='myRegion' value=$myRegion>";
    echo "</div>";

    $myNomComplet = $ligneValeurs['Nom_Complet'];
    echo "<div>";
    echo "<label>Nom_Complet</label>";
    echo "<input name='myNomComplet' value=$myNomComplet>";
    echo "</div>";

    $myShortName = $ligneValeurs['Short_Name'];
    echo "<div>";
    echo "<label>Short_Name</label>";
    echo "<input name='myShortName' value=$myShortName>";
    echo "</div>";
    
    $myConfiguration = $ligneValeurs['Configuration'];
    echo "<div>";
    echo "<label>Configuration</label>";
    echo "<input name='myConfiguration' value=$myConfiguration>";
    echo "</div>";

    $myLot = $ligneValeurs['Lot'];
    echo "<div>";
    echo "<label>Lot</label>";
    echo "<input name='myLot' value=$myLot>";
    echo "</div>";
    
    //comment récupérer la valeur pour la mettre dans le select?
    $my400kv = $ligneValeurs['400kv'];
    echo "<div>";
    echo "<label>400kv</label>";
    echo "<select name='my400kv'>" ;
    if( $my400kv)
    {
        echo "<option value='1' selected>VRAI</option>
             <option value='0'>FAUX</option>";
    }
    else
    {
        echo "<option value='1'>VRAI</option>
             <option value='0' selected>FAUX</option>";
    }
    echo "</select>";
    
    echo "</div>";
    
    $myGenerationGAI = $ligneValeurs['Generation_GAI'];
    echo "<div>";
    echo "<label>Génération GAI</label>";
    echo "<input name='myGeneration' value=$myGenerationGAI>";
    echo "</div>";

    $myVersionGAI = $ligneValeurs['Version_GAI'];
    echo "<div>";
    echo "<label>Version GAI</label>";
    echo "<input name='myVersionGAI' value=$myVersionGAI>";
    echo "</div>";

    $myDateGenerationGAI = $ligneValeurs['Date_generation_GAI'];
    echo "<div>";
    echo "<label>Date Generation GAI</label>";
    echo "<input type='date' name='myDateGenerationGAI' value=$myDateGenerationGAI>";
    echo "</div>";

    $myDerniereAnalyse = $ligneValeurs['Date_derniere_analyse'];
    echo "<div>";
    echo "<label>Date dernière analyse</label>";
    echo "<input type='date' name='myDerniereAnalyse' value=$myDerniereAnalyse>";
    echo "</div>";

    $myCommentaireGAI = $ligneValeurs['Commentaire_GAI'];
    echo "<div>";
    echo "<label>Commentaires GAI</label>";
    echo "<input name='myCommentaireGAI' value=$myCommentaireGAI>";
    echo "</div>";

    $myChangeSet = $ligneValeurs['ChangeSet'];
    echo "<div>";
    echo "<label>ChangeSet</label>";
    echo "<input name='myChangeSet' value=$myChangeSet>";
    echo "</div>";

    $myStatutAtos = $ligneValeurs['Statut_Atos'];
    echo "<div>";
    echo "<label>Statut Atos</label>";
    echo "<input name'myStatusAtos' value=$myStatutAtos>";
    echo "</div>";

    $myDateNotification = $ligneValeurs['Date_Notification'];
    echo "<div>";
    echo "<label>Date Notification</label>";
    echo "<input type = 'date' name='myDateNotification' value=$myDateNotification>";
    echo "</div>";
    
    
    $myDateDerniereRemarqueRtePdcd = $ligneValeurs['Date_derniere_remarque_RTE_PDCD'];
    echo "<div>";
    echo "<label>Date dernière remarque RTE PDCD</label>";
    echo "<input type ='date' name='myDateDerniereRemarqueRtePdcd' value=$myDateDerniereRemarqueRtePdcd>";
    echo "</div>";    

    $myRemarqueRtePdcd= $ligneValeurs['Remarque_RTE_PDCD'];
    echo "<div>";
    echo "<label>Remarque RTE PDCD</label>";
    echo "<input name='myRemarquePdcd' value=$myRemarqueRtePdcd>";
    echo "</div>";

    $myStatutVerifPDCD= $ligneValeurs['Statut_Verif_PDCD'];
    echo "<div>";
    echo "<label>Statut verif PDCD</label>";
    echo "<input name='myStatutVerifPDCD'value=$myStatutVerifPDCD>";
    echo "</div>";

    $myDateQualificationAtos= $ligneValeurs['Date_qualification_Atos'];
    echo "<div>";
    echo "<label>Date qualification ATOS</label>";
    echo "<input type ='date' name='myDateQualificationAtos' value=$myDateQualificationAtos>";
    echo "</div>"; 

    $myApprobation_CE_1= $ligneValeurs['Approbation_CE_1'];
    echo "<div>";
    echo "<label>Approbation CE 1 ATOS</label>";
    echo "<input name='myApprobation_CE_1' value=$myApprobation_CE_1>";
    echo "</div>"; 

    $myCommentairesRTE= $ligneValeurs['Commentaires_RTE'];
    echo "<div>";
    echo "<label>Commentaires RTE</label>";
    echo "<input name='myCommentairesRTE' value=$myCommentairesRTE>";
    echo "</div>"; 

    $myDateRepriseAtos= $ligneValeurs['Date_Reprise_Atos'];
    echo "<div>";
    echo "<label>Date Reprise ATOS</label>";
    echo "<input name='myDateRepriseAtos' type ='date'value=$myDateRepriseAtos>";
    echo "</div>"; 

    $myCommentaireRepriseAtos= $ligneValeurs['Commentaire_Reprise_Atos'];
    echo "<div>";
    echo "<label>Commentaires Reprise ATOS</label>";
    echo "<input name='myCommentaireRepriseAtos'value=$myCommentaireRepriseAtos>";
    echo "</div>"; 

    $myChangeSetReprise= $ligneValeurs['ChangeSet_Reprise'];
    echo "<div>";
    echo "<label>ChangeSet Reprise</label>";
    echo "<input name='myChangeSetReprise'value=$myChangeSetReprise>";
    echo "</div>"; 

    $myApprobation_CE_2= $ligneValeurs['Approbation_CE_2'];
    echo "<div>";
    echo "<label>Approbation CE 2</label>";
    echo "<input name='myApprobation_CE_2' value=$myApprobation_CE_2>";
    echo "</div>"; 

    $myCommentaireRTE2= $ligneValeurs['Commentaires_RTE_2'];
    echo "<div>";
    echo "<label>Commentaires RTE 2</label>";
    echo "<input name='myCommentaireRTE2' value=$myCommentaireRTE2>";
    echo "</div>"; 

    $myCycle= $ligneValeurs['Cycle'];
    echo "<div>";
    echo "<label>Cycle</label>";
    echo "<input name='myCycle' value=$myCycle>";
    echo "</div>";

    echo "<input type='submit' value='Envoyer le formulaire'></input>";
    echo "<a href='$redirectRegion.php' target='_blanck'> <input type='button' value='Cancel'> </a>";
    echo "</div>";
  
  
}

?>


</body>

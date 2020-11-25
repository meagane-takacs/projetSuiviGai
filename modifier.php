<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style.css">
</head>

<body>
<?php

include("fonctions.php");
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

$query = "SHOW COLUMNS FROM images";
$resultTitre = mysqli_query($base, $query);
$idALire = $_GET['id'];
$query2 = "SELECT * FROM images where id = $idALire";
$resultValeurs = mysqli_query($base,$query2);

if (!$resultTitre)
{
     echo 'impossible d exécuter la requete ' .mysqli_error();
     exit;
}
if (!$resultValeurs)
{
    echo 'impossible d exécuter la requete ' .mysqli_error();
    exit;
}



if (mysqli_num_rows($resultTitre) > 0)
{
    echo "<form>";
    $i=0;
    $ligneValeurs = mysqli_fetch_array($resultValeurs);
    
    $titre = mysqli_fetch_array($resultTitre);
    
    $myRegion = $ligneValeurs['Region'];
    echo "<div>";
    echo "<label>Region</label>";
    echo "<input value=$myRegion>";
    echo "</div>";

    $myNomComplet = $ligneValeurs['Nom_Complet'];
    echo "<div>";
    echo "<label>Nom_Complet</label>";
    echo "<input value=$myNomComplet>";
    echo "</div>";
}



if (mysqli_num_rows($resultTitre) > 0)
{
    echo "<table>";
    $i=0;
    $ligneValeurs = mysqli_fetch_array($resultValeurs);
    
    /*
    while ( $titre = mysqli_fetch_assoc($resultTitre) )
    {         
        echo "<tr>";
        $field = $titre['Field'];
        echo "<td>$field</td>";
        echo "<td>$ligneValeurs[$i]</td>";
        $i++;
        echo "</tr>"                 ;
    }
    */

    $titre = mysqli_fetch_array($resultTitre);
    
    $myRegion = $ligneValeurs['Region'];
    echo "<tr>";
    echo "<td>Region</td>";
    echo "<td><input value=$myRegion></td>";
    echo "</tr>";

    $myNomComplet = $ligneValeurs['Nom_Complet'];
    echo "<tr>";
    echo "<td>Nom_Complet</td>";
    echo "<td><input value=$myNomComplet></td>";
    echo "</tr>";

    $myShortName = $ligneValeurs['Short_Name'];
    echo "<tr>";
    echo "<td>Short_Name</td>";
    echo "<td><input value=$myShortName></td>";
    echo "</tr>";
    
    $myConfiguration = $ligneValeurs['Configuration'];
    echo "<tr>";
    echo "<td>Configuration</td>";
    echo "<td><input value=$myConfiguration></td>";
    echo "</tr>";

    $myLot = $ligneValeurs['Lot'];
    echo "<tr>";
    echo "<td>Lot</td>";
    echo "<td><input value=$myLot></td>";
    echo "</tr>";
    
    //comment récupérer la valeur pour la mettre dans le select?
    $my400kv = $ligneValeurs['400kv'];
    echo "<tr>";
    echo "<td>400kv</td>";
    echo "<td><select name='400kv'>" ;
    if( $my400kv)
    {
        echo "<option value='VRAI' selected>VRAI</option>
             <option value='FAUX'>FAUX</option>";
    }
    else
    {
        echo "<option value='VRAI'>VRAI</option>
             <option value='FAUX' selected>FAUX</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    
    $myGenerationGAI = $ligneValeurs['Generation_GAI'];
    echo "<tr>";
    echo "<td>Génération GAI</td>";
    echo "<td><input value=$myGenerationGAI></td>";
    echo "</tr>";

    $myVersionGAI = $ligneValeurs['Version_GAI'];
    echo "<tr>";
    echo "<td>Version GAI</td>";
    echo "<td><input value=$myVersionGAI></td>";
    echo "</tr>";

    $myDateGenerationGAI = $ligneValeurs['Date_generation_GAI'];
    echo "<tr>";
    echo "<td>Date Generation GAI</td>";
    echo "<td><input type='date' value=$myDateGenerationGAI></td>";
    echo "</tr>";

    $myDerniereAnalyse = $ligneValeurs['Date_derniere_analyse'];
    echo "<tr>";
    echo "<td>Date dernière analyse</td>";
    echo "<td><input type='date' value=$myDerniereAnalyse></td>";
    echo "</tr>";

    $myCommentaireGAI = $ligneValeurs['Commentaire_GAI'];
    echo "<tr>";
    echo "<td>Commentaires GAI</td>";
    echo "<td><input value=$myCommentaireGAI></td>";
    echo "</tr>";

    $myChangeSet = $ligneValeurs['ChangeSet'];
    echo "<tr>";
    echo "<td>ChangeSet</td>";
    echo "<td><input value=$myChangeSet></td>";
    echo "</tr>";

    $myStatutAtos = $ligneValeurs['Statut_Atos'];
    echo "<tr>";
    echo "<td>Statut Atos</td>";
    echo "<td><input value=$myStatutAtos></td>";
    echo "</tr>";

    $myDateNotification = $ligneValeurs['Date_Notification'];
    echo "<tr>";
    echo "<td>Date Notification</td>";
    echo "<td><input type = 'date' value=$myDateNotification></td>";
    echo "</tr>";
    
    
    $myDateDerniereRemarqueRtePdcd = $ligneValeurs['Date_derniere_remarque_RTE_PDCD'];
    echo "<tr>";
    echo "<td>Date dernière remarque RTE PDCD</td>";
    echo "<td><input type ='date' value=$myDateDerniereRemarqueRtePdcd></td>";
    echo "</tr>";    

    $myRemarqueRtePdcd= $ligneValeurs['Remarque_RTE_PDCD'];
    echo "<tr>";
    echo "<td>Remarque RTE PDCD</td>";
    echo "<td><input value=$myDateDerniereRemarqueRtePdcd></td>";
    echo "</tr>";

    $myStatutVerifPDCD= $ligneValeurs['Statut_Verif_PDCD'];
    echo "<tr>";
    echo "<td>Statut verif PDCD</td>";
    echo "<td><input value=$myStatutVerifPDCD></td>";
    echo "</tr>";

    $myDateQualificationAtos= $ligneValeurs['Date_qualification_Atos'];
    echo "<tr>";
    echo "<td>Date qualification ATOS</td>";
    echo "<td><input type ='date' value=$myDateQualificationAtos></td>";
    echo "</tr>"; 

    $myApprobation_CE_1= $ligneValeurs['Approbation_CE_1'];
    echo "<tr>";
    echo "<td>Approbation CE 1 ATOS</td>";
    echo "<td><input value=$myApprobation_CE_1></td>";
    echo "</tr>"; 

    $myCommentairesRTE= $ligneValeurs['Commentaires_RTE'];
    echo "<tr>";
    echo "<td>Commentaires RTE</td>";
    echo "<td><input value=$myCommentairesRTE></td>";
    echo "</tr>"; 

    $myDateRepriseAtos= $ligneValeurs['Date_Reprise_Atos'];
    echo "<tr>";
    echo "<td>Date Reprise ATOS</td>";
    echo "<td><input type ='date'value=$myDateRepriseAtos></td>";
    echo "</tr>"; 

    $myCommentaireRepriseAtos= $ligneValeurs['Commentaire_Reprise_Atos'];
    echo "<tr>";
    echo "<td>Commentaires Reprise ATOS</td>";
    echo "<td><input value=$myCommentaireRepriseAtos></td>";
    echo "</tr>"; 

    $myChangeSetReprise= $ligneValeurs['ChangeSet_Reprise'];
    echo "<tr>";
    echo "<td>ChangeSet Reprise</td>";
    echo "<td><input value=$myChangeSetReprise></td>";
    echo "</tr>"; 

    $myApprobation_CE_2= $ligneValeurs['Approbation_CE_2'];
    echo "<tr>";
    echo "<td>Approbation CE 2</td>";
    echo "<td><input value=$myApprobation_CE_2></td>";
    echo "</tr>"; 

    $myCommentaireRTE2= $ligneValeurs['Commentaires_RTE_2'];
    echo "<tr>";
    echo "<td>Commentaires RTE 2</td>";
    echo "<td><input value=$myCommentaireRTE2></td>";
    echo "</tr>"; 

    $myCycle= $ligneValeurs['Cycle'];
    echo "<tr>";
    echo "<td>Cycle</td>";
    echo "<td><input value=$myCycle></td>";
    echo "</tr>";

    echo "</table>";

    echo "<input type='submit' value='Envoyer le formulaire'></input>";
  
}

?>


</body>

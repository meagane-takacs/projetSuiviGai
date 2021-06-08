<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style_create.css">
</head>

<body>

<div id="bandeau" class="bandeau">
    <H1 class="titre">Ajout d'une image</H1>
</div>

<?php

include("fonctions.php");

//Si le myregion à été rempli par le $_POST ça veut dire que les autres ont été rempli aussi
if (isset($_POST['myRegion']))
{
    $redirectRegion = $_GET['region'] ;
    
    // MAJ SQL
    createImage( $_POST['myRegion'], 
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

    header("Location: $redirectRegion.php");
    exit;
}

{
    //$redirectAction = "modifier.php?region=" + $_GET['region'];
    $redirectRegion =  $_GET['region'];    
    $redirectAction = "create.php?region=$redirectRegion" ;
    //echo "<form method = 'POST' action='modifier.php'>";
    echo "<div class='formulaire_create'>";
    echo "<form method = 'POST' action='$redirectAction'>";
     
    echo "<div>";
    echo "<label>Region</label>";
    echo "<input name='myRegion' value='$redirectRegion'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Nom_Complet</label>";
    echo "<input name='myNomComplet'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Short_Name</label>";
    echo "<input name='myShortName'>";
    echo "</div>";
    
    echo "<div>";
    echo "<label>Configuration</label>";
    echo "<input name='myConfiguration'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Lot</label>";
    echo "<input name='myLot'>";
    echo "</div>";
    
    //comment récupérer la valeur pour la mettre dans le select?
    echo "<div>";
    echo "<label>400kv</label>";
    echo "<select name='my400kv'>" ;
    echo "<option value='1' selected>VRAI</option>
          <option value='0'>FAUX</option>";
    echo "</select>";
    
    echo "</div>";
    
    echo "<div>";
    echo "<label>Génération GAI</label>";
    echo "<input name='myGeneration'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Version GAI</label>";
    echo "<input name='myVersionGAI'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Date Generation GAI</label>";
    echo "<input type='date' name='myDateGenerationGAI'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Date dernière analyse</label>";
    echo "<input type='date' name='myDerniereAnalyse'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Commentaires GAI</label>";
    echo "<input name='myCommentaireGAI'>";
    echo "</div>";

    echo "<div>";
    echo "<label>ChangeSet</label>";
    echo "<input name='myChangeSet' >";
    echo "</div>";

    echo "<div>";
    echo "<label>Statut Atos</label>";
    echo "<input name='myStatusAtos'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Date Notification</label>";
    echo "<input type = 'date' name='myDateNotification'>";
    echo "</div>";
    
    echo "<div>";
    echo "<label>Date dernière remarque RTE PDCD</label>";
    echo "<input type ='date' name='myDateDerniereRemarqueRtePdcd'>";
    echo "</div>";    

    echo "<div>";
    echo "<label>Remarque RTE PDCD</label>";
    echo "<input name='myRemarquePdcd'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Statut verif PDCD</label>";
    echo "<input name='myStatutVerifPDCD'>";
    echo "</div>";

    echo "<div>";
    echo "<label>Date qualification ATOS</label>";
    echo "<input type ='date' name='myDateQualificationAtos'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Approbation CE 1 ATOS</label>";
    echo "<input name='myApprobation_CE_1'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Commentaires RTE</label>";
    echo "<input name='myCommentairesRTE'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Date Reprise ATOS</label>";
    echo "<input name='myDateRepriseAtos' type ='date'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Commentaires Reprise ATOS</label>";
    echo "<input name='myCommentaireRepriseAtos'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>ChangeSet Reprise</label>";
    echo "<input name='myChangeSetReprise'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Approbation CE 2</label>";
    echo "<input name='myApprobation_CE_2'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Commentaires RTE 2</label>";
    echo "<input name='myCommentaireRTE2'>";
    echo "</div>"; 

    echo "<div>";
    echo "<label>Cycle</label>";
    echo "<input name='myCycle'>";
    echo "</div>";

    echo "<input type='submit' value='Envoyer le formulaire'></input>";
    echo "<a href='Lille.php' target='_blanck'> <input type='button' value='Cancel'> </a>";
    echo "</div>";
  
  
}

?>


</body>
